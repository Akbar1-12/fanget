import api from "@/api/api";

export default {

    stats() {

        return api.get("/v1/artist/dashboard");

    }

};