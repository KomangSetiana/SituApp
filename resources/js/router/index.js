import { createRouter, createWebHistory } from "vue-router";

import Naskah from "../components/Naskah/Index.vue";
import Home from "../components/Home.vue";
import NotFound from "../components/NotFound.vue";
import JenisNaskah from "../components/JenisNaskah/Index.vue";
import Jabatan from "../components/Jabatan/Index.vue";
import Klasifikasi from "../components/Klasifikasi/Index.vue";
import Wewenang from "../components/Wewenang/Index.vue";
import Plh from "../components/Plh/Index.vue";
import AdminDashboard from "../components/nomor/Dashboard.vue";

import Nomor from "../components/nomor/Index.vue";
import NomorSelesai from "../components/nomor/NomorSelesai.vue";
import ArsipNaskah from "../components/nomor/ArsipNaskah.vue";
import MyDashboard from "../components/UserNomor/Dashboard.vue";
import MyNomor from "../components/UserNomor/NomorBaru.vue";
import MyNomorSelesai from "../components/UserNomor/NomorSelesai.vue";
import MyArsip from "../components/UserNomor/ArsipNomor.vue";
const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/naskah",
        name: "naskah.index",
        component: Naskah,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/jenis-naskah",
        name: "jenis-naskah.index",
        component: JenisNaskah,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/klasifikasi",
        name: "klasifikasi.index",
        component: Klasifikasi,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/jabatan",
        name: "jabatan.index",
        component: Jabatan,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/admin/dashboard",
        name: "admin.dashboard",
        component: AdminDashboard,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/nomor",
        name: "nomor.index",
        component: Nomor,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/nomor-selesai",
        name: "nomor.selesai",
        component: NomorSelesai,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/arsip-naskah",
        name: "arsip.naskah",
        component: ArsipNaskah,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/penanda-tangan",
        name: "penanda-tangan.index",
        component: Wewenang,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/plh",
        name: "plh.index",
        component: Plh,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "admin") {
                next();
            } else {
                next("/");
            }
        },
    },

    {
        path: "/my/dashboard",
        name: "my.dashboard",
        component: MyDashboard,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "user") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/my/nomor",
        name: "my.nomor",
        component: MyNomor,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "user") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/my/nomor/selesai",
        name: "my.nomor.selesai",
        component: MyNomorSelesai,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "user") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/my/arsip",
        name: "my.arsip",
        component: MyArsip,
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("user"));
            if (user && user.role === "user") {
                next();
            } else {
                next("/");
            }
        },
    },
    {
        path: "/:pathMatch(.*)*",
        name: "notFound",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: "active",
    routes,
});

export default router;
