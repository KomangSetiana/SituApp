<template>

    <div class="bg-gray-100 flex h-screen">

        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />
        <div class="flex-1 flex flex-col  h-screen overflow-y-auto">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-6 w-full ">
                <!-- Card 1 -->
                <div
                    class="bg-white shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl hover:bg-yellow-200">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-yellow-900">Pending</h2>
                        <p class="text-5xl font-bold text-yellow-500 mt-4">{{ pending }}</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white hover:bg-red-200 shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-red-900">Rejected</h2>
                        <p class="text-5xl font-bold text-red-500 mt-4">{{ rejected }}</p>
                    </div>
                </div>


                <!-- Card 3 -->
                <div
                    class="bg-white hover:bg-green-200 shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-green-900">Approved</h2>
                        <p class="text-5xl font-bold text-green-500 mt-4">{{ approved }}</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-white hover:bg-sky-200 shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-sky-900">Total</h2>
                        <p class="text-5xl font-bold text-sky-500 mt-4">{{ datas.length }}</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

</template>

<script setup>
import Sidebar from '../Parts/Sidebar.vue';
import Swal from 'sweetalert2'
import { ref, computed, watch } from 'vue';
import Sekeleton from '../Parts/Sekeleton.vue';
import NotFound from '../Parts/404.vue'
import router from "../../router";


const isSidebarOpen = ref(false)
const datas = ref([])
const is_loading = ref(null)
const not_found = ref(null)

const pending = ref(0)
const rejected = ref(0)
const approved = ref(0)
const total = ref(null)

function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}

const loadNomor = async () => {
    is_loading.value = true
    datas.value = []
    not_found.value = false
    await axios.get("/api/nomor-selesai", {
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token"),
        }
    }).then((res) => {

        setTimeout(() => {
            datas.value = res.data.data;
            pending.value = datas.value.filter(item => item.status === 'pending').length;
            rejected.value = datas.value.filter(item => item.status === 'rejected').length;
            approved.value = datas.value.filter(item => item.status === 'approved').length;
            console.log(approved.value)
            is_loading.value = false

            datas.value.length < 1 ? not_found.value = true : not_found.value = false;
        }, 1000);

    }).catch((err) => {


        if (err.response && err.response.status === 422) {
            errors.value = err.response.data.errors
        }

        if (
            err.response.data.message == "Token not found or invalid" &&
            err.response.status == 401
        ) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Token expired silakan login kembali",
            });

            router.push("/");
        }
    });
};
loadNomor();

</script>