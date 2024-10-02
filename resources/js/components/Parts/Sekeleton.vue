<template>
    <div v-show="is_loading" class="overflow-x-auto mx-3">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>

                </tr>
            </thead>
            <tbody>
                <!-- Skeleton Rows -->
                <tr class="animate-pulse">
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                    </td>
                </tr>
                <tr class="animate-pulse">
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                    </td>
                </tr>
                <tr class="animate-pulse">
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                    </td>
                </tr>
                <tr class="animate-pulse">
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                    </td>
                </tr>
                <tr class="animate-pulse">
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                    </td>
                </tr>
                <tr class="animate-pulse">
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                    </td>
                </tr>
                <tr class="animate-pulse">
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="h-4 bg-gray-200 rounded w-1/4"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
    is_loading: {
        type: Boolean,
        default: false
    }
})</script>