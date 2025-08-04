<template>
    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">PDF Upload</h2>

        <!-- File Input -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Select PDF File
            </label>
            <input type="file" @change="handleFileChange" accept=".pdf" class="block w-full text-sm text-gray-500
               file:mr-4 file:py-2 file:px-4
               file:rounded-lg file:border-0
               file:text-sm file:font-semibold
               file:bg-blue-50 file:text-blue-700
               hover:file:bg-blue-100
               focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Upload Button -->
        <button @click="uploadPdf" :disabled="!file || isUploading" class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg
             hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500
             disabled:opacity-50 disabled:cursor-not-allowed
             transition-colors duration-200">
            <span v-if="!isUploading">Upload PDF</span>
            <span v-else class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Uploading...
            </span>
        </button>

        <!-- Progress Bar -->
        <div v-if="isUploading" class="mt-4">
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full" :style="{ width: uploadProgress + '%' }"></div>
            </div>
            <p class="text-xs text-gray-500 mt-1 text-right">{{ uploadProgress }}%</p>
        </div>

        <!-- Messages -->
        <div class="mt-4">
            <div v-if="uploadMessage" class="p-3 bg-green-50 text-green-700 rounded-lg text-sm">
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

        <!-- Upload History -->
        <div v-if="uploadHistory.length > 0" class="mt-6">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Recent Uploads</h3>
            <ul class="space-y-2">
                <li v-for="(item, index) in uploadHistory" :key="index"
                    class="text-xs text-gray-500 p-2 bg-gray-50 rounded hover:bg-gray-100 cursor-pointer"
                    @click="downloadFile(item.path)">
                    {{ item.name }} ({{ formatFileSize(item.size) }})
                    <span class="block text-gray-400">{{ formatDate(item.date) }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios, { type AxiosError, type AxiosProgressEvent, type AxiosResponse } from 'axios';

interface UploadResponse {
    success: boolean;
    message: string;
    path?: string;
    url?: string;
    original_name: string; // Add this property
    size?: number;        // Optional property
}

interface UploadHistoryItem {
    name: string;
    size: number;
    date: Date;
    path: string;
}

const file = ref<File | null>(null);
const isUploading = ref(false);
const uploadProgress = ref(0);
const uploadMessage = ref('');
const uploadError = ref('');
const savedFilePath = ref('');
const fileUrl = ref('');
const uploadHistory = ref<UploadHistoryItem[]>([]);

const getCsrfToken = (): string => {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta?.getAttribute('content') || '';
};

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    file.value = target.files?.[0] || null;
    resetMessages();
};

const resetMessages = () => {
    uploadMessage.value = '';
    uploadError.value = '';
};

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
        const response: AxiosResponse<UploadResponse> = await axios.post('/upload-pdf', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-CSRF-TOKEN': getCsrfToken()
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
            savedFilePath.value = response.data.original_name; // Show original name

            savedFilePath.value = response.data.path || '';
            fileUrl.value = response.data.url || '';

            // Add to history
            uploadHistory.value.unshift({
                name: response.data.original_name,
                size: file.value.size,
                date: new Date(),
                path: response.data.path || ''
            });

            // Keep only last 5 uploads
            if (uploadHistory.value.length > 5) {
                uploadHistory.value = uploadHistory.value.slice(0, 5);
            }
        } else {
            throw new Error(response.data.message || 'Upload failed');
        }
    } catch (error: unknown) {
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

const downloadFile = (path: string) => {
    if (!path) return;
    window.open(`/storage/${path}`, '_blank');
};
</script>



