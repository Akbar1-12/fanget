import api from "../api/api";

export default {

    getAll() {
        return api.get("/v1/artist/campaigns");
    },

    create(formData) {
        return api.post(
            "/v1/artist/campaigns",
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        );
    },

    update(id, formData) {
        return api.post(
            `/v1/artist/campaigns/${id}?_method=PUT`,
            formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        );
    },

    delete(id) {
        return api.delete(`/v1/artist/campaigns/${id}`);
    },

    show(id) {
        return api.get(`/v1/artist/campaigns/${id}`);
    },

};