<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import infinixlogo from '/public/logo.png';
</script>

<template>
  <header class="shadow-sm border-b border-orange-800 ">
    <div class="max-w-7xl mx-auto px-6 py-3">
      <div class="flex items-center justify-between">
        <!-- Logo with subtle animation -->
        <transition
          appear
          enter-active-class="transition-all duration-500 ease-out"
          enter-from-class="opacity-0 -translate-x-4"
          enter-to-class="opacity-100 translate-x-0"
        >
          <Link :href="route('home')" class="flex items-center space-x-3 group">
            <img 
              :src="infinixlogo" 
              alt="Infinix Logo" 
              class="h-16 transition-all duration-300 group-hover:scale-105"
            >
          </Link>
        </transition>

        <!-- Animated Auth Buttons -->
        <div class="flex items-center space-x-4">
          <transition
            appear
            enter-active-class="transition-all duration-500 ease-out"
            enter-from-class="opacity-0 translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
          >
            <Link 
              :href="route('clientLogin')" 
              class="px-6 py-2.5 text-orange-400 font-medium rounded-lg border-2 border-orange-500 hover:bg-orange-500/10 hover:shadow-md transition-all duration-300 hover:-translate-y-0.5"
            >
              Login
            </Link>
          </transition>
          
          <transition
            appear
            enter-active-class="transition-all duration-500 ease-out delay-100"
            enter-from-class="opacity-0 translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
          >
            <Link 
              :href="route('clientRegistration')" 
              class="px-6 py-2.5 font-medium text-white rounded-lg bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5"
            >
              Register
            </Link>
          </transition>
        </div>
      </div>
    </div>
  </header>
</template>