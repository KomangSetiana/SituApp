import axios from "axios";
import { ref } from "vue";

const getUserKlasifikasi = () => {
    const klasifikasis = ref([]);
    const loadKlasifikasi = async () => {
        await axios
            .get("/api/user-klasifikasi", {
                headers: {
                    Authorization: "Bearer" + localStorage.getItem("token"),
                },
            })
            .then((res) => {
                klasifikasis.value = res.data.data;
            });
    };

    return {
        klasifikasis,
        loadKlasifikasi,
    };
};

export default getUserKlasifikasi;
