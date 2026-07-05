import api from "./api";

export const login = (data) => {
    return api.post("/v1/login", data);
};
