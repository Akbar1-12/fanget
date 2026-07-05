<?php

namespace App\Services;

use App\Models\Campaign;
use Illuminate\Support\Facades\Storage;

class CampaignService
{
    /**
     * Get all campaigns with platforms.
     */
    public function all()
    {
        return Campaign::with('platforms')
            ->latest()
            ->get();
    }

    /**
     * Create a new campaign.
     */
    public function create(array $data): Campaign
    {
        if (isset($data['artwork'])) {
            $data['artwork'] = $data['artwork']->store('artists', 'public');
        }

        return Campaign::create($data);
    }

    /**
     * Update an existing campaign.
     */
    public function update(Campaign $campaign, array $data): Campaign
    {
        if (isset($data['artwork'])) {

            // Delete old artwork if it exists
            if ($campaign->artwork && Storage::disk('public')->exists($campaign->artwork)) {
                Storage::disk('public')->delete($campaign->artwork);
            }

            // Store new artwork
            $data['artwork'] = $data['artwork']->store('artists', 'public');
        }

        $campaign->update($data);

        return $campaign->fresh();
    }

    /**
     * Delete a campaign and its artwork.
     */
    public function delete(Campaign $campaign): void
    {
        if ($campaign->artwork && Storage::disk('public')->exists($campaign->artwork)) {
            Storage::disk('public')->delete($campaign->artwork);
        }

        $campaign->delete();
    }
}
