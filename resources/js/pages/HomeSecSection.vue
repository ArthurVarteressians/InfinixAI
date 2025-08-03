<script setup>
import CardSwap from './../../../src/blocks/BG2/CardSwap.vue'
import { FileUp, MessageCircle, ShieldCheck } from 'lucide-vue-next'
import RequestDemo from './RequestDemo.vue'
import AppFooter from './AppFooter.vue';
</script>

<template>
    <div class="relative bg-black w-full flex flex-col border-t border-orange-800 justify-between overflow-x-hidden">
        <div class="container mx-auto px-4 sm:px-6 py-10 flex flex-col justify-around lg:flex-row items-center gap-40">
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
                        solutions with our ML models</li>
                    <li class="flex items-start"><span class="text-orange-400 mr-3">✔</span> 99.9% uptime guaranteed
                    </li>
                    <li class="flex items-start"><span class="text-orange-400 mr-3">✔</span> Intuitive and fast user
                        experience</li>
                </ul>
            </div>

            <!-- Cards Section -->
            <div class=" flex justify-start overflow-visible bg-red-200">
                <CardSwap>
                    <template #card-0>
                        <div
                            class="card-item card-1 h-full w-full border-2 border-orange-400/60 rounded-xl p-6 flex flex-col items-center justify-center bg-gradient-to-br from-yellow-900/20 to-orange-800/10">
                            <div class="icon-container">
                                <FileUp class="w-10 h-10 text-orange-400 mb-4" />
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">Upload Documents</h3>
                            <p class="text-orange-200 text-center text-sm">
                                Upload your PDFs and let our AI understand them — privately on your own server.
                            </p>
                        </div>
                    </template>

                    <template #card-1>
                        <div
                            class="card-item card-2 h-full w-full border-2 border-yellow-400/60 rounded-xl p-6 flex flex-col items-center justify-center bg-gradient-to-br from-orange-600/20 to-yellow-700/10">
                            <div class="icon-container">
                                <MessageCircle class="w-10 h-10 text-yellow-400 mb-4" />
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">Ask Questions</h3>
                            <p class="text-orange-200 text-center text-sm">
                                Interact naturally with your data — no cloud dependency, everything stays local.
                            </p>
                        </div>
                    </template>

                    <template #card-2>
                        <div
                            class="card-item card-3 h-full w-full border-2 border-red-400/60 rounded-xl p-6 flex flex-col items-center justify-center bg-gradient-to-br from-red-500/20 to-orange-700/10">
                            <div class="icon-container">
                                <ShieldCheck class="w-10 h-10 text-red-400 mb-4" />
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">Get Insights</h3>
                            <p class="text-orange-200 text-center text-sm">
                                Dive deep with AI-powered insights — always private, always on your server.
                            </p>
                        </div>
                    </template>
                </CardSwap>
            </div>

        </div>
        <div class="w-full px-4 py-8">
            <div
                class="max-w-3xl mx-auto bg-gradient-to-br mt-20 from-orange-900/30 to-red-900/30 rounded-xl p-8 border border-orange-800/50">
                <h3 class="text-2xl font-bold bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 bg-clip-text text-transparent mb-4 text-center">Complete Data Sovereignty</h3>
                <div class="grid md:grid-cols-2 gap-6 items-center">
                    <div>
                        <p class="text-orange-100 mb-4">
                            Infinix AI operates entirely within your infrastructure, your data never leaves your private
                            network.
                            Our on-premise solution delivers enterprise grade AI while maintaining absolute data
                            control.
                        </p>
                        <p class="text-orange-200">
                            Experience it yourself with our 1 week trial of Local Intelligence no commitments, no data
                            sharing.
                        </p>
                    </div>
                    <div class="bg-black/40 p-4 rounded-lg border border-orange-800/30">
                        <p class="text-orange-100 mb-3 font-medium">Get started today:</p>
                        <ul class="text-orange-200 space-y-2">
                            <li class="flex items-start">
                                <span class="text-orange-400 mr-2">•</span> Free 7-day local deployment trial
                            </li>
                            <li class="flex items-start">
                                <span class="text-orange-400 mr-2">•</span> Full technical specifications
                            </li>
                            <li class="flex items-start">
                                <span class="text-orange-400 mr-2">•</span> 1-on-1 architecture consultation
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Request Demo Section -->
        <div class=" mt-[10vh]">

            <RequestDemo />

        </div>

        <AppFooter />
    </div>
</template>

<style scoped>
/* Icon animations */
.icon-container {
    position: relative;
    display: inline-block;
}

.icon-container::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    transform: translate(-50%, -50%);
    z-index: 0;
    opacity: 0;
    transition: all 0.5s ease;
}

