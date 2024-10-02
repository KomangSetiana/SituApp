<template>
    <div class="relative">
        <input type="text" v-model="searchQuery" @focus="isOpen = true" @blur="closeDropdown"
            placeholder="Select an option..." class="border p-2 rounded w-full cursor-pointer" />

        <!-- Dropdown -->
        <transition name="fade">
            <div v-if="isOpen && filteredOptions.length"
                class="absolute z-10 bg-white border border-gray-300 rounded w-full mt-1 shadow-lg max-h-60 overflow-auto"
                @mousedown.stop>
                <ul>
                    <li v-for="option in filteredOptions" :key="option.value" @click="selectOption(option)"
                        class="cursor-pointer p-2 hover:bg-gray-200">
                        {{ option.nama }} - {{ option.kode }}
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import getKlasifikasi from '../composables/getKlasifikasi';


const { pagination, is_loading, fillter, klasifikasis, loadKlasifikasi } = getKlasifikasi()
loadKlasifikasi()
// const options = ref([
//     { value: 'apple', label: 'Apple' },
//     { value: 'banana', label: 'Banana' },
//     { value: 'orange', label: 'Orange' },
//     { value: 'grape', label: 'Grape' },
//     { value: 'mango', label: 'Mango' },
// ]);

const searchQuery = ref('');
const selectedOption = ref(null);
const isOpen = ref(false);

const filteredOptions = computed(() => {
    return klasifikasis.value.filter(option =>
        option.nama.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

function selectOption(option) {
    selectedOption.value = option;
    searchQuery.value = option.nama;
    isOpen.value = false;
}

function closeDropdown() {
    setTimeout(() => {
        isOpen.value = false;
    }, 200); // Delay to allow click event to register
}
</script>

<style scoped>
/* Fade transition */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to

/* .fade-leave-active in <2.1.8 */
    {
    opacity: 0;
}
</style>