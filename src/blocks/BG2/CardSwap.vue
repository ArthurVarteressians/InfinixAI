<template>
  <div
    ref="containerRef"
    class="card-swap-container absolute bottom-0 right-0 transform translate-x-[5%] translate-y-[20%] origin-bottom-right perspective-[900px] overflow-visible max-[768px]:translate-x-[25%] max-[768px]:translate-y-[25%] max-[768px]:scale-[0.75] max-[480px]:translate-x-[25%] max-[480px]:translate-y-[25%] max-[480px]:scale-[0.55]"
    :style="{
      width: typeof width === 'number' ? `${width}px` : width,
      height: typeof height === 'number' ? `${height}px` : height
    }"
  >
    <div
      v-for="(_, index) in 3"
      :key="index"
      ref="cardRefs"
      class="card-swap-card absolute top-1/2 left-1/2 rounded-xl border border-white bg-black [transform-style:preserve-3d] [will-change:transform] [backface-visibility:hidden]"
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

<script lang="ts">
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

const makeSlot = (i: number, distX: number, distY: number, total: number): Slot => ({
  x: i * distX * 0.8,  // Reduced horizontal spread
  y: -i * distY * 0.6,  // Reduced vertical spread
  z: -i * distX * 0.8,  // Reduced depth
  zIndex: total - i
});

const placeNow = (el: HTMLElement, slot: Slot, skew: number) => {
  gsap.set(el, {
    x: slot.x,
    y: slot.y,
    z: slot.z,
    skewY: skew * 0.7,  // Reduced skew
    transformOrigin: 'center center',
    zIndex: slot.zIndex,
    force3D: true
  });
};

export { makeSlot, placeNow };
</script>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, watch, nextTick, computed, useTemplateRef } from 'vue';

const props = withDefaults(defineProps<CardSwapProps>(), {
  width: 300,  // Smaller default width
  height: 200, // Smaller default height
  cardDistance: 40,
  verticalDistance: 30,
  delay: 5000,
  pauseOnHover: true,  // Default to pause on hover
  skewAmount: 4,      // Reduced skew
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

const handleCardClick = (index: number) => {
  emit('card-click', index);
  props.onCardClick?.(index);
};

const config = computed(() => {
  return props.easing === 'elastic'
    ? {
        ease: 'elastic.out(0.6,0.9)',
        durDrop: 2,
        durMove: 2,
        durReturn: 2,
        promoteOverlap: 0.9,
        returnDelay: 0.05
      }
    : {
        ease: 'power1.inOut',
        durDrop: 0.8,
        durMove: 0.8,
        durReturn: 0.8,
        promoteOverlap: 0.45,
        returnDelay: 0.2
      };
});

const initializeCards = () => {
  if (!cardRefs.value.length) return;

  const total = cardRefs.value.length;

  cardRefs.value.forEach((el, i) => {
    if (el) {
      placeNow(el, makeSlot(i, props.cardDistance, props.verticalDistance, total), props.skewAmount);
    }
  });
};

const updateCardPositions = () => {
  if (!cardRefs.value.length) return;

  const total = cardRefs.value.length;

  cardRefs.value.forEach((el, i) => {
    if (el) {
      const slot = makeSlot(i, props.cardDistance, props.verticalDistance, total);
      gsap.set(el, {
        x: slot.x,
        y: slot.y,
        z: slot.z,
        skewY: props.skewAmount
      });
    }
  });
};

const swap = () => {
  if (order.value.length < 2) return;

  const [front, ...rest] = order.value;
  const elFront = cardRefs.value[front];
  if (!elFront) return;

  const tl = gsap.timeline();
  tlRef.value = tl;

  // Smoother, shorter animation
  tl.to(elFront, {
    y: '+=200',  // Reduced movement
    duration: 1.2,
    ease: 'power2.out'
  });
}


const startAnimation = () => {
  stopAnimation();
  swap();
  intervalRef.value = window.setInterval(swap, props.delay);
};

const stopAnimation = () => {
  tlRef.value?.kill();
  if (intervalRef.value) {
    clearInterval(intervalRef.value);
  }
};

const resumeAnimation = () => {
  tlRef.value?.play();
  intervalRef.value = window.setInterval(swap, props.delay);
};

const setupHoverListeners = () => {
  if (props.pauseOnHover && containerRef.value) {
    containerRef.value.addEventListener('mouseenter', stopAnimation);
    containerRef.value.addEventListener('mouseleave', resumeAnimation);
  }
};

const removeHoverListeners = () => {
  if (containerRef.value) {
    containerRef.value.removeEventListener('mouseenter', stopAnimation);
    containerRef.value.removeEventListener('mouseleave', resumeAnimation);
  }
};

watch(
  () => [props.cardDistance, props.verticalDistance, props.skewAmount],
  () => {
    updateCardPositions();
  }
);

watch(
  () => props.delay,
  () => {
    if (intervalRef.value) {
      clearInterval(intervalRef.value);
      intervalRef.value = window.setInterval(swap, props.delay);
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

watch(
  () => props.easing,
  () => {}
);

onMounted(() => {
  nextTick(() => {
    initializeCards();
    startAnimation();
    setupHoverListeners();
  });
});

onUnmounted(() => {
  stopAnimation();
  removeHoverListeners();
});
</script>
