<template>
    <div class="flex flex-col items-center justify-center p-4 border border-gray-300 rounded-lg shadow-md">
        <!-- File Input -->
        <label
            class="block w-full p-2 text-center bg-gray-100 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-200">
            <span class="text-sm font-medium text-gray-700">Upload file</span>
            <input type="file" class="hidden" @change="handleFileUpload" />
        </label>

        <!-- Show selected file name -->
        <div v-if="file" class="mt-2 text-gray-600">
            <p><strong>Selected file:</strong> {{ file.name }}</p>
        </div>
        <div v-if="errors" class="text-red-600 mt-2">
            {{ errors }}
        </div>

        <!-- Upload Button -->
        <button @click="submitFile" :disabled="!file"
            class="mt-2 px-4 py-1 text-white bg-sky-600 rounded-lg hover:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 disabled:opacity-50">
            Upload
            <fa :icon="['fas', 'spinner']" v-show="spin" class="animate-spin" />
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import router from '../../router';

// Props
const props = defineProps({
    itemId: {
        type: Number,
        required: true,
    },
});

// Reactive variables
const file = ref(null);
const errors = ref(null);
const spin = ref(null)

// Handle file input
const handleFileUpload = (event) => {
    file.value = event.target.files[0];
};

// Submit the file
const submitFile = async () => {
    setTimeout(() => {
        spin.value = true
    }, 1000);
    if (!file.value) return;

    const formData = new FormData();
    formData.append('file', file.value);

    try {
        const response = await axios.post(`/api/update-file/${props.itemId}`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',

                Authorization: "Bearer " + localStorage.getItem("token"),

            },
        });
        // console.log(response.data.message);

        window.location.href = '/my/nomor/selesai'
    } catch (error) {
        spin.value = false
        if (error.response) {
            if (error.response.status === 413) {
                // Jika error 413
                errors.value = 'File terlalu besar. Maksimal ukuran file adalah 2MB.';
            } else if (error.response.status === 422) {
                // Jika error validasi dari Laravel
                errors.value = error.response.data.errors.file[0];
            }
        }
    }
};
</script>

<style scoped>
/* Additional styles if needed */
</style>