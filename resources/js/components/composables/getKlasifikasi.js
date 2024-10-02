import axios from "axios";
import Swal from "sweetalert2";
import router from "../../router";
import { ref } from "vue";

const getKlasifikasi = () => {
    const klasifikasis = ref([]);
    const pagination = ref([]);
    const is_loading = ref(null);
    const not_found = ref(null);
    let page = 1;
    const fillter = {
        search: "",
    };
    const loadKlasifikasi = async (page = 1) => {
        is_loading.value = true;
        klasifikasis.value = [];
        await axios
            .get(`/api/klasifikasi?page=${page}`, {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
                params: fillter,
            })
            .then((res) => {
                setTimeout(() => {
                    klasifikasis.value = res.data.data.data;
                    pagination.value = res.data.data;
                    is_loading.value = false;
                    klasifikasis.value.length < 1
                        ? (not_found.value = true)
                        : (not_found.value = false);
                }, 1000);
            })
            .catch((err) => {
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

    return {
        not_found,
        pagination,
        is_loading,
        fillter,
        klasifikasis,
        loadKlasifikasi,
    };
};

export default getKlasifikasi;
