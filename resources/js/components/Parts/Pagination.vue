<template>
    <div class="pagination mb-4" v-if="totalItems > 1">
        <button :disabled="!pagination.prev_page_url" @click="loadPage(pagination.current_page - 1)">
            Previous
        </button>

        <button v-for="page in limitedPages" :key="page" :class="{ 'active-page': page === pagination.current_page }"
            @click="loadPage(page)">
            {{ page }}
        </button>

        <button :disabled="!pagination.next_page_url" @click="loadPage(pagination.current_page + 1)">
            Next
        </button>
    </div>
</template>

<script setup>
import { computed } from 'vue';

// Props for pagination data and total items
const props = defineProps({
    pagination: Object, // Contains pagination data (current page, last page, etc.)
    totalItems: Number, // Total number of items
    pageLimit: { type: Number, default: 4 }, // Optional, default to 4
});

const emit = defineEmits(['pageChange']); // Emit event for page changes

// Compute the range of visible pages
const limitedPages = computed(() => {
    const total = props.pagination.last_page;
    const current = props.pagination.current_page;
    const half = Math.floor(props.pageLimit / 2);

    let start = current - half;
    let end = current + half;

    if (start < 1) {
        start = 1;
        end = Math.min(props.pageLimit, total);
    }

    if (end > total) {
        end = total;
        start = Math.max(1, total - props.pageLimit + 1);
    }

    return Array.from({ length: end - start + 1 }, (_, i) => start + i);
});

// Function to load a specific page
function loadPage(page) {
    if (page !== props.pagination.current_page) {
        emit('pageChange', page);
    }
}
</script>

<style scoped>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    margin-top: 20px;
}

.pagination button {
    padding: 8px 16px;
    background-color: #1d4ed8;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.pagination button:disabled {
    background-color: #9ca3af;
    cursor: not-allowed;
}

.pagination button.active-page {
    background-color: #fbbf24;
}
</style>