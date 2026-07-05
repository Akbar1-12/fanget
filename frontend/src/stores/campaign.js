import { defineStore } from "pinia";
import { ref } from "vue";
import { campaignService } from "../services/campaignService";

export const useCampaignStore = defineStore("campaign", () => {
    const campaign = ref(null);
    const loading = ref(false);
    const error = ref(null);

    async function loadCampaign(slug) {
        loading.value = true;
        error.value = null;

        try {
            const { data } = await campaignService.getCampaign(slug);

            campaign.value = data.data;

        } catch (err) {
            error.value = err;
        } finally {
            loading.value = false;
        }
    }

    return {
        campaign,
        loading,
        error,
        loadCampaign,
    };
});