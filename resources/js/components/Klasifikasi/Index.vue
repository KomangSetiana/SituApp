<template>
    <div class="bg-gray-100 flex h-screen">

        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />

        <!-- Main content -->
        <div class="flex-1 flex flex-col  h-screen overflow-y-auto">
            <Header :title="'Klasifikasi'" @toggleSidebar="toggleSidebar" />

            <main class="flex-1 p-6">
                <div class="w-full">
                    <div class="flex justify-between w-full">
                        <div>
                            <button
                                class="ml-3 px-3 py-2 bg-sky-800 rounded-lg text-sm text-white justify-items-center hover:bg-sky-700"
                                @click="toggleModalPlus">
                                <fa :icon="['fas', 'circle-plus']" />
                                Klasifikasi
                            </button>
                        </div>


                        <div>

                            <form @submit.prevent="handleFillter()" class="flex items-center max-w-sm mr-4 ">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <fa :icon="['fas', 'magnifying-glass']" style="color: #B197FC;" />
                                    </div>
                                    <input type="text" v-model="fillter.search" id="simple-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full ps-10 p-2.5 focus:outline-none  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500"
                                        placeholder="Search name..." required />
                                </div>
                                <button type="submit"
                                    class="py-2 px-3 ms-2 text-sm font-medium text-white bg-sky-800 rounded-lg  hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-sky-300 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                                    <fa :icon="['fas', 'magnifying-glass']" />

                                    <span class="sr-only">Search</span>
                                </button>
                            </form>

                        </div>
                    </div>
                    <TableComponent :headers="['#', 'Nama', 'Kode', 'Actions']" @edit="toggleModalUpdate()">
                        <tr v-for="(item, index) in klasifikasis" :key="index" class="hover:bg-slate-200"
                            :class="[index % 2 == 0 ? 'bg-gray-50' : 'bg-white']">
                            <td class="py-2 px-3 text-gray-700"> {{ index + 1 }} </td>
                            <td class="py-2 px-3 text-gray-700">
                                {{ item.nama }}
                            </td>
                            <td class="py-2 px-3 text-gray-700">
                                {{ item.kode }}
                            </td>
                            <td class="py-2 px-3 text-gray-700">
                                <button
                                    class="text-white bg-yellow-500 px-3 py-2 rounded hover:bg-yellow-700 transition duration-300"
                                    @click="toggleModalUpdate(form = item)">
                                    <fa :icon="['fas', 'file-pen']" style="color: #fff" />
                                </button>
                                <button
                                    class="text-white bg-red-600 px-3 py-2 rounded ml-2 hover:bg-red-700 transition duration-300"
                                    @click="deleteKlasifikasi(item.id)">
                                    <fa :icon="['fas', 'trash-can']" />
                                </button>
                            </td>
                        </tr>
                    </TableComponent>
                    <NotFound :not_found="not_found" />
                </div>
                <Sekeleton :is_loading="is_loading" />

            </main>

            <Pagination :pagination="pagination" :totalItems="klasifikasis.length" :pageLimit="4"
                @pageChange="loadKlasifikasi" />
        </div>
    </div>



    <!-- Modal-->


    <Modal :modalActive="modalActive" @close-modal="toggleModal">
        <div class="bg-white shadow-md p-4 overscroll-contain">
            <h1 class="font-semibold text-xl border-b border-gray-300 pb-2" v-if="modalCreate">Tambah Klasifikasi</h1>
            <h1 class="font-semibold text-xl border-b border-gray-300 pb-2" v-if="modalUpdate">Update Klasifikasi</h1>

            <form @submit.prevent="statusModal ? createKlasifikasi() : updateKlasifikasi()">
                <div class="grid gap-6 mb-6 md:grid-cols-1 md:w-96">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Nama Klasifikasi
                        </label>
                        <input v-model="form.nama" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-sky-500" />
                        <span v-if="errors.nama" class="text-red-500">{{ errors.nama[0] }}</span>

                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Kode
                        </label>
                        <input v-model="form.kode" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-sky-500" />
                        <span v-if="errors.kode" class="text-red-500">{{ errors.kode[0] }}</span>

                    </div>
                </div>

                <button v-if="modalCreate" type="submit"
                    class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                    Simpan</button>
                <button v-if="modalUpdate" type="submit"
                    class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                    Update</button>
            </form>

        </div>
    </Modal>






</template>

<script setup>
import { ref, computed } from 'vue';
import Sidebar from '../Parts/Sidebar.vue';
import TableComponent from '../Parts/Table.vue';
import Modal from '../Parts/Modal.vue';
import Swal from 'sweetalert2'
import Sekeleton from '../Parts/Sekeleton.vue';
import getKlasifikasi from '../composables/getKlasifikasi';
import router from "../../router";
import NotFound from '../Parts/404.vue'
import Header from "../Parts/Header.vue"
import Pagination from "../Parts/Pagination.vue"
const isSidebarOpen = ref(false)
const statusModal = ref(false)
const modalActive = ref(false)
const modalUpdate = ref(null)
const modalCreate = ref(null)


const errors = ref({})
const form = ref({
    nama: '',
    kode: ''

});




function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}

const handleFillter = (page) => {
    klasifikasis.value = []
    not_found.value = false
    setTimeout(() => {

        loadKlasifikasi(page)
    }, 500);
}

const { not_found, pagination, is_loading, fillter, klasifikasis, loadKlasifikasi } = getKlasifikasi()
loadKlasifikasi()



const createKlasifikasi = async () => {

    await axios.post("/api/klasifikasi", {
        nama: form.value.nama,
        kode: form.value.kode
    }, {
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
        },
    }).then(() => {
        loadKlasifikasi()
        modalActive.value = !modalActive.value
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
            title: "Data has been saved"
        });
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

}
const updateKlasifikasi = async () => {
    await axios.put("/api/klasifikasi/" + form.value.id, {
        nama: form.value.nama,
        kode: form.value.kode
    }, {
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token"),
        },
    }).then(() => {
        loadKlasifikasi()
        modalActive.value = !modalActive.value
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
            title: "Data has been updated"
        });
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
}

const deleteKlasifikasi = (id) => {

    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Anda tidak akan bisa mengembalikan data ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Iya,Hapus!"
    }).then((result) => {
        if (result.isConfirmed) {

            axios.delete("/api/klasifikasi/" + id, {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
            }).then(() => {
                loadKlasifikasi()
                Swal.fire({
                    title: "Terhapus!",
                    text: "Data anda telah dihapus.",
                    icon: "success"
                });
            }).catch((err) => {


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
        }
    });
}

const toggleModal = () => {
    modalActive.value = !modalActive.value
    errors.value = {}
}
const toggleModalPlus = () => {
    form.value = {}
    statusModal.value = true
    modalCreate.value = true
    modalActive.value = !modalActive.value
    modalUpdate.value = false
}
const toggleModalUpdate = (p) => {
    statusModal.value = false
    modalUpdate.value = true
    modalActive.value = !modalActive.value
    modalCreate.value = false
    // form.value.korwil_id = p.korwils.id

}




</script>







<style scoped>
/* Custom CSS untuk animasi */
.transition-transform {
    transition: transform 0.3s ease-in-out;
}

.hover\:bg-gray-100:hover {
    background-color: #f7fafc;
}

.transition {
    transition: all 0.3s ease;

}


:disabled {
    @apply bg-gray-400
}
</style>