.card-1 .icon-container::before {
    background: radial-gradient(rgba(251, 191, 36, 0.4), transparent 70%);
}

.card-2 .icon-container::before {
    background: radial-gradient(rgba(245, 158, 11, 0.4), transparent 70%);
}

.card-3 .icon-container::before {
    background: radial-gradient(rgba(239, 68, 68, 0.4), transparent 70%);
}

.card-item:hover .icon-container::before {
    opacity: 1;
    width: 80px;
    height: 80px;
}

.card-1 .icon-container svg {
    animation: float-pulse-1 4s ease-in-out infinite;
}

.card-2 .icon-container svg {
    animation: float-pulse-2 4s ease-in-out infinite 0.5s;
}

.card-3 .icon-container svg {
    animation: float-pulse-3 4s ease-in-out infinite 1s;
}

@keyframes float-pulse-1 {
    0% {
        transform: translateY(0) rotate(0deg);
        filter: drop-shadow(0 0 5px rgba(251, 191, 36, 0.6));
    }

    25% {
        transform: translateY(-8px) rotate(-5deg);
        filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.8));
    }

    50% {
        transform: translateY(0) rotate(0deg);
        filter: drop-shadow(0 0 5px rgba(251, 191, 36, 0.6));
    }

    75% {
        transform: translateY(-8px) rotate(5deg);
        filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.8));
    }

    100% {
        transform: translateY(0) rotate(0deg);
        filter: drop-shadow(0 0 5px rgba(251, 191, 36, 0.6));
    }
}

@keyframes float-pulse-2 {
    0% {
        transform: translateY(0) scale(1);
        filter: drop-shadow(0 0 5px rgba(245, 158, 11, 0.6));
    }

    25% {
        transform: translateY(-8px) scale(1.1);
        filter: drop-shadow(0 0 10px rgba(245, 158, 11, 0.8));
    }

    50% {
        transform: translateY(0) scale(1);
        filter: drop-shadow(0 0 5px rgba(245, 158, 11, 0.6));
    }

    75% {
        transform: translateY(-8px) scale(1.1);
        filter: drop-shadow(0 0 10px rgba(245, 158, 11, 0.8));
    }

    100% {
        transform: translateY(0) scale(1);
        filter: drop-shadow(0 0 5px rgba(245, 158, 11, 0.6));
    }
}

@keyframes float-pulse-3 {
    0% {
        transform: translateY(0) rotate(0deg);
        filter: drop-shadow(0 0 5px rgba(239, 68, 68, 0.6));
    }

    25% {
        transform: translateY(-8px) rotate(0deg);
        filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.8));
    }

    50% {
        transform: translateY(0) rotate(0deg);
        filter: drop-shadow(0 0 5px rgba(239, 68, 68, 0.6));
    }

    75% {
        transform: translateY(-8px) rotate(0deg);
        filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.8));
    }

    100% {
        transform: translateY(0) rotate(0deg);
        filter: drop-shadow(0 0 5px rgba(239, 68, 68, 0.6));
    }
}

/* Card hover effects */
.card-item {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transform-origin: center;
    backface-visibility: hidden;
    will-change: transform;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.card-1:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow:
        0 15px 35px rgba(251, 191, 36, 0.4),
        0 5px 15px rgba(245, 158, 11, 0.3),
        inset 0 0 15px rgba(251, 191, 36, 0.2);
    z-index: 50;
}

.card-2:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow:
        0 15px 35px rgba(245, 158, 11, 0.4),
        0 5px 15px rgba(239, 108, 0, 0.3),
        inset 0 0 15px rgba(245, 158, 11, 0.2);
    z-index: 50;
}

.card-3:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow:
        0 15px 35px rgba(239, 68, 68, 0.4),
        0 5px 15px rgba(220, 38, 38, 0.3),
        inset 0 0 15px rgba(239, 68, 68, 0.2);
    z-index: 50;
}

/* Background glow effect */
.card-item::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg,
            rgba(251, 191, 36, 0.1),
            rgba(245, 158, 11, 0.1),
            rgba(239, 68, 68, 0.1));
    z-index: -1;
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.card-item:hover::before {
    opacity: 1;
}

/* Floating animation for cards when not active */
@keyframes subtle-float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-8px);
    }
}

.card-swap-card:nth-child(1) {
    animation: subtle-float 6s ease-in-out infinite;
}

.card-swap-card:nth-child(2) {
    animation: subtle-float 6s ease-in-out infinite 2s;
}

.card-swap-card:nth-child(3) {
    animation: subtle-float 6s ease-in-out infinite 4s;
}
</style>