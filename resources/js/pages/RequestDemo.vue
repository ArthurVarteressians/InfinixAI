<script setup>
import { ref } from 'vue'

const name = ref('')
const email = ref('')
const company = ref('')
const message = ref('')
</script>

<template>
  <div class="w-full py-12 border-t border-orange-500/20">
    <div class="max-w-5xl mx-auto px-4 text-center">
      <h3 class="text-3xl font-bold bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 bg-clip-text text-transparent mb-2">Request a Personalized Demo</h3>
      <p class="text-orange-200 mb-8">
        Discover how Infinix AI can revolutionize your data workflows — all hosted locally on your servers.
      </p>

      <form @submit.prevent="console.log({ name, email, company, message })"
        class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
        <div>
          <label class="block text-orange-300 mb-1">Full Name</label>
          <input v-model="name" type="text" placeholder="Jane Doe"
            class="w-full rounded-lg bg-black border border-orange-400/40 text-orange-100 px-4 py-3 focus:ring-2 focus:ring-orange-400 outline-none"
            required />
        </div>

        <div>
          <label class="block text-orange-300 mb-1">Email Address</label>
          <input v-model="email" type="email" placeholder="jane@example.com"
            class="w-full rounded-lg bg-black border border-orange-400/40 text-orange-100 px-4 py-3 focus:ring-2 focus:ring-orange-400 outline-none"
            required />
        </div>

        <div class="md:col-span-2">
          <label class="block text-orange-300 mb-1">Company / Organization</label>
          <input v-model="company" type="text" placeholder="Infinix Solutions"
            class="w-full rounded-lg bg-black border border-orange-400/40 text-orange-100 px-4 py-3 focus:ring-2 focus:ring-orange-400 outline-none" />
        </div>

        <div class="md:col-span-2">
          <label class="block text-orange-300 mb-1">What would you like to achieve?</label>
          <textarea v-model="message" rows="4" placeholder="Tell us about your use-case or expectations..."
            class="w-full rounded-lg bg-black border border-orange-400/40 text-orange-100 px-4 py-3 focus:ring-2 focus:ring-orange-400 outline-none" />
        </div>

        <div class="md:col-span-2 text-center">
          <button type="submit"
            class="bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold py-3 px-8 rounded-lg hover:scale-105 transition-transform">
            Request Demo
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
