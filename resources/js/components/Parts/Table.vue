<!-- TableComponent.vue -->
<template>
    <div class="container mx-auto p-2">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-sky-800 text-white text-left">
                        <th v-for="(header, index) in headers" :key="index"
                            class="py-3 px-6 font-semibold text-sm uppercase tracking-wider">
                            {{ header }}
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <slot></slot>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    headers: {
        type: Array,
        required: true,
    }
});

const emit = defineEmits(['edit', 'delete']);

const onEdit = (item) => {
    emit('edit', item);
};

const onDelete = (item) => {
    emit('delete', item);
};
</script>