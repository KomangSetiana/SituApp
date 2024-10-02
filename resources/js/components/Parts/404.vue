<template>
    <div v-show="not_found" class="flex flex-col items-center justify-center h-full p-6 bg-gray-100 rounded-lg">
        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m2 4H7m6-10a3 3 0 00-6 0v2H7m6-2V5m0 16a2 2 0 100-4 2 2 0 000 4zm6-2V7a2 2 0 00-2-2h-4m6 2a2 2 0 00-2-2h-4M9 5H5a2 2 0 00-2 2v10a2 2 0 002 2h6a2 2 0 002-2v-4" />
        </svg>
        <h2 class="text-lg font-semibold text-gray-700">Belum Ada Data</h2>
        <p class="text-gray-500">
            Saat ini tidak ada data yang tersedia untuk ditampilkan.
        </p>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
    not_found: {
        type: Boolean,
        default: false
    }
})</script>
