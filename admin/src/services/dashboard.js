import api from "./api";

export const getDashboard = () => {
    return api.get("/v1/dashboard");
};
