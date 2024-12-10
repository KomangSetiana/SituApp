<template>
    <div class="bg-gray-100 flex h-screen">

        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />

        <!-- Main content -->
        <div class="flex-1 flex flex-col  h-screen overflow-y-auto">
            <Header :title="'Nomor Baru'" @toggleSidebar="toggleSidebar" />

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
                        :headers="['#', 'Penanda Tangan', 'Pembuat Nomor', 'Nomor Naskah', 'Jenis Naskah', 'Klasifikasi', 'Tanggal', 'tujuan', 'perihal', 'Upload File', 'Proses By', 'Actions']"
                        @edit="toggleModalUpdate()">
                        <tr v-for="(item, index) in datas" :key="index" class="hover:bg-slate-200 text-sm"
                            :class="[index % 2 == 0 ? 'bg-gray-50' : 'bg-white']">
                            <td class="py-1 px-1 text-gray-700"> {{ index + 1 }} </td>
                            <td class="py-1 px-1 text-gray-700">
                                <p>
                                    <span v-if="item.plhs != null">
                                        a.n. Direktur Politeknik Pariwisata Bali <br>
                                        {{ item.plhs.jabatan.nama }}
                                    </span>
                                    <span v-else>
                                        {{ item.jabatan.nama }}
                                    </span>
                                </p>
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.users.nama_pengguna }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                <span> <button @click="copyToClipboard(item.nomor_surat)" class=" inline-block">
                                        {{ item.nomor_surat }}
                                        <fa :icon="['fas', 'copy']" />
                                    </button></span>

                            </td>

                            <td class="py-1 px-1 text-gray-700">
                                {{ item.jenis_naskah.nama }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.klasifikasis.nama }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.tanggal_surat }}
                            </td>

                            <td class="py-1 px-1 text-gray-700">
                                {{ item.tujuan }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.perihal }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                <FileUpdate :itemId="item.id" />
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.proses_by }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                <button
                                    class="text-white bg-red-600 px-3 py-2 rounded ml-2 hover:bg-red-700 transition duration-300"
                                    @click="deleteNomor(item.id)">
                                    <fa :icon="['fas', 'ban']" />
                                </button>
                                <button
                                    class="text-white bg-yellow-600 px-3 py-2 rounded ml-2 hover:yellow-red-700 transition duration-300"
                                    @click="toggleModalUpdate(item)">
                                    <fa :icon="['fas', 'file-pen']" />
                                </button>
                            </td>
                        </tr>
                    </TableComponent>
                    <NotFound :not_found="not_found" />
                </div>
                <Sekeleton :is_loading="is_loading" />
            </main>
            <Pagination :pagination="pagination" :totalItems="datas.length" :pageLimit="4" @pageChange="loadNomor" />
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

                        <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <fa :icon="['fas', 'lock']" v-if="isDisabled == true" /> Penanda
                            Tangan
                        </label>


                        <Multiselect v-model="form.jabatan_id" :options="number" placeholder="Penanda tangan"
                            :disabled="isDisabled" label="nama" track-by="kode">

                        </Multiselect>
                        <span v-if="errors.jabatan_id" class="text-red-500">{{ errors.jabatan_id[0] }}</span>

                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <fa :icon="['fas', 'lock']" v-if="isDisabled == true" /> Jenis Naskah
                        </label>

                        <Multiselect v-model="form.jenis_naskah_id" :options="jenis_naskahs"
                            :disabled="!form.jabatan_id || isDisabled" :custom-label="customLabel"
                            placeholder="Jenis naskah" label="nama" track-by="kode">
                            <template v-slot:option="props">
                                <span>{{ props.option.nama }} ({{ props.option.naskah.nama }}) </span>
                            </template>
                        </Multiselect>
                        <span v-if="errors.jenis_naskah_id" class="text-red-500">{{ errors.jenis_naskah_id[0]
                            }}</span>

                    </div>
                    <div :class="[aksesNaskahAktif == false ? 'hidden' : 'block']">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <fa :icon="['fas', 'lock']" v-if="isDisabled == true" /> Akses Naskah (R/B/T)
                        </label>

                        <Multiselect v-model="form.akses_naskah" :options="aksesNaskahs" placeholder="Akses Naskah"
                            :disabled="isDisabled" label="nama" track-by="id">

                        </Multiselect>
                        <span v-if="errors.akses_naskah" class="text-red-500">{{ errors.akses_naskah[0]
                            }}</span>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <fa :icon="['fas', 'lock']" v-if="isDisabled == true" /> Klasifikasi
                        </label>
                        <Multiselect v-model="form.klasifikasi_id" :options="klasifikasis" :custom-label="customLabel"
                            :disabled="isDisabled" placeholder=" klasisikasi naskah" label="nama" track-by="kode">
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
                            Tanggal Naskah
                        </label>
                        <input v-model="form.tanggal_surat" type="date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md  focus:outline-none focus:ring focus:ring-sky-500"
                            required />
                        <span v-if="errors.tanggal_surat" class="text-red-500">{{ errors.tanggal_surat[0] }}</span>

                    </div>

                    <div>
                        <label for="proses_by"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proses By</label>
                        <select id="proses_by" v-model="form.proses_by"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Proses By</option>
                            <option value="manual">Manual</option>
                            <option value="e-office">E-Office</option>
                            <option value="srikandi">Srikandi</option>
                        </select>
                        <span v-if="errors.proses_by" class="text-red-500">{{ errors.proses_by[0] }}</span>
                    </div>
                </div>

                <button v-if="modalCreate" type="submit"
                    class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                    Simpan

                </button>
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
import Header from "../Parts/Header.vue"
import Pagination from '../Parts/Pagination.vue';



