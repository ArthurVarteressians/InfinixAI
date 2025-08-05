<template>
    <div class="bg-black">
        <!-- Header -->
        <div class="shadow-sm border-b border-orange-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex">
                <a href="/">
                    <img src="/logo.png" alt="InfinixAI Logo" class="h-16 mx-auto my-4">
                </a>
                <div class="flex items-center justify-end w-full space-x-4">
                    <span class="text-sm text-orange-300">{{ uploadHistory.length }} documents uploaded</span>
                    <button @click="logout"
                        class="px-4 py-2 text-orange-400 hover:bg-orange-500 hover:text-white rounded-lg transition-colors">
                        Logout
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <h2
                    class="text-4xl font-bold mb-4 bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 bg-clip-text text-transparent">
                    Your AI Knowledge Assistant
                </h2>
                <p class="text-xl text-orange-200 max-w-2xl mx-auto">
                    Upload documents and chat with your personal AI to get instant insights
                </p>
            </div>

            <!-- AI Assistants Section -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-orange-300 mb-6 text-center">Choose Your AI Assistant</h3>


                <!-- Quick Actions -->
                <div class="grid md:grid-cols-2 gap-6 mb-12">
                    <!-- Upload Documents -->
                    <button @click="showUploadModal = true"
                        class="p-8 border border-orange-400/40 text-orange-100 rounded-xl shadow-sm hover:border-orange-500 hover:shadow-lg transition-all duration-400 group">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-orange-300 mb-2">Upload Documents</h3>
                        <p class="text-orange-100">Add documents to your knowledge base</p>
                    </button>

                    <!-- Quick Chat -->
                    <button @click="startQuickChat"
                        class="p-8 border border-orange-400/40 text-orange-100 rounded-xl shadow-sm hover:border-orange-500 hover:shadow-lg transition-all duration-400 group">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <img src="/logo2.png" alt="InfinixAI Logo" class="h-10">
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-orange-300 mb-2">Quick Chat</h3>
                        <p class="text-orange-100">Ask any questions here</p>
                    </button>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- PDF Document Assistant -->
                    <button @click="startPDFChat"
                        class="p-6 border border-orange-400/40 text-orange-100 rounded-xl shadow-sm hover:border-orange-500 hover:shadow-lg transition-all duration-400 group">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-orange-300 mb-2">PDF Assistant</h4>
                        <p class="text-orange-100 text-sm">Chat with your PDF documents</p>
                    </button>

                    <!-- Voice Assistant -->
                    <button @click="startVoiceChat"
                        class="p-6 border border-orange-400/40 text-orange-100 rounded-xl shadow-sm hover:border-orange-500 hover:shadow-lg transition-all duration-400 group">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-orange-300 mb-2">Voice Assistant</h4>
                        <p class="text-orange-100 text-sm">Speak and get AI responses</p>
                    </button>

                    <!-- Image Analysis Assistant -->
                    <button @click="startImageChat"
                        class="p-6 border border-orange-400/40 text-orange-100 rounded-xl shadow-sm hover:border-orange-500 hover:shadow-lg transition-all duration-400 group">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-orange-300 mb-2">Image Assistant</h4>
                        <p class="text-orange-100 text-sm">Analyze and discuss images</p>
                    </button>

                    <!-- Code Assistant -->
                    <button @click="startCodeChat"
                        class="p-6 border border-orange-400/40 text-orange-100 rounded-xl shadow-sm hover:border-orange-500 hover:shadow-lg transition-all duration-400 group">
                        <div class="flex items-center justify-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-orange-300 mb-2">Code Assistant</h4>
                        <p class="text-orange-100 text-sm">Get help with programming</p>
                    </button>
                </div>
            </div>







            <!-- Assistant Selector Modal -->
            <div v-if="showAssistantSelector"
                class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-gray-900 rounded-2xl p-8 max-w-4xl w-full mx-4 relative border border-orange-400/40">
                    <button @click="showAssistantSelector = false"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <h3 class="text-2xl font-bold text-orange-300 mb-6 text-center">Select AI Assistant</h3>
                    <p class="text-orange-100 mb-8 text-center">Choose the type of assistance you need</p>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- PDF Assistant -->
                        <button @click="selectAssistant('pdf')"
                            class="p-6 bg-gray-800/50 border border-orange-400/30 rounded-xl hover:bg-gray-800/70 hover:border-orange-500 transition-all duration-300 group text-left">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-orange-300">PDF Document Assistant</h4>
                            </div>
                            <p class="text-orange-100 text-sm">Upload PDF documents and ask questions about their
                                content. Perfect for research, document analysis, and extracting insights.</p>
                        </button>

                        <!-- Voice Assistant -->
                        <button @click="selectAssistant('voice')"
                            class="p-6 bg-gray-800/50 border border-orange-400/30 rounded-xl hover:bg-gray-800/70 hover:border-orange-500 transition-all duration-300 group text-left">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-orange-300">Voice Assistant</h4>
                            </div>
                            <p class="text-orange-100 text-sm">Speak naturally and get AI responses. Voice-to-text
                                conversion with intelligent conversation capabilities.</p>
                        </button>

                        <!-- Image Assistant -->
                        <button @click="selectAssistant('image')"
                            class="p-6 bg-gray-800/50 border border-orange-400/30 rounded-xl hover:bg-gray-800/70 hover:border-orange-500 transition-all duration-300 group text-left">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-orange-300">Image Analysis Assistant</h4>
                            </div>
                            <p class="text-orange-100 text-sm">Upload images for AI analysis. Get descriptions, extract
                                text, identify objects, and ask questions about visual content.</p>
                        </button>

                        <!-- Code Assistant -->
                        <button @click="selectAssistant('code')"
                            class="p-6 bg-gray-800/50 border border-orange-400/30 rounded-xl hover:bg-gray-800/70 hover:border-orange-500 transition-all duration-300 group text-left">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-orange-300">Code Assistant</h4>
                            </div>
                            <p class="text-orange-100 text-sm">Get help with programming tasks. Code review, debugging,
                                optimization, and learning new technologies.</p>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Upload Modal -->
            <div v-if="showUploadModal"
                class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
                <div class="bg-white rounded-2xl p-8 max-w-2xl w-full mx-4 relative max-h-[90vh] overflow-y-auto">
                    <button @click="closeUploadModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="flex items-center mb-6">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Upload Documents</h3>
                    </div>

                    <p class="text-gray-600 mb-6">Upload your documents to create your knowledge base</p>

                    <!-- Upload Area -->
                    <div @dragover.prevent @drop.prevent="handleDrop"
                        class="border-2 border-dashed border-gray-300 rounded-xl p-12 text-center hover:border-orange-500 transition-colors mb-6">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 opacity-80">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Drop your documents here</h4>
                        <p class="text-gray-500 mb-4">or click to browse</p>
                        <button @click="triggerFileInput" :disabled="isUploading"
                            class="px-6 py-3 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 text-white rounded-lg hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                            {{ isUploading ? 'Uploading...' : 'Choose File' }}
                        </button>
                        <input ref="fileInput" type="file" accept=".pdf" @change="handleFileChange" class="hidden">
                    </div>

                    <!-- Progress Bar -->
                    <div v-if="isUploading" class="mb-6">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 h-2.5 rounded-full transition-all duration-400"
                                :style="{ width: uploadProgress + '%' }"></div>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-sm text-gray-600">Uploading...</span>
                            <span class="text-xs text-gray-500">{{ uploadProgress }}%</span>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="mb-6">
                        <div v-if="uploadMessage" class="p-3 bg-green-50 text-green-700 rounded-lg text-sm mb-3">
                            {{ uploadMessage }}
                            <p v-if="savedFilePath" class="mt-1 text-green-600 text-xs">
                                Saved as: {{ savedFilePath }}
                            </p>
                            <p v-if="fileUrl" class="mt-1">
                                <a :href="fileUrl" target="_blank" class="text-blue-600 hover:underline">View PDF</a>
                            </p>
                        </div>
                        <div v-if="uploadError" class="p-3 bg-red-50 text-red-700 rounded-lg text-sm">
                            {{ uploadError }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Section -->
            <div
                class="shadow-sm border border-orange-400/40 rounded-xl hover:border-orange-400 transition-all duration-500 group hover:shadow-sm p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3
                            class="text-2xl font-bold bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 bg-clip-text text-transparent">
                            Uploaded Documents</h3>
                    </div>
                    <span class="text-sm text-orange-300">
                        {{ uploadHistory.length > 0 ? 'Your knowledge base is ready for questions' : 'No documents yet'
                        }}
                    </span>
                </div>

                <!-- Document List -->
                <div v-if="uploadHistory.length > 0" class="space-y-3">
                    <div v-for="doc in uploadHistory" :key="doc.path"
                        class="flex items-center justify-between p-4 bg-gray-800/50 border border-orange-400/30 rounded-xl hover:bg-gray-800/70 hover:border-orange-500 transition-all duration-400 group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-900/50 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 01-2-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-orange-200">{{ doc.name }}</h4>
                                <p class="text-sm text-orange-300/70">{{ formatFileSize(doc.size) }} • {{
                                    formatDate(doc.date) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="bg-green-100 text-green-700 px-3 py-1 text-xs rounded-full font-medium">
                                Processed
                            </span>
                            <button @click="downloadFile(doc.path)"
                                class="text-orange-400 hover:text-orange-300 transition-colors mr-2" title="Download">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-4-4m4 4l4-4m3 8H5a2 2 0 01-2-2V8a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                </svg>
                            </button>
                            <button @click="removeDocument(doc.path)"
                                class="text-gray-400 hover:text-red-400 transition-colors" title="Remove">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-medium text-orange-300 mb-2">No documents uploaded yet</h4>
                    <p class="text-orange-100 mb-4">Upload your first document to get started</p>
                    <button @click="showUploadModal = true"
                        class="px-6 py-3 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 text-white rounded-lg hover:shadow-lg transition-all">
                        Upload Document
                    </button>
                </div>
            </div>
        </main>
    </div>
    <AppFooter />
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import AppFooter from './AppFooter.vue';

interface UploadResponse {
    success: boolean;
    message: string;
    path?: string;
    url?: string;
    original_name: string;
    size?: number;
}

interface UploadHistoryItem {
    name: string;
    size: number;
    date: Date;
    path: string;
}

// State
const showUploadModal = ref(false);
const showAssistantSelector = ref(false);
const fileInput = ref<HTMLInputElement | null>(null);
const file = ref<File | null>(null);
const isUploading = ref(false);
const uploadProgress = ref(0);
const uploadMessage = ref('');
const uploadError = ref('');
const savedFilePath = ref('');
const fileUrl = ref('');
const uploadHistory = ref<UploadHistoryItem[]>([]);

// Helper functions
const getCsrfToken = (): string => {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta?.getAttribute('content') || '';
};

const formatFileSize = (bytes: number): string => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
};

const formatDate = (date: Date): string => {
    return new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }).format(date);
};

