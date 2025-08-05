<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-orange-100 flex flex-col">
        <!-- <AppMainheader /> -->

        <div class="flex-1 max-w-3xl w-full mx-auto px-4 py-8 overflow-hidden">
            <h1 class="text-3xl font-bold text-orange-300 mb-6 text-center">InfinixAI - Chat</h1>

            <!-- Chat window -->
            <div ref="chatWindow"
                class="bg-gray-900 border border-orange-400/40 rounded-xl p-6 h-[500px] overflow-y-auto flex flex-col space-y-4">
                <div v-for="(chat, index) in chats" :key="index" class="flex"
                    :class="{ 'justify-end': chat.sender === 'user' }">
                    <div class="max-w-[80%] px-4 py-3 rounded-xl shadow-md" :class="chat.sender === 'user'
                        ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white self-end'
                        : 'bg-gray-800 border border-orange-400/20 text-orange-100 self-start'">
                        {{ chat.message }}
                    </div>
                </div>

                <!-- Typing indicator -->
                <div v-if="loading" class="self-start flex items-center space-x-1">
                    <div class="w-2 h-2 bg-orange-300 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-orange-300 rounded-full animate-bounce delay-150"></div>
                    <div class="w-2 h-2 bg-orange-300 rounded-full animate-bounce delay-300"></div>
                </div>
            </div>

            <!-- Chat input -->
            <div class="mt-6 flex items-center space-x-4">
                <input v-model="newMessage" @keyup.enter="sendMessage"
                    class="flex-1 p-4 rounded-lg bg-gray-800 border border-orange-400/40 focus:ring-2 focus:ring-orange-500 text-orange-100"
                    placeholder="Type your message..." />
                <button @click="sendMessage" :disabled="!newMessage.trim() || loading"
                    class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-3 rounded-lg disabled:opacity-50">
                    {{ loading ? '...' : 'Send' }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const newMessage = ref('')
const chatHistory = ref([]) // ✅ Needed
const isLoading = ref(false) // ✅ Needed

const sendMessage = async () => {
  if (!newMessage.value.trim()) return;

  chatHistory.value.push({ role: 'user', text: newMessage.value });
  const userMessage = newMessage.value;
  newMessage.value = '';
  isLoading.value = true;

  try {
    const response = await axios.post('/proxy-ml-chat', {
      message: userMessage
    });

    const reply = response.data.response || '⚠️ No response from model.';
    chatHistory.value.push({ role: 'ai', text: reply });
  } catch (error) {
    console.error('❌ Chat error:', error);
    chatHistory.value.push({ role: 'ai', text: '❌ Server error or ML not reachable.' });
  } finally {
    isLoading.value = false;
  }
};
</script>
