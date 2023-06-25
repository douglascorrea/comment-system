// import axios for ajax requests
import axios from "axios";
import { ref } from "vue";

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

export function useAxios(url, params= {}) {
    const data = ref(null);
    const error = ref(null);
    const get = async () => {
        try {
            const response = await axios.get(url, { params });
            data.value = response.data;
        } catch (err) {
            error.value = err.response.data;
        }
    };

    // const post = async () => {
    //     try {
    //         const response = await axios.post(url, params);
    //         data.value = response.data;
    //     } catch (err) {
    //         error.value = err.response.data;
    //     }
    // };

    get();


    return { data, error };
}