const resetMessages = () => {
    uploadMessage.value = '';
    uploadError.value = '';
};

// File handling
const triggerFileInput = () => {
    fileInput.value?.click();
};

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const selectedFile = target.files?.[0];
    if (selectedFile && selectedFile.type === 'application/pdf') {
        file.value = selectedFile;
        uploadPdf();
    } else if (selectedFile) {
        uploadError.value = 'Please select a PDF file';
    }
    resetMessages();
};

const startQuickChat = () => {
    window.location.href = '/chat';
};

const handleDrop = (event: DragEvent) => {
    event.preventDefault();
    const droppedFile = event.dataTransfer?.files[0];
    if (droppedFile && droppedFile.type === 'application/pdf') {
        file.value = droppedFile;
        uploadPdf();
    } else if (droppedFile) {
        uploadError.value = 'Please drop a PDF file';
    }
};

// Upload functionality
const uploadPdf = async () => {
    if (!file.value) {
        uploadError.value = 'Please select a PDF file first';
        return;
    }

    isUploading.value = true;
    uploadProgress.value = 0;
    resetMessages();
    savedFilePath.value = '';
    fileUrl.value = '';

    const formData = new FormData();
    formData.append('pdf', file.value);

    try {
        const csrfToken = getCsrfToken();
        if (!csrfToken) {
            throw new Error('CSRF token not found');
        }

        const response = await axios.post('/upload-pdf', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-CSRF-TOKEN': csrfToken
            },
            onUploadProgress: (progressEvent) => {
                if (progressEvent.total) {
                    uploadProgress.value = Math.round(
                        (progressEvent.loaded * 100) / progressEvent.total
                    );
                }
            }
        });

        const data = response.data as UploadResponse;
        if (data.success) {
            uploadMessage.value = data.message;
            savedFilePath.value = data.original_name;
            fileUrl.value = data.url || '';

            // Add to history
            uploadHistory.value.unshift({
                name: data.original_name,
                size: file.value!.size,
                date: new Date(),
                path: data.path || ''
            });

            // Keep only last 10 uploads
            if (uploadHistory.value.length > 10) {
                uploadHistory.value = uploadHistory.value.slice(0, 10);
            }

            // Reset file input
            file.value = null;
            if (fileInput.value) {
                fileInput.value.value = '';
            }
        } else {
            throw new Error(data.message || 'Upload failed');
        }
    } catch (error: unknown) {
        if (axios.isAxiosError(error)) {
            uploadError.value = error.response?.data?.message ||
                error.message ||
                'Network error occurred';
        } else if (error instanceof Error) {
            uploadError.value = error.message;
        } else {
            uploadError.value = 'An unknown error occurred';
        }
    } finally {
        isUploading.value = false;
    }
};

