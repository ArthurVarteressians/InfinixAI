<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import infinixlogo from '/public/logo.png';
import AppMainheader from './AppMainheader.vue';
import Hyperspeed from '../../../src/blocks/Backgrounds/Hyperspeed/Hyperspeed.vue';


// Hyperspeed configuration with brand colors and slower default speed
const hyperspeedOptions = {
  distortion: 'turbulentDistortion' as const,

  length: 480,
  roadWidth: 5,
  islandWidth: 1,
  lanesPerRoad: 1.5,
  fov: 120,
  fovSpeedUp: 120,
  speedUp: 2, // Speed up multiplier when clicking
  carLightsFade: 0.4,
  totalSideLightSticks: 30,
  lightPairsPerRoadWay: 40,
  shoulderLinesWidthPercentage: 0.06,
  brokenLinesWidthPercentage: 0.08,
  brokenLinesLengthPercentage: 0.5,
  lightStickWidth: [0.08, 0.3] as [number, number],
  lightStickHeight: [0.8, 1.2] as [number, number],
  movingAwaySpeed: [10, 3] as [number, number], // Much slower default speed
  movingCloserSpeed: [-50, -45] as [number, number], // Much slower default speed
  carLightsLength: [300 * 0.02, 300 * 0.15] as [number, number],
  carLightsRadius: [0.015, 0.08] as [number, number],
  carWidthPercentage: [0.2, 0.4] as [number, number],
  carShiftX: [-0.4, 0.4] as [number, number],
  carFloorSeparation: [0, 0.5] as [number, number],
  timeScale: 0.05,

  colors: {
    roadColor: 0x080808,
    islandColor: 0x0a0a0a,
    background: 0x000000,
    shoulderLines: 0x131318,
    brokenLines: 0x131318,
    // Brand colors from your logo - orange/red gradient
    leftCars: [0xff6b35, 0xff4500, 0xe63946], // Orange to red gradient
    rightCars: [0xffba08, 0xff8500, 0xfb8500], // Yellow-orange to orange
    sticks: 0xff6b35, // Primary brand orange
  },
};
</script>

<template>
  <div class="relative bg-black">
    <!-- Hyperspeed Background - full screen and clickable -->
    <div class="fixed inset-0 w-full h-full z-0">
      <Hyperspeed :effectOptions="hyperspeedOptions" />
    </div>

    <!-- Content overlay -->
    <div class="relative z-10 pointer-events-none">
      <!-- Header with pointer events enabled -->
      <div class="pointer-events-auto">
        <AppMainheader />
      </div>

      <!-- Main content -->
      <main class="flex items-center justify-center min-h-screen px-6">
        <div class="text-center text-white max-w-4xl mx-auto pointer-events-auto">

          <transition appear enter-active-class="transition-all duration-1000 ease-out"
            enter-from-class="opacity-0 blur-sm scale-110" enter-to-class="opacity-100 blur-none scale-100">
            <h1
              class="text-6xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-orange-400 via-red-500 to-orange-600 bg-clip-text text-transparent"
              style="text-shadow: 0 2px 4px rgba(251, 146, 60, 0.3);">
              Welcome to Infinix AI
            </h1>
          </transition>


          <!-- Animated Subheading -->
          <transition appear enter-active-class="transition-all duration-1000 ease-out delay-300"
            enter-from-class="opacity-0 translate-y-8" enter-to-class="opacity-100 translate-y-0">
            <p class="text-xl md:text-2xl mb-8 opacity-90 text-orange-200">
              Experience the future with our innovative solutions
            </p>
          </transition>

          <!-- Animated Button -->
          <transition appear enter-active-class="transition-all duration-1000 ease-out delay-500"
            enter-from-class="opacity-0 scale-90" enter-to-class="opacity-100 scale-100">
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <Link :href="route('clientRegistration')"
                class="inline-block px-8 py-4 bg-gradient-to-r from-orange-500 to-red-600 text-white rounded-lg hover:from-orange-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 font-semibold text-lg min-w-[160px]">
              Get Started
              </Link>
            </div>
          </transition>
        </div>
      </main>
    </div>
  </div>
</template>