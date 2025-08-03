<script setup>
import CardSwap from './../../../src/blocks/BG2/CardSwap.vue'
import { FileUp, MessageCircle, ShieldCheck } from 'lucide-vue-next'
import RequestDemo from './RequestDemo.vue'
import AppFooter from './AppFooter.vue';
</script>

<template>
    <div class="relative bg-black w-full min-h-screen flex flex-col justify-around overflow-x-hidden">
        <div class="container mx-auto px-4 sm:px-6 py-10 flex flex-col lg:flex-row items-center gap-12">
            <!-- Text Content -->
            <div class="lg:w-1/2 text-center lg:text-left">
                <h2
                    class="text-4xl md:text-5xl font-extrabold mb-6 bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 bg-clip-text text-transparent">
                    Your AI. Your Server. Zero Compromise.
                </h2>
                <p class="text-base md:text-lg text-orange-100 mb-4">
                    Infinix AI runs entirely on your infrastructure — keeping your data private while unlocking powerful
                    AI capabilities.
                </p>
                <ul class="space-y-3 text-sm md:text-base text-orange-200 mt-4">
                    <li class="flex items-start"><span class="text-orange-400 mr-3">✔</span> Customizable & modular
                        solutions</li>
                    <li class="flex items-start"><span class="text-orange-400 mr-3">✔</span> 99.9% uptime guaranteed
                    </li>
                    <li class="flex items-start"><span class="text-orange-400 mr-3">✔</span> Intuitive and fast user
                        experience</li>
                </ul>
            </div>

            <!-- Cards Section -->
            <div class="lg:w-1/2 flex justify-center overflow-visible">
                <CardSwap>
                    <template #card-0>
                        <div
                            class="h-full w-full border-2 border-orange-400/60 rounded-xl p-6 flex flex-col items-center justify-center bg-gradient-to-br from-yellow-900/20 to-orange-800/10 transition-all duration-300 hover:scale-105">
                            <FileUp class="w-10 h-10 text-orange-400 mb-4 animate-bounce-slow" />
                            <h3 class="text-lg font-bold text-white mb-2">Upload Documents</h3>
                            <p class="text-orange-200 text-center text-sm">
                                Upload your PDFs and let our AI understand them — privately on your own server.
                            </p>
                        </div>
                    </template>

                    <template #card-1>
                        <div
                            class="h-full w-full border-2 border-yellow-400/60 rounded-xl p-6 flex flex-col items-center justify-center bg-gradient-to-br from-orange-600/20 to-yellow-700/10 transition-all duration-300 hover:scale-105">
                            <MessageCircle class="w-10 h-10 text-yellow-400 mb-4 animate-bounce-slow" />
                            <h3 class="text-lg font-bold text-white mb-2">Ask Questions</h3>
                            <p class="text-orange-200 text-center text-sm">
                                Interact naturally with your data — no cloud dependency, everything stays local.
                            </p>
                        </div>
                    </template>

                    <template #card-2>
                        <div
                            class="h-full w-full border-2 border-red-400/60 rounded-xl p-6 flex flex-col items-center justify-center bg-gradient-to-br from-red-500/20 to-orange-700/10 transition-all duration-300 hover:scale-105">
                            <ShieldCheck class="w-10 h-10 text-red-400 mb-4 animate-bounce-slow" />
                            <h3 class="text-lg font-bold text-white mb-2">Get Insights</h3>
                            <p class="text-orange-200 text-center text-sm">
                                Dive deep with AI-powered insights — always private, always on your server.
                            </p>
                        </div>
                    </template>
                </CardSwap>
            </div>
        </div>

        <!-- Request Demo Section -->
        <RequestDemo />
        <AppFooter />
    </div>
</template>

<style scoped>
@keyframes bounce-slow {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-4px);
    }
}

.animate-bounce-slow {
    animation: bounce-slow 3s infinite;
}
</style>