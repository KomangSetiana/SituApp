import axios from "axios";
import { ref } from "vue";

const getAksesNaskah = () => {
    const aksesNaskahs = ref([]);

    const loadAksesNaskah = async () => {
        await axios.get("/api/akes-naskah", {
            headers: {
                Authorization: "Bearer" + localStorage.getItem("token"),
            },
        }).then((res) => {
            aksesNaskahs.value = res.data.data;
        });
    };

    return { aksesNaskahs, loadAksesNaskah };
};

export default getAksesNaskah;
