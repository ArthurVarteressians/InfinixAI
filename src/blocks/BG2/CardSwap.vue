<template>
  <div ref="containerRef"
    class="card-swap-container absolute transform translate-x-[5%] translate-y-[20%] origin-bottom-right perspective-[900px] overflow-visible max-[768px]:translate-x-[25%] max-[768px]:translate-y-[25%] max-[768px]:scale-[0.75] max-[480px]:translate-x-[25%] max-[480px]:translate-y-[25%] max-[480px]:scale-[0.55]"
    :style="{
      width: typeof width === 'number' ? `${width}px` : width,
      height: typeof height === 'number' ? `${height}px` : height
    }">
    <div
      v-for="(_, index) in 3"
      :key="index"
      :ref="el => cardRefs[index] = el as HTMLElement"
      class="card-swap-card absolute rounded-xl border border-white bg-black [transform-style:preserve-3d] [will-change:transform] [backface-visibility:hidden]"
      :style="{
        width: typeof width === 'number' ? `${width}px` : width,
        height: typeof height === 'number' ? `${height}px` : height
      }"
      @click="handleCardClick(index)"
    >
      <slot :name="`card-${index}`" :index="index" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, watch, nextTick, computed, useTemplateRef } from 'vue';
import gsap from 'gsap';

export interface CardSwapProps {
  width?: number | string;
  height?: number | string;
  cardDistance?: number;
  verticalDistance?: number;
  delay?: number;
  pauseOnHover?: boolean;
  onCardClick?: (idx: number) => void;
  skewAmount?: number;
  easing?: 'linear' | 'elastic';
}

interface Slot {
  x: number;
  y: number;
  z: number;
  zIndex: number;
}

const props = withDefaults(defineProps<CardSwapProps>(), {
  width: 350,
  height: 280,
  cardDistance: 60,
  verticalDistance: 50,
  delay: 5000,
  pauseOnHover: true,
  skewAmount: 6,
  easing: 'elastic'
});

const emit = defineEmits<{
  'card-click': [index: number];
}>();

const containerRef = useTemplateRef<HTMLDivElement>('containerRef');
const cardRefs = ref<HTMLElement[]>([]);
const order = ref<number[]>([0, 1, 2]);
const tlRef = ref<gsap.core.Timeline | null>(null);
const intervalRef = ref<number>();
const isPaused = ref(false);
const isAnimating = ref(false);

const makeSlot = (i: number, distX: number, distY: number, total: number): Slot => ({
  x: i * distX,
  y: -i * distY,
  z: -i * distX * 1.2,
  zIndex: total - i
});

const placeNow = (el: HTMLElement, slot: Slot, skew: number) => {
  gsap.set(el, {
    x: slot.x,
    y: slot.y,
    z: slot.z,
    xPercent: -50,
    yPercent: -50,
    skewY: skew,
    transformOrigin: 'center center',
    zIndex: slot.zIndex,
    force3D: true
  });
};

const handleCardClick = (index: number) => {
  emit('card-click', index);
  props.onCardClick?.(index);
};

const config = computed(() => {
  return props.easing === 'elastic'
    ? {
        ease: 'elastic.out(0.6, 0.6)',
        durDrop: 1,
        durMove: 1,
        durReturn: 0.6,
        promoteOverlap: 0.1,
        returnDelay: 0.1
      }
    : {
        ease: 'power2.inOut',
        durDrop: 0.6,
        durMove: 0.5,
        durReturn: 0.6,
        promoteOverlap: 0.6,
        returnDelay: 0.1
      };
});

const initializeCards = () => {
  if (!cardRefs.value.length) return;

  const total = cardRefs.value.length;
  order.value = [0, 1, 2]; // Reset order

  cardRefs.value.forEach((el, i) => {
    if (el) {
      const slot = makeSlot(i, props.cardDistance, props.verticalDistance, total);
      placeNow(el, slot, props.skewAmount);
    }
  });
};

const updateCardPositions = () => {
  if (!cardRefs.value.length || isAnimating.value) return;

  const total = cardRefs.value.length;

  cardRefs.value.forEach((el, i) => {
    if (el) {
      const slot = makeSlot(i, props.cardDistance, props.verticalDistance, total);
      gsap.set(el, {
        x: slot.x,
        y: slot.y,
        z: slot.z,
        skewY: props.skewAmount,
        zIndex: slot.zIndex
      });
    }
  });
};

