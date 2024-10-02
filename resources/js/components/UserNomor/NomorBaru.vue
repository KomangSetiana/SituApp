<template>
    <div class="bg-gray-100 flex h-screen">

        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />

        <!-- Main content -->
        <div class="flex-1 flex flex-col  h-screen overflow-y-auto">
            <header class="flex justify-between items-center bg-sky-900 shadow-md p-4">
                <div class="text-2xl text-yellow-400 font-bold">Nomor Naskah</div>
                <button @click="toggleSidebar" class="md:hidden text-yellow-400 focus:outline-none">
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
                            <button
                                class="ml-3 px-3 py-2 bg-sky-800 rounded-lg text-sm text-white justify-items-center hover:bg-sky-700"
                                @click="toggleModalPlus">
                                <fa :icon="['fas', 'circle-plus']" />
                                Nomor
                            </button>
                        </div>


                        <div>

                            <form @submit.prevent="handleFillter()" class="flex items-center max-w-sm mr-4 ">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div
                                        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-gray-500">
                                        <fa :icon="['fas', 'magnifying-glass']" />
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
                    <TableComponent
                        :headers="['#', 'Penanda Tangan', 'Jenis Naskah', 'Nomor Naskah', 'Tanggal', 'Actions']"
                        @edit="toggleModalUpdate()">
                        <tr v-for="(item, index) in datas" :key="index" class="hover:bg-slate-200"
                            :class="[index % 2 == 0 ? 'bg-gray-50' : 'bg-white']">
                            <td class="py-1 px-1 text-gray-700"> {{ index + 1 }} </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.jabatan.nama }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.jenis_naskah.nama }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.nomor_surat }}
                            </td>

                            <td class="py-1 px-1 text-gray-700">
                                {{ formatDate(item.tanggal_surat) }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                <FileUpdate :itemId="item.id" />
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
            <h1 class="font-semibold text-xl border-b border-gray-300 pb-2" v-if="modalCreate">Tambah Nomor
            </h1>
            <h1 class="font-semibold text-xl border-b border-gray-300 pb-2" v-if="modalUpdate">Update Nomor
            </h1>

            <form @submit.prevent="statusModal ? createNomor() : updateNomor()">
                <div class="grid gap-6 mb-6 md:grid-cols-1 md:w-96">
                    <div>

                        <label for="jabatan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penanda
                            Tangan</label>


                        <Multiselect v-model="form.jabatan_id" :options="number" placeholder="Penanda tangan"
                            label="nama" track-by="kode">

                        </Multiselect>
                        <span v-if="errors.jabatan_id" class="text-red-500">{{ errors.jabatan_id[0] }}</span>

                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Jenis Naskah</label>

                        <Multiselect v-model="form.jenis_naskah_id" :options="jenis_naskahs"
                            :disabled="!form.jabatan_id" :custom-label="customLabel" placeholder="Jenis naskah"
                            label="nama" track-by="kode">
                            <template v-slot:option="props">
                                <span>({{ props.option.naskah.nama }}) {{ props.option.nama }} </span>
                            </template>
                        </Multiselect>
                        <span v-if="errors.jenis_naskah_id" class="text-red-500">{{ errors.jenis_naskah_id[0]
                            }}</span>

                    </div>
                    <div :class="[aksesNaskahAktif == false ? 'hidden' : 'block']">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Akses Naskah (R/B/T)</label>

                        <Multiselect v-model="form.akses_naskah" :options="aksesNaskahs" placeholder="Akses Naskah"
                            label="nama" track-by="id">

                        </Multiselect>
                        <span v-if="errors.akses_naskah" class="text-red-500">{{ errors.akses_naskah[0]
                            }}</span>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Klasifikasi</label>
                        <Multiselect v-model="form.klasifikasi_id" :options="klasifikasis" :custom-label="customLabel"
                            placeholder=" klasisikasi naskah" label="nama" track-by="kode">
                            <template v-slot:option="props">
                                <span>({{ props.option.kode }}) {{ props.option.nama }} </span>
                            </template>
                        </Multiselect>
                        <span v-if="errors.klasifikasi_id" class="text-red-500">{{ errors.klasifikasi_id[0]
                            }}</span>

                    </div>
                    <div>
                        <label for="tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tujuan
                            Naskah</label>
                        <input type="text" id="tujuan" v-model="form.tujuan"
                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Tujuan naskah" required />
                        <span v-if="errors.tujuan" class="text-red-500">{{ errors.tujuan[0] }}</span>

                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Perihal
                            Naskah</label>

                        <textarea id="message" rows="4" v-model="form.perihal"
                            class="block outline-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Tuliskan perihal naskah..."></textarea>
                        <span v-if="errors.perihal" class="text-red-500">{{ errors.perihal[0] }}</span>

                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Tanggal Surat
                        </label>
                        <input v-model="form.tanggal_surat" type="date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-sky-500"
                            required />
                        <span v-if="errors.tanggal_surat" class="text-red-500">{{ errors.tanggal_surat[0] }}</span>

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
import { ref, computed, watch } from 'vue';
import Sidebar from '../Parts/Sidebar.vue';
import TableComponent from '../Parts/Table.vue';
import FileUpdate from '../Parts/UpdateFile.vue';
import Modal from '../Parts/Modal.vue';
import Swal from 'sweetalert2'
import Sekeleton from '../Parts/Sekeleton.vue';
import NotFound from '../Parts/404.vue'
import getAksesNaskah from '../composables/getAksesNaskah';
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.css'
import formatDate from '../../helpers/fomatDate';
import dateToday from '../../helpers/dateToday'
import getAllUserKlasifikasi from '../composables/getAllUserKlasifikasi';
import router from "../../router";

const isSidebarOpen = ref(false)
const statusModal = ref(false)
const modalActive = ref(false)
const modalUpdate = ref(null)
const modalCreate = ref(null)

const plhActive = ref(false)
const aksesNaskahAktif = ref(false)

const number = ref([])
const errors = ref({})
const jabatans = ref([]);
let jenis_naskahs = ref([])
let naskahs = ref([])
const plhs = ref([])
const fillter = {
    search: "",
}


const datas = ref([])
const is_loading = ref(null)
const not_found = ref(null)
const form = ref({
    jabatan_id: '',
    jenis_naskah_id: '',
    klasifikasi_id: '',
    tanggal_surat: '',
    tujuan: '',
    perihal: '',
    akses_naskah: '',
    plh_id: ''

});


function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}

