<template>
    <div :class="[
        'bg-sky-950 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transition-transform z-10 md:z-0 overflow-y-auto',
        { '-translate-x-full': !isOpen, 'md:relative md:translate-x-0': true },
    ]">
        <a href="#" class="text-white flex items-center space-x-2 px-4">
            <img src="../../../../public/logo.png" alt="Poltekpar" class="w-14">
            <span class="text-md font-bold">Sistem Informasi Tata Usaha</span>
        </a>
        <div class="text-white px-3 py-2 bg-sky-900 rounded-lg text-sm">
            <fa :icon="['fas', 'user']" /> {{ userName }}
        </div>
        <nav>
            <router-link to="/admin/dashboard" v-show="user.role == 'admin'"
                class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                <fa :icon="['fas', 'chart-line']" /> Dashboard Admin
            </router-link>
            <router-link to="/my/dashboard" v-show="user.role == 'user'"
                class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                <fa :icon="['fas', 'chart-line']" /> Dashboard User
            </router-link>
            <!-- Dropdown Master -->
            <div class="relative" v-show="user.role == 'admin'">
                <button @click="toggleMasterDropdown"
                    class="flex items-center justify-between w-full py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900">
                    <span>
                        <fa :icon="['fas', 'folder-open']" /> Master
                    </span>
                    <fa :icon="['fas', isMasterDropdownOpen ? 'angle-up' : 'angle-down']" />
                </button>
                <div v-show="isMasterDropdownOpen" class="pl-4 space-y-2 mt-2">
                    <router-link to="/naskah"
                        class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                        <fa :icon="['fas', 'file']" /> Tipe Naskah
                    </router-link>
                    <router-link to="/jenis-naskah"
                        class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                        <fa icon="fa-solid fa-file-lines" /> Jenis Naskah
                    </router-link>
                    <router-link to="/klasifikasi"
                        class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                        <fa :icon="['fas', 'file-invoice']" /> Klasifikasi Naskah
                    </router-link>
                    <router-link to="/jabatan"
                        class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                        <fa :icon="['fas', 'user-tie']" /> Jabatan
                    </router-link>
                    <router-link to="/penanda-tangan"
                        class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                        <fa :icon="['fas', 'file-signature']" /> Penanda Tangan
                    </router-link>
                    <router-link to="/plh"
                        class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                        <fa :icon="['fas', 'user-clock']" /> Pelaksana Harian (Plh)
                    </router-link>
                </div>
            </div>
            <!-- Nomor Akses Admin -->

            <div v-show="user.role == 'admin'">
                <router-link to="/nomor"
                    class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                    <fa :icon="['fas', 'envelope-open-text']" /> Nomor Naskah Baru
                </router-link>
                <router-link to="/nomor-selesai"
                    class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                    <fa :icon="['fas', 'envelope']" /> Nomor Naskah Selesai
                </router-link>
                <router-link to="/arsip-naskah"
                    class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                    <fa :icon="['fas', 'boxes-packing']" /> Arsip Naskah Dinas
                </router-link>
            </div>
            <!-- Nomor Akses Admin End -->

            <!-- Nomor Akses User -->
            <div v-show="user.role == 'user'">
                <router-link to="/my/nomor"
                    class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                    <fa :icon="['fas', 'envelope-open-text']" /> Nomor Naskah Baru
                </router-link>
                <router-link to="/my/nomor/selesai"
                    class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                    <fa :icon="['fas', 'envelope']" /> Nomor Naskah Selesai
                </router-link>
                <router-link to="/my/arsip"
                    class="link-sidebar block py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                    <fa :icon="['fas', 'boxes-packing']" /> Arsip Naskah Dinas
                </router-link>
            </div>
            <!-- Nomor Akses User End -->

            <button @click="deleteToken()"
                class="py-2.5 px-4 rounded transition duration-200 hover:bg-sky-900 hover:text-white">
                <fa :icon="['fas', 'right-from-bracket']" /> Logout
            </button>
        </nav>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { defineProps } from 'vue';
import Swal from 'sweetalert2'
import router from '../../router';



const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
});

const userName = ref(null)

const errors = ref({})

const user = JSON.parse(localStorage.getItem('user'));
if (user && user.nama_pengguna) {
    userName.value = user.nama_pengguna;
}

const deleteToken = () => {
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Anda akan keluar dari halaman!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, Keluar!'
    }).then((result) => {
        if (result.isConfirmed) {
            // axios
            //     .post('http://127.0.0.1:8000/api/logout', {
            //         headers: {
            //             Authorization: 'Bearer' + localStorage.getItem('token')
            //         }
            //     })
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            router.push("/")

            Swal.fire({
                title: 'Keluar!',
                text: 'Berasil keluar.',
                icon: 'success'
            })

        }
    })
}


// Dropdown visibility state
const isMasterDropdownOpen = ref(false);

// Function to toggle dropdown
const toggleMasterDropdown = () => {
    isMasterDropdownOpen.value = !isMasterDropdownOpen.value;
};
</script>

<style scoped>
.transition-transform {
    transition: transform 0.3s ease-in-out;
}
</style>
