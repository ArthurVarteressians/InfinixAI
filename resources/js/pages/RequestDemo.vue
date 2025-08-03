<script setup>
import { ref } from 'vue'

const name = ref('')
const email = ref('')
const company = ref('')
const message = ref('')
const isSubmitting = ref(false)
const isSuccess = ref(false)
const error = ref(null)

const submitForm = async () => {
  try {
    isSubmitting.value = true
    error.value = null
    
    const response = await fetch('/api/demo-request', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        name: name.value,
        email: email.value,
        company: company.value,
        message: message.value
      })
    })

    const data = await response.json()

    if (response.ok) {
      isSuccess.value = true
      setTimeout(() => isSuccess.value = false, 5000) // Auto-hide success
      name.value = ''
      email.value = ''
      company.value = ''
      message.value = ''
    } else {
      throw new Error(data.error || 'Submission failed')
    }
  } catch (err) {
    error.value = err.message || 'There was an error submitting your request. Please try again.'
    setTimeout(() => error.value = null, 5000) // Auto-hide error
  } finally {
    isSubmitting.value = false
  }
}
</script>


<template>
  <div class="w-full py-12 border-t border-orange-500/20">
    <div class="max-w-5xl mx-auto px-4 text-center">
      <h3
        class="text-3xl font-bold bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 bg-clip-text text-transparent mb-2">
        Request a Personalized Demo
      </h3>

      <div v-if="isSuccess" class="mb-8 p-4 bg-green-900/30 rounded-lg border border-green-500/50">
        <p class="text-green-300">Thank you! We've received your request and will contact you shortly.</p>
      </div>

      <div v-if="error" class="mb-8 p-4 bg-red-900/30 rounded-lg border border-red-500/50">
        <p class="text-red-300">{{ error }}</p>
      </div>

      <p v-if="!isSuccess && !error" class="text-orange-200 mb-8">
        Discover how Infinix AI can revolutionize your data workflows — all hosted locally on your servers.
      </p>

      <form @submit.prevent="submitForm" class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
        <!-- Form fields remain the same as before -->
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
          <button type="submit" :disabled="isSubmitting"
            class="bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold py-3 px-8 rounded-lg hover:scale-105 transition-transform disabled:opacity-70 disabled:cursor-not-allowed">
            <span v-if="!isSubmitting">Request Demo</span>
            <span v-else>Submitting...</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>