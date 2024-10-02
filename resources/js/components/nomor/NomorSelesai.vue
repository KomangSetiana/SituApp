<template>
    <div class="bg-gray-100 flex h-screen">

        <!-- Sidebar -->
        <Sidebar :isOpen="isSidebarOpen" />

        <!-- Main content -->
        <div class="flex-1 flex flex-col  h-screen overflow-y-auto">
            <header class="flex justify-between items-center bg-sky-900 shadow-md p-4">
                <div class="text-2xl text-yellow-400 font-bold">Nomor Naskah Selesai</div>
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
                    <div class="flex flex-wrap md:justify-between w-full">
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

                                <button type="submit"
                                    class="flex items-end px-2 py-2 bg-sky-800 text-white text-sm rounded-md shadow hover:bg-sky-600">
                                    <fa :icon="['fas', 'filter']" />
                                </button>
                            </form>
                        </div>

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






                    </div>
                    <TableComponent
                        :headers="['#', 'Penanda Tangan', 'Pembuat Nomor', 'Nomor Naskah', 'File Naskah', 'Tipe Naskah', 'Status']"
                        @edit="toggleModalUpdate()">
                        <tr v-for="(item, index) in datas" :key="index" class="hover:bg-slate-200"
                            :class="[index % 2 == 0 ? 'bg-gray-50' : 'bg-white']">
                            <td class="py-1 px-1 text-gray-700"> {{ index + 1 }} </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.jabatan.nama }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.users.nama_pengguna }}
                            </td>
                            <td class="py-1 px-1 text-gray-700">
                                {{ item.nomor_surat }}
                            </td>
                            <td class="py-1 px-1 text-gray-700 text-center">
                                <div>
                                    <a v-if="item.filename" :href="item.filename" target="_blank" class="text-white py-1 px-2 bg-green-700 rounded-md hover:bg-green-500
                                            ">
                                        View File
                                    </a>
                                </div>
                            </td>

                            <td class="py-1 px-1 text-gray-700 text-center">
                                <span @click="updateTipe(item)" class="cursor-pointer">
                                    <fa :icon="['fas', 'globe']" v-show="item.tipe == false" />
                                    <fa :icon="['fas', 'lock']" v-show="item.tipe == true" />
                                    {{ item.tipe == false ?
                                        'publik' : 'private' }}
                                </span>
                            </td>
                            <td class="py-1 px-1 text-gray-700 text-center">
                                <span @click="confirmUpdateStatus(item.id)" class="cursor-pointer"
                                    :class="[item.status == 'pending' ? 'bg-yellow-500 text-sm text-white p-1 rounded-lg' : item.status == 'approved' ? 'bg-green-500 text-sm text-white p-1 rounded-sm' : 'bg-red-500 text-sm text-white p-1 rounded-sm']">
                                    {{ item.status }}
                                </span>
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



</template>

<script setup>
import Sidebar from '../Parts/Sidebar.vue';
import TableComponent from '../Parts/Table.vue';
import Swal from 'sweetalert2'
import { ref, computed, watch } from 'vue';
import Sekeleton from '../Parts/Sekeleton.vue';
import NotFound from '../Parts/404.vue'
import router from "../../router";



const fillter = {
    search: "",
    dateStart: getDefaultFirstDateOfYear(),
    dateEnd: getDefaultLastDateOfYear()
}

const isSidebarOpen = ref(false)

const datas = ref([])
const is_loading = ref(null)
const not_found = ref(null)
const file = ref()




const handleFillter = (page) => {
    datas.value = []
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

function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}


const paginationLinks = computed(() => {
    const totalPages = pagination.value.last_page;
    return Array.from({ length: totalPages }, (_, i) => i + 1);
});




const loadNomor = async () => {
    is_loading.value = true
    datas.value = []
    not_found.value = false
    await axios.get("/api/nomor-selesai", {
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




const updateTipe = (item) => {
    let tipe = item.tipe == 1 ? 'public' : 'private'

    Swal.fire({
        title: "Ganti tipe naskah ke " + tipe + "?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Iya, ganti!"
    }).then((result) => {
        if (result.isConfirmed) {

            axios.put("/api/update-tipe/" + item.id, {
                tipe: item.tipe == 1 ? false : true
            }, {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
            }).then(() => {
                loadNomor()
                Swal.fire({
                    title: "Diganti!",
                    text: "Tipe naskah telah diganti ke ." + tipe,
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
    })
}


const confirmUpdateStatus = (id) => {
    Swal.fire({
        title: 'Select a status',
        text: 'Please choose a new status for this item:',
        icon: 'question',
        showCancelButton: true,
        showConfirmButton: false, // We will handle the buttons ourselves
        buttonsStyling: false,
        customClass: {
            cancelButton: 'btn-cancel',
            rejectButton: 'btn-reject',
            pendingButton: 'btn-pending',
            approveButton: 'btn-approve',
        },
        html: `
      <button class="swal2-confirm swal2-styled btn-pending" style="background-color: #f6c23e; margin-right: 10px;">Pending</button>
      <button class="swal2-confirm swal2-styled btn-approve" style="background-color: #1cc88a; margin-right: 10px;">Approve</button>
      <button class="swal2-confirm swal2-styled btn-reject" style="background-color: #e74a3b;">Reject</button>
    `,
        preConfirm: () => new Promise((resolve) => { resolve(); }),
    }).then((result) => {
        if (result.isConfirmed) {
            // Action based on the selected button
        }
    });

    // Add event listeners for the buttons inside SweetAlert
    document.querySelector('.btn-pending').addEventListener('click', () => updateStatus(id, 'pending'));
    document.querySelector('.btn-approve').addEventListener('click', () => updateStatus(id, 'approved'));
    document.querySelector('.btn-reject').addEventListener('click', () => updateStatus(id, 'rejected'));
};

// Function to update the status in the database
const updateStatus = async (id, newStatus) => {
    try {
        const response = await axios.put(`/api/update-status/${id}`, { status: newStatus }, {
            headers: {
                Authorization: "Bearer" + localStorage.getItem("token"),
            },
        }

        );
        // Update the local status after a successful API call
        const item = datas.value.find((item) => item.id === id);
        if (item) {
            item.status = newStatus; // Update the status locally in the table
        }
        // Show a success message
        Swal.fire('Updated!', `The status has been updated to ${newStatus}.`, 'success');
    } catch (error) {
        console.error('Error updating status:', error.response.data);
        Swal.fire('Error!', 'There was an error updating the status.', 'error');
    }
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
</style>