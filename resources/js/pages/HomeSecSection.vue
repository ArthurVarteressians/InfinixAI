<script setup>
import CardSwap from './../../../src/blocks/BG2/CardSwap.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="relative bg-black min-h-screen w-full">
        <div class="container mx-auto px-6 py-20 h-full flex flex-col lg:flex-row items-center justify-center gap-12">
            <!-- Text Content -->
            <div class="lg:w-1/2 text-center lg:text-left">
                <h2 class="text-4xl md:text-5xl font-bold mb-8 text-orange-400">
                    Why Choose Infinix AI?
                </h2>
                <p class="text-xl text-orange-100 mb-6">
                    Our cutting-edge technology delivers exceptional results through:
                </p>
                <ul class="space-y-4 text-lg text-orange-200">
                    <li class="flex items-start">
                        <span class="text-orange-400 mr-3">•</span>
                        <span>Customizable solutions tailored to your needs</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-orange-400 mr-3">•</span>
                        <span>Reliable performance with 99.9% uptime</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-orange-400 mr-3">•</span>
                        <span>Smooth, intuitive user experience</span>
                    </li>
                </ul>
            </div>

            <!-- Cards -->
            <div class="lg:w-1/2 flex justify-center">
                <CardSwap :width="280" :height="180" :card-distance="40" :vertical-distance="30" class="mx-auto">
                    <template #card-0>
                        <div
                            class="h-full bg-gradient-to-br from-orange-500/20 to-red-500/20 border-2 border-orange-400/50 rounded-xl p-6 flex flex-col items-center justify-center">
                            <h3 class="text-xl font-bold text-white mb-2">Customizable</h3>
                            <p class="text-orange-200 text-center">Tailored to your needs</p>
                        </div>
                    </template>
                    <template #card-1>
                        <div
                            class="h-full bg-gradient-to-br from-orange-600/20 to-red-600/20 border-2 border-red-400/50 rounded-xl p-6 flex flex-col items-center justify-center">
                            <h3 class="text-xl font-bold text-white mb-2">Reliable</h3>
                            <p class="text-orange-200 text-center">Consistent performance</p>
                        </div>
                    </template>
                    <template #card-2>
                        <div
                            class="h-full bg-gradient-to-br from-orange-400/20 to-red-400/20 border-2 border-orange-300/50 rounded-xl p-6 flex flex-col items-center justify-center">
                            <h3 class="text-xl font-bold text-white mb-2">Smooth</h3>
                            <p class="text-orange-200 text-center">Seamless experience</p>
                        </div>
                    </template>
                </CardSwap>
            </div>
        </div>
    </div>
</template>