const customLabel = (option) => {
    return `${option.nama} (${option.kode})`;
}

const handleFillter = (page) => {
    datas.value = []
    setTimeout(() => {

        loadNomor(page)
    }, 500);
}


const { klasifikasis, loadKlasifikasi } = getAllUserKlasifikasi()
loadKlasifikasi()


const paginationLinks = computed(() => {
    const totalPages = pagination.value.last_page;
    return Array.from({ length: totalPages }, (_, i) => i + 1);
});


const getNumber = async () => {
    await axios.get("/api/store", {
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token"),
        },
    }).then((res) => {
        number.value = res.data;
    });
};
getNumber();

const { aksesNaskahs, loadAksesNaskah } = getAksesNaskah()
loadAksesNaskah()

//getAll user nomor
const loadNomor = async () => {
    is_loading.value = true
    datas.value = []
    not_found.value = false
    await axios.get("/api/user-nomor", {
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token"),
        }, params: fillter
    }).then((res) => {

        setTimeout(() => {
            datas.value = res.data.data;
            is_loading.value = false

            datas.value.length < 1 ? not_found.value = true : not_found.value = false;
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
loadNomor();



watch(() => form.value.jabatan_id, (val) => {
    if (val) {
        // console.log(val.jenis_naskahs)
        // let jabatan = number.value.find((jabatan) => jabatan.id == val)
        let jabatan = val

        jenis_naskahs.value = []
        if (jabatan.jenis_naskahs.length > 0) {
            jenis_naskahs.value = jabatan.jenis_naskahs
        }
    }
    // if (Array.isArray(val) && val.length > 0) {
    //     // Clear the jenis_naskahs array before populating it
    //     jenis_naskahs.value = [];

    //     // Loop through each selected jabatan_id
    //     val.forEach(jabatan_id => {
    //         // Find the corresponding jabatan based on jabatan_id
    //         let jabatan = number.value.find((jabatan) => jabatan.id == jabatan_id);

    //         // If the jabatan has jenis_naskahs, add them to the array
    //         if (jabatan && jabatan.jenis_naskahs.length > 0) {
    //             jenis_naskahs.value.push(...jabatan.jenis_naskahs);
    //         }
    //     });
    // } else {
    //     // If no selection, reset the jenis_naskahs array
    //     jenis_naskahs.value = [];
    // }
},
);

watch(() => form.value.jenis_naskah_id, (val) => {
    if (val) {
        // let aksesNaskah = jenis_naskahs.value.find((aksesNaskah) => aksesNaskah.id == val)
        console.log(val)
        let aksesNaskah = val
        form.value.akses_naskah = '';

        if (aksesNaskah.akses_naskah == 1) {
            aksesNaskahAktif.value = true
        } else {
            aksesNaskahAktif.value = false
        }

    }
})



const createNomor = async () => {

    // if (checkTime()) {
    Swal.fire({
        title: "Anda Yakin Membuat Nomor?",
        text: "Pastikan Nomor ini akan anda gunakan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "iya, Yakin!"
    }).then(async (result) => { // Menambahkan async di sini
        if (result.isConfirmed) {
            try {
                await axios.post("/api/nomor", {
                    jabatan_id: form.value.jabatan_id,
                    jenis_naskah_id: form.value.jenis_naskah_id,
                    klasifikasi_id: form.value.klasifikasi_id,
                    tanggal_surat: form.value.tanggal_surat,
                    tujuan: form.value.tujuan,
                    perihal: form.value.perihal,
                    akses_naskah: form.value.akses_naskah,
                }, {
                    headers: {
                        Authorization: "Bearer " + localStorage.getItem("token"),
                    },
                });

                loadNomor();
                modalActive.value = !modalActive.value;

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

            } catch (err) {
                const cekTime = err.response.data.message
                if (err.response && err.response.status === 422) {
                    errors.value = err.response.data.errors;
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

                if (cekTime && err.response.status == 403) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: `${cekTime}`,
                    });

                }
            }
        }
    });
    // }

};


// const updateNomor = async () => {
//     await axios.put("/api/klasifikasi/" + form.value.id, {
//         headers: {
//             Authorization: "Bearer" + localStorage.getItem("token"),
//         },

//         nama: form.value.nama,
//         kode: form.value.kode
//     }).then(() => {
//         loadNomor()
//         modalActive.value = !modalActive.value
//         const Toast = Swal.mixin({
//             toast: true,
//             position: "top-end",
//             showConfirmButton: false,
//             timer: 3000,
//             timerProgressBar: true,
//             didOpen: (toast) => {
//                 toast.onmouseenter = Swal.stopTimer;
//                 toast.onmouseleave = Swal.resumeTimer;
//             }
//         });
//         Toast.fire({
//             icon: "success",
//             title: "Data has been updated"
//         });
//     })
// }

const deleteNomor = (id) => {

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

            axios.delete("/api/nomor/" + id, {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
            }).then(() => {
                loadNomor()
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
    aksesNaskahAktif.value = false
    form.value.tanggal_surat = dateToday()

}
const toggleModalUpdate = (p) => {
    statusModal.value = false
    modalUpdate.value = true
    modalActive.value = !modalActive.value
    modalCreate.value = false
    form.value.klasifikasi_id = klasifikasis.value
    form.value.akses_naskah = akses_naskah.value.id
}


// const toggleUpdateFile = (p) => {
//     statusModal.value = false
//     modalUpdate.value = true
//     modalActive.value = !modalActive.value
//     modalCreate.value = false
//     form.value.klasifikasi_id = klasifikasis.value
//     form.value.akses_naskah = akses_naskah.value.id
// }

// const checkTime = () => {
//     const currentHour = new Date().getHours();

//     // Cek waktu (09:00 hingga 17:00)
//     if (currentHour < 9 || currentHour >= 17) {
//         Swal.fire({
//             icon: "error",
//             title: "Oops...",
//             text: "Anda hanya dapat membuat nomor pada jam 09.00 hingga jam 17.00 WITA.",
//         });
//         return false;
//     }

//     // Lanjutkan pengiriman form
//     return true;
// }




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

/* Menimpa style default Vue Multiselect untuk opsi yang dipilih */
.custom-multiselect .multiselect__single {
    background-color: #0d2482;
}
</style>