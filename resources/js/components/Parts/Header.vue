<template>
    <header class="flex justify-between items-center bg-sky-900 shadow-md p-4">
        <div v-if="showTitle" class="md:text-2xl md:block hidden text-yellow-400 font-bold">{{ title }}</div>

        <div class="text-white">
            <fa :icon="['fas', 'user']" /> {{ userName }}
        </div>

        <button @click="toggleSidebar" class="md:hidden text-yellow-400 focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </header>
</template>

<script setup>
import { ref } from 'vue';
import { defineProps, defineEmits } from 'vue';



const userName = ref(null)


const user = JSON.parse(localStorage.getItem('user'));
if (user && user.nama_pengguna) {
    userName.value = user.nama_pengguna;
}


const props = defineProps({

    title: {
        type: String,
        default: 'Dashboard'
    },
    showTitle: {
        type: Boolean,
        default: true
    }
});

const emit = defineEmits(['toggleSidebar']);

function toggleSidebar() {
    emit('toggleSidebar');
}
</script>