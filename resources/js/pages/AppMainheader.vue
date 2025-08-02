<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import infinixlogo from '/public/logo.png';
</script>

<template>
  <header class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-6 py-4">
      <div class="flex items-center justify-between">
        <!-- Logo -->
        <Link :href="route('home')" class="flex items-center space-x-3">
          <img :src="infinixlogo" alt="Infinix Logo" class="h-20">
        </Link>

        <!-- Auth Buttons -->
        <div class="flex items-center space-x-4">
          <Link 
            :href="route('clientLogin')" 
            class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50"
          >
            Login
          </Link>
          <Link 
            :href="route('clientRegistration')" 
            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700"
          >
            Register
          </Link>
        </div>
      </div>
    </div>
  </header>
</template>