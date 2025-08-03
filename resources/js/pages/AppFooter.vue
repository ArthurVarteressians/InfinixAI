<template>

  <footer
    class="bg-black border-t border-orange-500/20 justify-content-center text-center py-10 text-sm font-light tracking-wide text-orange-200">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Branding -->
      <div class="my-[-20px]">

        <Link :href="route('home')" class="m-auto ">
        <img :src="infinixlogo" alt="Infinix Logo" class="h-16 transition-all m-auto duration-300 group-hover:scale-105">
        </Link>
        <p class="text-sm p-2.5">
          Empowering secure, offline intelligence — built for enterprises that value data privacy.
        </p>
      </div>

      <!-- Quick Links -->
      <div>
        <h4 class="text-lg font-semibold text-orange-300 mb-3">Navigation</h4>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:text-orange-400">Home</a></li>
          <li><a class="hover:text-orange-400">Request Demo</a></li>
        </ul>
      </div>

      <!-- Contact / Social -->
      <div>
        <h4 class="text-lg font-semibold text-orange-300 mb-3">Connect</h4>
        <p class="text-sm mb-2">Email: <a href="mailto:hello@infinix.local"
            class="hover:text-orange-400">Arthurvarteressians.de</a></p>
        <p class="text-sm mb-2">Support: support@infinix.local</p>
        <!-- Optional: Add social icons if needed -->
      </div>
    </div>

    <div class="border-t border-orange-800 text-center text-xs py-4 text-orange-600">
      &copy; {{ new Date().getFullYear() }} Infinix AI — All rights reserved.
    </div>
  </footer>
</template>
<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import infinixlogo from '/public/logo.png';
</script>