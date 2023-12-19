import axios from "axios";

const apiClient = axios.create({
    baseURL: "/api/admin",
    headers: { Accept: "application/json" },
});

export default apiClient;
