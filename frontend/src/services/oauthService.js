import api from "../api/api";

export const oauthService = {

    async start(platform, campaignSlug) {

        const { data } = await api.post("/oauth/start", {

            platform,

            campaign: campaignSlug,

        });

        return data;

    }

}