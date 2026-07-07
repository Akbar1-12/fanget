import api from "@/api/api";

export default {

    log(slug, platform = null) {

        return api.post(

            `/campaigns/${slug}/visit`,

            {

                platform,

            }

        );

    }

};