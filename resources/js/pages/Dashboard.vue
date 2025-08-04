<template>
    <div class="bg-black">
        <!-- Header -->
        <div class="shadow-sm border-b border-orange-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex ">
                <a href="/">
                    <img src="../../../public/logo.png" href="#" alt="InfinixAI Logo" class="h-16 mx-auto my-4">
                </a>
                <div class="flex items-center justify-end w-full">

                    <span class="text-sm text-orange-300">{{ uploadHistory.length }} documents uploaded</span>
                    <button @click="logout"
                        class="px-4 py-2 text-orange-400 hover:bg-orange-500 hover:text-white rounded-lg transition-colors">
                        Logout
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto h-[80vh] px-4 sm:px-6 lg:px-8 py-8">
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

            <!-- Action Buttons -->
            <div class="grid md:grid-cols-2 gap-6 mb-12">
                <!-- Upload Documents -->
                <button @click="showUploadModal = true"
                    class="p-8  border border-orange-400/40 text-orange-100 rounded-xl shadow-sm  hover:border-orange-500 hover:shadow-lg transition-all duration-400 group">
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

                <!-- Chat with AI -->
                <button @click="startChat"
                    class="p-8  border border-orange-400/40 text-orange-100 rounded-xl shadow-sm  hover:border-orange-500 hover:shadow-lg transition-all duration-400 group">
                    <div class="flex items-center justify-center mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <img src="../../../public/logo2.png" alt="InfinixAI Logo" class="h-12 mx-auto my-4">

                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-orange-300 mb-2">Chat with AI</h3>
                    <p class="text-orange-100">Get insights from your documents</p>
                </button>
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
                        <h3 class="text-2xl font-bold text-gray-900">Upload PDF Documents</h3>
                    </div>

                    <p class="text-gray-600 mb-6">Upload your PDF documents to create your knowledge base</p>

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
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Drop your PDF here</h4>
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
                class=" shadow-sm border border-orange-400/40 rounded-xl hover:border-orange-400 transition-all duration-500 group hover:shadow-sm p-8">
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
                <div v-if="uploadHistory.length > 0" class="space-y-3 ">
                    <div v-for="doc in uploadHistory" :key="doc.path"
                        class="flex items-center justify-between p-4 bg-gray-800/50 border  border-orange-400/30 rounded-xl hover:bg-gray-800/70 hover:border-orange-500 transition-all duration-400 group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-900/50 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
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
                <div v-else class="text-center py-12 ">
                    <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-medium text-orange-300 mb-2">No documents uploaded yet</h4>
                    <p class="text-orange-100 mb-4">Upload your first PDF document to get started</p>
                    <button @click="showUploadModal = true"
                        class="px-6 py-3 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500 text-white rounded-lg hover:shadow-lg transition-all">
                        Upload Document
                    </button>
                </div>
            </div>
        </main>

        <!-- Footer with logout -->

    </div>
    <AppFooter />
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios, { type AxiosError, type AxiosResponse } from 'axios';
import AppMainheader from './AppMainheader.vue';
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
    const token = meta?.getAttribute('content') || '';

    // If no token found, try to refresh it
    if (!token) {
        console.warn('CSRF token not found, attempting to refresh...');
        refreshCsrfToken();
    }

    return token;
};

const refreshCsrfToken = async (): Promise<string> => {
    try {
        const response = await axios.get('/csrf-token');
        const newToken = response.data.csrf_token;

        // Update the meta tag
        const meta = document.querySelector('meta[name="csrf-token"]');
        if (meta) {
            meta.setAttribute('content', newToken);
        }

        return newToken;
    } catch (error) {
        console.error('Failed to refresh CSRF token:', error);
        return '';
    }
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

const handleDrop = (event: DragEvent) => {
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
        const startTime = Date.now();
        let csrfToken = getCsrfToken();

        const response: AxiosResponse<UploadResponse> = await axios.post('/upload-pdf', formData, {
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
            },
            timeout: 60000
        });

        console.log(`Upload completed in ${Date.now() - startTime}ms`);

        if (response.data.success) {
            uploadMessage.value = response.data.message;
            savedFilePath.value = response.data.original_name;
            fileUrl.value = response.data.url || '';

            // Add to history
            uploadHistory.value.unshift({
                name: response.data.original_name,
                size: file.value.size,
                date: new Date(),
                path: response.data.path || ''
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
            throw new Error(response.data.message || 'Upload failed');
        }
    } catch (error: unknown) {
        // Handle CSRF token mismatch specifically
        if (axios.isAxiosError(error) && error.response?.status === 419) {
            console.log('CSRF token mismatch, refreshing token and retrying...');
            try {
                const newToken = await refreshCsrfToken();
                if (newToken) {
                    // Retry the upload with new token
                    const retryResponse: AxiosResponse<UploadResponse> = await axios.post('/upload-pdf', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-CSRF-TOKEN': newToken
                        },
                        onUploadProgress: (progressEvent) => {
                            if (progressEvent.total) {
                                uploadProgress.value = Math.round(
                                    (progressEvent.loaded * 100) / progressEvent.total
                                );
                            }
                        },
                        timeout: 60000
                    });

                    if (retryResponse.data.success) {
                        uploadMessage.value = retryResponse.data.message;
                        savedFilePath.value = retryResponse.data.original_name;
                        fileUrl.value = retryResponse.data.url || '';

                        // Add to history
                        uploadHistory.value.unshift({
                            name: retryResponse.data.original_name,
                            size: file.value.size,
                            date: new Date(),
                            path: retryResponse.data.path || ''
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
                        return; // Success on retry
                    }
                }
            } catch (retryError) {
                console.error('Retry after CSRF refresh failed:', retryError);
                uploadError.value = 'Session expired. Please refresh the page and try again.';
                return;
            }
        }

        handleUploadError(error);
    } finally {
        isUploading.value = false;
    }
};

const handleUploadError = (error: unknown) => {
    if (axios.isAxiosError(error)) {
        uploadError.value = error.response?.data?.message ||
            error.message ||
            'Network error occurred';

        console.error('Upload failed:', {
            status: error.response?.status,
            data: error.response?.data,
            config: error.config
        });
    } else if (error instanceof Error) {
        uploadError.value = error.message;
    } else {
        uploadError.value = 'An unknown error occurred';
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
    window.open(`/storage/${path}`, '_blank');
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

// Navigation
const startChat = () => {
    if (uploadHistory.value.length === 0) {
        alert('Please upload at least one document before starting a chat!');
        return;
    }
    // Redirect to chat page or open chat interface
    window.location.href = '/chat'; // Adjust this URL as needed
};

const logout = async () => {
    if (confirm('Are you sure you want to logout?')) {
        try {
            await axios.post('/logout', {}, {
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken()
                }
            });
            // Redirect to login page
            window.location.href = '/login';
        } catch (error) {
            console.error('Logout failed:', error);
            // Force redirect even if logout request fails
            window.location.href = '/login';
        }
    }
};
</script>