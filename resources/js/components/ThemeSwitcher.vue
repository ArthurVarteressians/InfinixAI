<script setup lang="ts">
import { ref, watch } from 'vue'
import { useAppearance } from '@/composables/useAppearance'

const { appearance, updateAppearance } = useAppearance()
const options = ['light', 'dark', 'system'] as const

const current = ref<typeof options[number]>(appearance.value)

watch(current, (val) => updateAppearance(val))
</script>

<template>
  <div class="flex items-center gap-2">
    <label for="theme" class="text-sm text-gray-600 dark:text-gray-300">Theme:</label>
    <select v-model="current" id="theme" class="rounded border px-2 py-1 text-sm">
      <option v-for="option in options" :key="option" :value="option">
        {{ option }}
      </option>
    </select>
  </div>
</template>