const swap = () => {
  if (order.value.length < 2 || isAnimating.value || isPaused.value) return;

  isAnimating.value = true;
  const [front, ...rest] = order.value;
  const elFront = cardRefs.value[front];
  if (!elFront) {
    isAnimating.value = false;
    return;
  }

  const tl = gsap.timeline({
    onComplete: () => {
      order.value = [...rest, front];
      isAnimating.value = false;
    }
  });
  
  tlRef.value = tl;

  // Drop the front card
  tl.to(elFront, {
    y: '+=260',
    rotation: '+=10',
    duration: config.value.durDrop,
    ease: config.value.ease
  });

  // Promote other cards
  const promoteStart = config.value.durDrop * (1 - config.value.promoteOverlap);
  tl.addLabel('promote', promoteStart);

  rest.forEach((idx, i) => {
    const el = cardRefs.value[idx];
    if (!el) return;

    const slot = makeSlot(i, props.cardDistance, props.verticalDistance, cardRefs.value.length);
    
    tl.set(el, { zIndex: slot.zIndex }, 'promote');
    tl.to(el, {
      x: slot.x,
      y: slot.y,
      z: slot.z,
      duration: config.value.durMove,
      ease: config.value.ease
    }, `promote+=${i * 0.1}`);
  });

  // Return the front card to back
  const backSlot = makeSlot(
    cardRefs.value.length - 1,
    props.cardDistance,
    props.verticalDistance,
    cardRefs.value.length
  );
  
  const returnStart = promoteStart + config.value.durMove + config.value.returnDelay;
  tl.addLabel('return', returnStart);
  
  tl.set(elFront, { 
    zIndex: backSlot.zIndex,
    x: backSlot.x,
    z: backSlot.z
  }, 'return');
  
  tl.to(elFront, {
    y: backSlot.y,
    rotation: 0,
    duration: config.value.durReturn,
    ease: config.value.ease
  }, 'return');
};

const startAnimation = () => {
  if (isPaused.value) return;
  
  stopAnimation();
  
  // Start first swap after a short delay
  setTimeout(() => {
    if (!isPaused.value) {
      swap();
      intervalRef.value = window.setInterval(() => {
        if (!isPaused.value) {
          swap();
        }
      }, props.delay);
    }
  }, 1000);
};

const stopAnimation = () => {
  if (tlRef.value) {
    tlRef.value.kill();
    tlRef.value = null;
  }

  if (intervalRef.value) {
    clearInterval(intervalRef.value);
    intervalRef.value = undefined;
  }
  
  isAnimating.value = false;
};

const pauseAnimation = () => {
  if (isPaused.value) return;
  
  isPaused.value = true;
  
  // Pause current timeline if running
  if (tlRef.value && tlRef.value.isActive()) {
    tlRef.value.pause();
  }
  
  // Clear interval to prevent new swaps
  if (intervalRef.value) {
    clearInterval(intervalRef.value);
    intervalRef.value = undefined;
  }
};

const resumeAnimation = () => {
  if (!isPaused.value) return;
  
  isPaused.value = false;
  
  // Resume paused timeline or start new cycle
  if (tlRef.value && tlRef.value.paused()) {
    tlRef.value.resume();
    // Set up interval for next swap
    setTimeout(() => {
      if (!isPaused.value && !intervalRef.value) {
        intervalRef.value = window.setInterval(() => {
          if (!isPaused.value) {
            swap();
          }
        }, props.delay);
      }
    }, tlRef.value.duration() * 1000 - tlRef.value.time() * 1000);
  } else {
    // Start fresh animation cycle
    startAnimation();
  }
};

const setupHoverListeners = () => {
  if (props.pauseOnHover && containerRef.value) {
    containerRef.value.addEventListener('mouseenter', pauseAnimation);
    containerRef.value.addEventListener('mouseleave', resumeAnimation);
  }
};

const removeHoverListeners = () => {
  if (containerRef.value) {
    containerRef.value.removeEventListener('mouseenter', pauseAnimation);
    containerRef.value.removeEventListener('mouseleave', resumeAnimation);
  }
};

// Watchers
watch(
  () => [props.cardDistance, props.verticalDistance, props.skewAmount],
  () => {
    nextTick(() => {
      updateCardPositions();
    });
  }
);

watch(
  () => props.delay,
  () => {
    if (intervalRef.value && !isPaused.value) {
      clearInterval(intervalRef.value);
      intervalRef.value = window.setInterval(() => {
        if (!isPaused.value) {
          swap();
        }
      }, props.delay);
    }
  }
);

watch(
  () => props.pauseOnHover,
  () => {
    removeHoverListeners();
    setupHoverListeners();
  }
);

// Lifecycle
onMounted(() => {
  nextTick(() => {
    initializeCards();
    setupHoverListeners();
    startAnimation();
  });
});

onUnmounted(() => {
  stopAnimation();
  removeHoverListeners();
});
</script>