import { defineStore } from "pinia";
import api from "@/api/api";

export const useCampaignStore = defineStore("campaign", {
  state: () => ({
    campaigns: [],
    campaign: null,
    loading: false,
    error: null,
  }),

  actions: {
    async load() {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.get("/v1/artist/campaigns");
        this.campaigns = data.data;
        return data;
      } catch (error) {
        this.error = error;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async show(id) {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.get(`/v1/artist/campaigns/${id}`);
        this.campaign = data.data;
        return data.data;
      } catch (error) {
        this.error = error;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    // Updated loadCampaign action with new endpoint
    async loadCampaign(slug) {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.get(`/campaigns/${slug}`);
        this.campaign = data.data;
        return data.data;
      } catch (error) {
        this.campaign = null;
        this.error = error;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async create(formData) {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.post(
          "/v1/artist/campaigns",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );

        await this.load();
        return data;
      } catch (error) {
        this.error = error;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async update(id, formData) {
      this.loading = true;
      this.error = null;

      try {
        formData.append("_method", "PUT");

        const { data } = await api.post(
          `/v1/artist/campaigns/${id}`,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );

        await this.load();
        return data;
      } catch (error) {
        this.error = error;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    async delete(id) {
      this.loading = true;
      this.error = null;

      try {
        await api.delete(`/v1/artist/campaigns/${id}`);
        this.campaigns = this.campaigns.filter(
          (campaign) => campaign.id !== id
        );
      } catch (error) {
        this.error = error;
        throw error;
      } finally {
        this.loading = false;
      }
    },

    clearCurrentCampaign() {
      this.campaign = null;
    },
  },
});