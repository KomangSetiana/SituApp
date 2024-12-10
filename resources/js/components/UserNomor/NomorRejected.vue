<template>
    <div class="bg-gray-100 flex h-screen">

        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />

        <!-- Main content -->
        <div class="flex-1 flex flex-col  h-screen overflow-y-auto">
            <Header :title="'Naskah Ditolak'" @toggleSidebar="toggleSidebar" />

            <main class="flex-1 p-6">
                <div class="w-full">
                    <div class="flex flex-wrap md:justify-between w-full">
                        <div class="flex items-end">
                            <form @submit.prevent=" handleFillter()" class="flex items-center max-w-sm mr-4 ">
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
                                    class="py-2 px-3 ms-2 text-sm font-medium text-white bg-sky-800 rounded-lg  hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-sky-300 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                                    <fa :icon="['fas', 'magnifying-glass']" />

                                    <span class="sr-only">Search</span>
                                </button>
                            </form>

                        </div>
                        <div class="flex items-end">


                            <form @submit.prevent=" handleFillter()"
                                class="flex items-center max-w-sm mr-4 md:mb-0 mb-2">
                                <!-- Start Date -->
                                <div class="mr-1">
                                    <label for=" startDate" class="block text-sm font-medium text-gray-700">
                                        Tanggal mulai</label>
                                    <input type="date" id="startDate" v-model="fillter.dateStart"
                                        class="w-1/3 mt-1 block w-full border border-gray-300 rounded-md shadow-sm md:py-2 md:px-3 py-1 px-2 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm" />
                                </div>

                                <!-- End Date -->
                                <div class="mr-1">
                                    <label for="endDate" class="block text-sm font-medium text-gray-700">Tanggal
                                        akhir</label>
                                    <input type="date" id="endDate" v-model="fillter.dateEnd"
                                        class="w-1/3 mt-1 block w-full border border-gray-300 rounded-md shadow-sm md:py-2 md:px-3 py-1 px-2 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm" />
                                </div>

                                <!-- Filter Button -->
                                <div class="relative inline-block">

                                    <button type="submit" @mouseenter="showTooltip = true"
                                        @mouseleave="showTooltip = false"
                                        class="flex items-end px-2 py-2 bg-sky-800 text-white text-sm rounded-md shadow hover:bg-sky-600">
                                        <fa :icon="['fas', 'filter']" />
                                    </button>
                                    <!-- Tooltip -->
                                    <div v-if="showTooltip"
                                        class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 bg-gray-700 text-white text-xs rounded-md px-2 py-1">
                                        Fillter tanggal
                                    </div>
                                </div>
                            </form>
                        </div>








                    </div>
                    <TableComponent
                        :headers="['#', 'Penanda Tangan', 'Nomor Naskah', 'Jenis Naskah', 'Klasifikasi', 'Tujuan', 'Perihal', 'Status Naskah', 'File Naskah', 'Update File']">
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
                                {{ item.nomor_surat }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.jenis_naskah.nama }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.klasifikasi }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.tujuan }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.perihal }}
                            </td>
                            <td class="py-1 px-1 text-gray-700 text-center">
                                <span
                                    :class="[item.status == 'pending' ? 'bg-yellow-500 text-sm text-white p-1 rounded-lg' : item.status == 'approved' ? 'bg-green-500 text-sm text-white p-1 rounded-sm' : 'bg-red-500 text-sm text-white p-1 rounded-sm']">
                                    {{ item.status }}
                                </span>

                            </td>

                            <td class="py-1 px-1 text-gray-700 text-center">
                                <div class="p-4">
                                    <!-- <p>File available for download:</p> -->
                                    <a v-if="item.filename" :href="item.filename" target="_blank" class="mb-2 text-white py-2 px-3 bg-green-700 rounded-md hover:bg-green-500
                                        ">
                                        <fa :icon="['fas', 'eye']" />
                                    </a>

                                </div>

                            </td>
                            <td class="py-1 px-1 text-gray-700 text-center">
                                <button @click="toggleModalUpdate(item.id)"
                                    class="ml-2 text-white bg-orange-600 cursor-pointer rounded-md py-2 px-3 hover:bg-orange-400">
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
            <h1 class="font-semibold text-xl border-b border-gray-300 pb-2" v-if="modalCreate">Tambah Naskah</h1>
            <h1 class="font-semibold text-xl border-b border-gray-300 pb-2" v-if="modalUpdate">Update Naskah</h1>

            <FileUpdate :itemId="currentItemId" />


        </div>
    </Modal>



</template>

<script setup>
import { ref, computed, watch } from 'vue';
import Sidebar from '../Parts/Sidebar.vue';
import TableComponent from '../Parts/Table.vue';
import Swal from 'sweetalert2'
import Sekeleton from '../Parts/Sekeleton.vue';
import NotFound from '../Parts/404.vue'
import router from "../../router";
import FileUpdate from '../Parts/UpdateFile.vue';
import Header from "../Parts/Header.vue"
import Pagination from '../Parts/Pagination.vue';
import Modal from "../Parts/Modal.vue"

const isSidebarOpen = ref(false)

const fillter = {
    search: "",
    dateStart: getDefaultFirstDateOfYear(),
    dateEnd: getDefaultLastDateOfYear()
}


const datas = ref([])
const is_loading = ref(null)
const not_found = ref(null)
const updateFiled = ref(false)
const showTooltip = ref(false)
const pagination = ref([])

const statusModal = ref(false)
const modalActive = ref(false)
const modalUpdate = ref(null)
const modalCreate = ref(null)

const currentItemId = ref(null);


function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}



const handleFillter = (page) => {
    datas.value = []
    not_found.value = false
    setTimeout(() => {

        loadNomor(page)
    }, 500);
}

function getDefaultFirstDateOfYear() {
    const today = new Date();
    const year = today.getFullYear();
    const month = '01'; // Bulan Januari
    const day = '01'; // Hari pertama
    return `${year}-${month}-${day}`;
}

function getDefaultLastDateOfYear() {
    const today = new Date();
    const year = today.getFullYear();
    const month = '12'; // Bulan Desember
    const day = '31'; // Hari Terakhir
    return `${year}-${month}-${day}`;
}



const loadNomor = async (page = 1) => {
    is_loading.value = true
    not_found.value = false
    await axios.get(`/api/user-nomor-rejected?page=${page}`, {
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token"),
        }, params: fillter
    }).then((res) => {

        setTimeout(() => {
            datas.value = res.data.data.data
            pagination.value = res.data.data
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


const toggleModal = () => {
    modalActive.value = !modalActive.value
    errors.value = {}
}
// const toggleModalPlus = () => {
//     form.value = {}
//     statusModal.value = true
//     modalCreate.value = true
//     modalActive.value = !modalActive.value
//     modalUpdate.value = false
// }
const toggleModalUpdate = (id) => {
    statusModal.value = false
    modalUpdate.value = true
    modalActive.value = !modalActive.value
    modalCreate.value = false
    currentItemId.value = id
    console.log(currentItemId.value)
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

.tooltip {
    transition: opacity 0.3s ease;
}
</style>