// Document management
const removeDocument = (path: string) => {
    if (confirm('Are you sure you want to remove this document?')) {
        uploadHistory.value = uploadHistory.value.filter(doc => doc.path !== path);
    }
};

const downloadFile = (path: string) => {
    if (!path) return;
    window.open(`/storage/pdfs/${path}`, '_blank');
};

// Modal management
const closeUploadModal = () => {
    showUploadModal.value = false;
    resetMessages();
    file.value = null;
    if (fileInput.value) {
        fileInput.value.value = '';
    }
};

// Assistant functions
const selectAssistant = (type: string) => {
    showAssistantSelector.value = false;
    switch (type) {
        case 'pdf':
            startPDFChat();
            break;
        case 'voice':
            startVoiceChat();
            break;
        case 'image':
            startImageChat();
            break;
        case 'code':
            startCodeChat();
            break;
    }
};

const startPDFChat = () => {
    if (uploadHistory.value.length === 0) {
        alert('Please upload at least one document before starting a chat!');
        return;
    }
    window.location.href = '/chat/pdf';
};

const startVoiceChat = () => {
    window.location.href = '/chat/voice';
};

const startImageChat = () => {
    window.location.href = '/chat/image';
};

const startCodeChat = () => {
    window.location.href = '/chat/code';
};

// Navigation
const logout = async () => {
    if (confirm('Are you sure you want to logout?')) {
        try {
            await axios.post('/logout', {}, {
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            });
            window.location.href = '/login';
        } catch (error) {
            console.error('Logout failed:', error);
            window.location.href = '/login';
        }
    }
};
</script>