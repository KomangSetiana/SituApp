<template>
    <router-view />
</template>



<!-- <script setup>
import { onMounted } from 'vue';
import axios from 'axios'; // Pastikan axios sudah diinstal dan diimport
import { useRoute } from 'vue-router'
import router from '../router' // Mengakses router Vue Router

const currentRoute = useRoute()
console.log(currentRoute.name)
// Fungsi untuk memverifikasi token

const verifyToken = async () => {
    const token = localStorage.getItem('token');
    if (token) {
        try {
            // Kirim request ke server untuk memeriksa apakah token valid
            const response = await axios.post('/api/verify-token', { token });
            if (response.data.user.role === "admin") {
                // Jika valid, redirect ke halaman naskah untuk admin
                router.push("/admin/dashboard"); // Redirect untuk admin
            } else if (response.data.user.role === "user") {
                // Jika role adalah user, redirect ke dashboard
                router.push("/my/dashboard"); // Redirect untuk user
            } else {
                // Jika role tidak dikenali, redirect ke halaman utama
                router.push("/");
            }

        } catch (error) {
            console.error('Token tidak valid atau telah expired', error);
            router.push('/');
        }
    } else {
        router.push('/');
    }
}
verifyToken(); -->

<!-- </script>
<!-- <script setup>
import { useCookies } from 'vue3-cookies'
import { useRouter } from 'vue-router'
import axios from 'axios'

const { cookies } = useCookies()
const router = useRouter()

const verifyToken = async () => {
    const token = cookies.get('laravel_session'); // Ambil token dari cookies

    if (token) {
        try {
            // Verifikasi token ke server
            const response = await axios.post('/api/verify-token', {}, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            // Jika token valid, user tetap login
            if (response.data.success) {
                router.push('/naskah'); // Redirect ke halaman dashboard atau halaman yang diinginkan
            }
        } catch (error) {
            console.error('Token tidak valid atau telah expired', error);
            cookies.remove('jwt_token'); // Hapus token jika expired
            router.push('/');
        }
    } else {
        router.push('/');
    }
};

verifyToken();
</script> --> -->
