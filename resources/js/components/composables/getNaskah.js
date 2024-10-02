import axios from "axios";
import { ref } from "vue";
import router from "../../router";
import Swal from "sweetalert2";

const getNaskah = () => {
    const naskahs = ref([]);
    const is_loading = ref(null);
    const not_found = ref(null);

    const fillter = {
        search: "",
    };

    const loadNaskah = async () => {
        is_loading.value = true;
        naskahs.value = [];
        await axios
            .get("/api/naskah", {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
                params: fillter,
            })
            .then((res) => {
                setTimeout(() => {
                    naskahs.value = res.data.data;
                    is_loading.value = false;
                    naskahs.value.length < 1
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

    return { not_found, is_loading, fillter, naskahs, loadNaskah };
};

export default getNaskah;
