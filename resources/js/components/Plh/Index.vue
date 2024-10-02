<template>
    <div class="bg-gray-100 flex h-screen">

        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />

        <!-- Main content -->
        <div class="flex-1 flex flex-col  h-screen overflow-y-auto">
            <header class="flex justify-between items-center bg-white shadow-md p-4">
                <div class="text-2xl text-sky-900 font-bold">Pelaksana Harian(Plh)</div>
                <button @click="toggleSidebar" class="md:hidden text-sky-800 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </header>
            <main class="flex-1 p-6">
                <div class="w-full">
                    <div class="flex justify-between w-full">
                        <div>
                            <button class="ml-3 px-2 py-3 bg-sky-800 rounded-lg text-white justify-items-center"
                                @click="toggleModalPlus">
                                <fa :icon="['fas', 'circle-plus']" /> Plh
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
                                        placeholder="Search name..." />
                                </div>
                                <button type="submit"
                                    class="py-2 px-3 ms-2 text-sm font-medium text-white bg-sky-800 rounded-lg  hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-sky-300 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                                    <fa :icon="['fas', 'magnifying-glass']" />

                                    <span class="sr-only">Search</span>
                                </button>
                            </form>

                        </div>
                    </div>

                    <TableComponent :headers="['#', 'Plh', 'Tanggal', 'Actions']" @edit="toggleModalUpdate()">
                        <tr v-for="(item, index) in plhs" :key="index" class="hover:bg-slate-200"
                            :class="[index % 2 == 0 ? 'bg-gray-50' : 'bg-white']">
                            <td class="py-1 px-2 text-gray-700"> {{ index + 1 }} </td>
                            <td class="py-1 px-2 text-gray-700">
                                {{ item.jabatans.nama }}
                            </td>
                            <td class="py-1 px-2 text-gray-700">
                                {{ formatDate(item.tanggal) }}
                            </td>

                            <td class="py-1 px-2 text-gray-700">
                                <button
                                    class="text-white bg-yellow-600 px-2 py-1 rounded hover:bg-yellow-700 transition duration-300"
                                    @click="toggleModalUpdate(item)">
                                    <fa :icon="['fas', 'file-pen']" />
                                </button>
                                <button
                                    class="text-white bg-red-600 px-2 py-1 rounded ml-2 hover:bg-red-700 transition duration-300"
                                    @click="deletePLh(item.id)">
                                    <fa :icon="['fas', 'trash-can']" />
                                </button>
                            </td>
                        </tr>
                    </TableComponent>
                    <NotFound :not_found="not_found" />
                </div>
                <Sekeleton :is_loading="is_loading" />
            </main>
        </div>
    </div>



    <!-- Modal-->
    <Modal :modalActive="modalActive" @close-modal="toggleModal">
        <div class="bg-white shadow-md p-4 overscroll-contain">
            <h1 class="font-semibold text-xl border-b border-gray-300 pb-2" v-if="modalCreate">Tambah Wewenang</h1>
            <h1 class="font-semibold text-xl border-b border-gray-300 pb-2" v-if="modalUpdate">Update Wewenang</h1>

            <form @submit.prevent="statusModal ? createPlh() : updatePlh()">
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="korwil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Jabatan</label>
                        <Multiselect v-model="form.jabatan_id" :options="jabatans" placeholder="Jabatan" label="nama"
                            track-by="id">
                        </Multiselect>
                        <span v-if="errors.jabatan_id" class="text-red-500">{{ errors.jabatan_id[0] }}</span>

                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Tanggal
                        </label>
                        <input v-model="form.tanggal" type="date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-sky-500"
                            required />
                        <span v-if="errors.tanggal" class="text-red-500">{{ errors.tanggal[0] }}</span>

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
import { ref } from 'vue';
import Sidebar from '../Parts/Sidebar.vue';
import TableComponent from '../Parts/Table.vue';
import Modal from '../Parts/Modal.vue';
import getJenisNaskah from '../composables/getJenisNaskah';
import Swal from 'sweetalert2'
import getJabatan from '../composables/getJabatan';
import Sekeleton from '../Parts/Sekeleton.vue'
import NotFound from '../Parts/404.vue'
import formatDate from '../../helpers/fomatDate';
import dateToday from '../../helpers/dateToday'
import 'vue-multiselect/dist/vue-multiselect.css'
import Multiselect from 'vue-multiselect'
import router from "../../router";

const isSidebarOpen = ref(false)
const statusModal = ref(false)
const modalActive = ref(false)
const modalUpdate = ref(null)
const modalCreate = ref(null)
const errors = ref({})
const plhs = ref([]);

const fillter = {
    search: ""
}



const is_loading = ref([])
const not_found = ref(null)
const form = ref({
    jabatan_id: '',
    tanggal: ''

});


function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}


const { jabatans, loadJabatan } = getJabatan()
loadJabatan()

const handleFillter = () => {
    loadPlh()
}

const loadPlh = async () => {
    is_loading.value = true
    not_found.value = false
    plhs.value = []
    await axios.get("/api/plh", {
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token"),
        }, params: fillter
    }).then((res) => {

        setTimeout(() => {
            plhs.value = res.data.data;
            is_loading.value = false;

            plhs.value.length < 1
                ? (not_found.value = true)
                : (not_found.value = false);
        }, 1000);
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
};
loadPlh()
const createPlh = async () => {
    await axios.post("/api/plh", {
        jabatan_id: form.value.jabatan_id,
        tanggal: form.value.tanggal
    }, {
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
        },
    }).then(() => {
        loadPlh()
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
const updatePlh = async () => {
    await axios.put("/api/plh/" + form.value.id, {
        jabatan_id: form.value.jabatan_id,
        tanggal: form.value.tanggal
    }, {
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
        },
    }).then(() => {
        loadPlh()
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

const deletePLh = (id) => {

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {

            axios.delete("/api/plh/" + id, {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
            }).then(() => {
                loadPlh()
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
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

    form.value.tanggal = dateToday()
}
const toggleModalUpdate = (item) => {
    statusModal.value = false
    modalUpdate.value = true
    modalActive.value = !modalActive.value
    modalCreate.value = false
    form.value = item
    form.value.jabatan_id = item.jabatans

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
</style>