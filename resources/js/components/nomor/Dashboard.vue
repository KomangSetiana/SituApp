<template>

    <div class="bg-gray-100 flex h-screen">

        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />
        <div class="flex-1 flex flex-col  h-screen overflow-y-auto">

            <Header :title="'Dashboard'" @toggleSidebar="toggleSidebar" />
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-6 w-full ">
                <!-- Card 1 -->
                <router-link to="/nomor/selesai">
                    <div
                        class="bg-white shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl hover:bg-yellow-200">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold text-yellow-900">Naskah Direview</h2>
                            <p class="text-5xl font-bold text-yellow-500 mt-4">{{ pending }}</p>
                        </div>
                    </div>
                </router-link>
                <!-- Card 2 -->
                <router-link to="/nomor/rejected">
                    <div
                        class="bg-white hover:bg-red-200 shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold text-red-900">Naskah Ditolak</h2>
                            <p class="text-5xl font-bold text-red-500 mt-4">{{ rejected }}</p>
                        </div>
                    </div>
                </router-link>


                <!-- Card 3 -->
                <router-link to="/arsip-naskah">
                    <div
                        class="bg-white hover:bg-green-200 shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold text-green-900">Naskah ACC</h2>
                            <p class="text-5xl font-bold text-green-500 mt-4">{{ approved }}</p>
                        </div>
                    </div>
                </router-link>

                <!-- Card 4 -->
                <router-link to="/nomor/dibatalkan">
                    <div
                        class="bg-white hover:bg-orange-200 shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold text-orange-900">Nomor Dibatalkan</h2>
                            <p class="text-5xl font-bold text-orange-500 mt-4">{{ canceled }}</p>
                        </div>
                    </div>
                </router-link>


                <router-link to="/nomor">

                    <div
                        class="bg-white hover:bg-gray-300 shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold text-gray-600">Belum Upload File</h2>
                            <p class="text-5xl font-bold text-gray-500 mt-4">{{ fileNull }}</p>
                        </div>
                    </div>
                </router-link>


                <router-link to="/nomor/all">
                    <div
                        class="bg-white hover:bg-sky-200 shadow-lg rounded-lg w-full h-48 flex items-center justify-center transform transition-transform duration-500 hover:scale-105 hover:shadow-xl">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold text-sky-900">Total</h2>
                            <p class="text-5xl font-bold text-sky-500 mt-4">{{ datas.length }}</p>
                        </div>
                    </div>
                </router-link>

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
import Header from '../Parts/Header.vue'

const isSidebarOpen = ref(false)
const datas = ref([])
const is_loading = ref(null)
const not_found = ref(null)

const pending = ref(0)
const rejected = ref(0)
const approved = ref(0)
const fileNull = ref(0)
const canceled = ref(0)
const total = ref(null)

function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}

const userName = ref(null)


const user = JSON.parse(localStorage.getItem('user'));
if (user && user.nama_pengguna) {
    userName.value = user.nama_pengguna;
}

const loadNomor = async () => {
    is_loading.value = true
    datas.value = []
    not_found.value = false
    await axios.get("/api/nomor-all", {
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token"),
        }
    }).then((res) => {

        setTimeout(() => {
            datas.value = res.data.data.data;
            pending.value = datas.value.filter(item => item.status === 'pending' && item.filename !== null).length;
            rejected.value = datas.value.filter(item => item.status === 'rejected').length;
            approved.value = datas.value.filter(item => item.status === 'approved').length;
            fileNull.value = datas.value.filter(item => item.filename === null && item.deleted_at == null).length;
            canceled.value = datas.value.filter(item => item.deleted_at !== null).length;
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