import api from "../api/api";
import endpoints from "../config/apiEndpoints";

export const campaignService = {

    getCampaign(slug) {
        return api.get(endpoints.campaign.show(slug));
    },

    
};