const isSidebarOpen = ref(false)
const statusModal = ref(false)
const modalActive = ref(false)
const modalUpdate = ref(null)
const modalCreate = ref(null)
const isDisabled = ref(false)
const spin = ref(false)
const aksesNaskahAktif = ref(false)
const number = ref([])
const errors = ref({})
let jenis_naskahs = ref([])


const pagination = ref([])
const fillter = {
    search: "",
}


const datas = ref([])
const copyNumber = ref(datas.value)


const is_loading = ref(null)
const not_found = ref(null)
const form = ref({
    id: '',
    jabatan_id: '',
    jenis_naskah_id: '',
    klasifikasi_id: '',
    tanggal_surat: '',
    tujuan: '',
    perihal: '',
    akses_naskah: '',
    plh_id: '',
    proses_by: ''

});


function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}

const customLabel = (option) => {
    return `${option.nama} (${option.kode})`;
}

const handleFillter = (page) => {
    not_found.value = false
    datas.value = []
    setTimeout(() => {

        loadNomor(page)
    }, 500);
}


const { klasifikasis, loadKlasifikasi } = getAllUserKlasifikasi()
loadKlasifikasi()





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
const loadNomor = async (page = 1) => {
    is_loading.value = true
    datas.value = []
    not_found.value = false

    await axios.get(`/api/user-nomor?page=${page}`, {
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token"),
        }, params: fillter
    }).then((res) => {

        setTimeout(() => {
            datas.value = res.data.data.data;
            pagination.value = res.data.data
            console.log(datas.value)
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
        let jabatan = number.value.find((jabatan) => jabatan.id == val.id)

        // let jabatan = val
        // console.log(jabatan)

        jenis_naskahs.value = []
        if (jabatan.jenis_naskahs.length > 0) {
            jenis_naskahs.value = jabatan.jenis_naskahs
        }
    }

},
);

watch(() => form.value.jenis_naskah_id, (val) => {
    if (val) {
        // let aksesNaskah = jenis_naskahs.value.find((aksesNaskah) => aksesNaskah.id == val)
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

    if (checkTime()) {
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
                        proses_by: form.value.proses_by,
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
    }

};


const updateNomor = async () => {
    await axios.put("/api/update-nomor/" + form.value.id, {
        tujuan: form.value.tujuan,
        perihal: form.value.perihal,
        tanggal_surat: form.value.tanggal_surat,
        proses_by: form.value.proses_by
    }, {
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
        }


    }).then(() => {
        loadNomor()
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
    })
}

const deleteNomor = (id) => {

    Swal.fire({
        title: "Apakah ingin membatalkan nomor ini?",
        text: "Anda tidak bisa lagi menggunakan nomor ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Iya, Batalkan!"
    }).then((result) => {
        if (result.isConfirmed) {

            axios.delete("/api/nomor/" + id, {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
            }).then(() => {
                loadNomor()
                Swal.fire({
                    title: "Dibatalkan!",
                    text: "Nomor anda telah dibatalkan.",
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
    isDisabled.value = false
    statusModal.value = true
    modalCreate.value = true
    modalActive.value = !modalActive.value
    modalUpdate.value = false
    aksesNaskahAktif.value = false
    form.value.tanggal_surat = dateToday()

}
const toggleModalUpdate = (item) => {
    isDisabled.value = true
    statusModal.value = false
    modalUpdate.value = true
    modalActive.value = !modalActive.value
    modalCreate.value = false
    form.value.id = item.id
    form.value.perihal = item.perihal
    form.value.tujuan = item.tujuan
    form.value.tanggal_surat = item.tanggal_surat
    form.value.proses_by = item.proses_by
    form.value.jabatan_id = item.jabatan

    form.value.klasifikasi_id = item.klasifikasis
    setTimeout(() => {

        let jenis_naskah = jenis_naskahs.value.find((jenis_naskah) => jenis_naskah.id == item.jenis_naskah_id)

        form.value.jenis_naskah_id = jenis_naskah
    }, 500)
}




const checkTime = () => {
    const currentHour = new Date().getHours();

    // Cek waktu (09:00 hingga 17:00)
    if (currentHour < 8 || currentHour >= 18) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Anda hanya dapat membuat nomor pada jam 08.00 hingga jam 18.00 WITA.",
        });
        return false;
    }

    // Lanjutkan pengiriman form
    return true;
}


const copySuccess = ref(false);

// Function to copy text to clipboard
const copyToClipboard = (text) => {
    navigator.clipboard.writeText(text).then(() => {
        copySuccess.value = true;
        alert(`Nomor Naskah "${text}" berhasil disalin!`);
        setTimeout(() => {
            copySuccess.value = false;
        }, 2000); // Hide success message after 2 seconds
    });
};

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