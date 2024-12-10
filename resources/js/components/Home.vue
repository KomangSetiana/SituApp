<template>
    <section class="bg-sky-950 flex flex-col min-h-screen">
        <!-- Logo -->
        <header class="w-full bg-sky-950 p-4">
            <div class="container mx-auto flex items-center">
                <div>
                    <img src="../../../public/logo.png" alt="Logo" class="h-16" />
                </div>
                <div class="px-2">
                    <h1 class="font-extrabold text-white text-3xl">SITU</h1>
                </div>
            </div>
        </header>

        <main class="flex flex-1 justify-center items-center px-4 py-8 md:py-24">
            <div class="flex flex-col md:flex-row justify-center items-center w-full max-w-screen-lg">
                <!-- Login Form -->
                <div class="w-full md:w-3/12 mb-8 md:mb-0 md:-mt-28 md:mr-16">
                    <h1 class="text-3xl text-white mb-6">
                        <span class="font-bold text-yellow-600">Login</span>
                        Dengan<br />
                        Akun <span class="font-bold text-yellow-600">E-Ofiice</span>
                    </h1>
                    <form @submit.prevent="handleLogin">
                        <div class="flex flex-col mb-4">
                            <label for="username" class="text-lg mb-2 text-white">Username</label>
                            <input name="username" type="text" v-model="form.username"
                                class="bg-white focus:outline-none border px-6 py-3 w-full border-sky-600 focus:border-blue-500"
                                placeholder="Username" required />
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="password" class="text-lg mb-2 text-white">Password</label>
                            <input name="password" type="password" v-model="form.password"
                                class="bg-white focus:outline-none border px-6 py-3 w-full border-sky-600 focus:border-blue-500"
                                placeholder="Password" required />
                        </div>
                        <button type="submit"
                            class=" bg-yellow-600 font-semibold hover:bg-yellow-400 transition-all duration-200 focus:outline-none shadow-inner text-white px-6 py-3 w-full mt-4">
                            Masuk
                            <fa :icon="['fas', 'spinner']" v-show="spin" class="animate-spin" />
                        </button>
                    </form>
                </div>

                <!-- Hero Image -->
                <div class="w-full md:w-5/12 hidden md:flex justify-end md:ml-16">
                    <div class="relative" style="width: 369px; height: 440px">
                        <div class="border-login absolute border-yellow-600 border-2 -mt-8 -ml-16 left-0"></div>
                        <div class="absolute w-full h-full -mb-6 -ml-3">
                            <img src="../../../public/hero-img.jpg" alt="Login" class="object-cover w-full h-full" />
                        </div>
                        <div class="absolute z-10 bg-white border border-gray-300 bottom-0 right-0 py-3 px-4 -mr-12"
                            style="width: 290px">
                            <p class="text-sky-950 mb-2">
                                Dapatkan Nomor Naskah Untuk Naskah Anda
                            </p>
                            <span class="text-sky-900 text-sm">Ayo login!</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2'
import router from '../router';


const spin = ref(null)
const errror = ref({})
const form = ref({
    username: '',
    password: ''
})

const handleLogin = async () => {
    setTimeout(() => {
        spin.value = true

    }, 1000);
    await axios.post("/api/login", {
        username: form.value.username,
        password: form.value.password
    }).then((res) => {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Signed in successfully"
        });
        // console.log(res.data.user);
        localStorage.setItem('token', res.data.token)
        localStorage.setItem('user', JSON.stringify(res.data.user));
        spin.value = false
        if (res.data.user.role === 'admin') {
            router.push('/admin/dashboard');

        } else if (res.data.user.role === 'user') {
            router.push('/my/dashboard');
            // window.location.href = '/my/nomor'

        } else {
            window.location.href = "/"
        }
    }).catch((err) => {
        spin.value = false
        console.log(err)
        if (err.response.data.error == 'Invalid credentials' && err.response.status == 401) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Invalid Username/Password.",
            });
        }
        if (err.response.status == 500) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Internal server login error",
            });
        }
    })



}

const verifyToken = async () => {
    const token = localStorage.getItem('token');

    if (token) {

        try {
            // Kirim request ke server untuk memeriksa apakah token valid
            const response = await axios.post('/api/verify-token', { token });
            // Kirim request ke server untuk memeriksa apakah token valid
            if (response.data.user.role === "admin") {
                // Jika valid, redirect ke halaman naskah untuk admin
                router.push("/admin/dashboard"); // Redirect untuk admin
            } else if (response.data.user.role === "user") {
                // Jika role adalah user, redirect ke dashboard
                router.push("/my/dashboard"); // Redirect untuk user
            } else {
                // Jika role tidak dikenali, redirect ke halaman utama
                router.push("/");
                return
            }

        } catch (error) {
            console.error('Token tidak valid atau telah expired', error);
            router.push('/');
            return
        }
    }
}

verifyToken()



</script>
<style scoped>
.border-login {
    width: 334px;
    height: 384px;
}
</style>