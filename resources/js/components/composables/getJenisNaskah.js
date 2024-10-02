import axios from "axios";
import { ref } from "vue";
import Swal from "sweetalert2";
import router from "../../router";

const getJenisNaskah = () => {
    const jenisNaskahs = ref([]);
    const is_loading = ref(null);
    const not_found = ref(null);

    const fillter = {
        search: "",
    };
    const loadJenisNaskah = async () => {
        is_loading.value = true;
        jenisNaskahs.value = [];
        await axios
            .get("/api/jenis-naskah", {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
                params: fillter,
            })
            .then((res) => {
                setTimeout(() => {
                    jenisNaskahs.value = res.data.data;
                    is_loading.value = false;
                    jenisNaskahs.value.length < 1
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

    return { not_found, is_loading, fillter, jenisNaskahs, loadJenisNaskah };
};

export default getJenisNaskah;
