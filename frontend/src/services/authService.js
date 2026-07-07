import api from "@/api/api";

export default {

    login(credentials) {

        return api.post(
            "/v1/artist/login",
            credentials
        );

    },

    register(data) {

        return api.post(
            "/v1/artist/register",
            data
        );

    },

    me() {

        return api.get(
            "/v1/artist/me"
        );

    },

    logout() {

        return api.post(
            "/v1/artist/logout"
        );

    },

};