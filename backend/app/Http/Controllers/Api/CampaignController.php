<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    public function __construct(
        protected CampaignService $campaignService
    ) {
    }

    /**
     * Admin - List campaigns
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => CampaignResource::collection(
                $this->campaignService->all()
            ),
        ]);
    }

    /**
     * Admin - Create campaign
     */
    public function store(StoreCampaignRequest $request): JsonResponse
    {
        $campaign = $this->campaignService->create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Campaign created successfully.',
            'data' => new CampaignResource($campaign),
        ], 201);
    }

    /**
     * Admin - Show one campaign
     */
    public function show(Campaign $campaign): JsonResponse
    {
        return response()->json([
            'data' => new CampaignResource(
                $campaign->load('platforms')
            ),
        ]);
    }

    /**
     * Admin - Update campaign
     */
    public function update(
        UpdateCampaignRequest $request,
        Campaign $campaign
    ): JsonResponse {
        $campaign = $this->campaignService->update(
            $campaign,
            $request->validated()
        );

        return response()->json([
            'message' => 'Campaign updated successfully.',
            'data' => new CampaignResource($campaign),
        ]);
    }

    /**
     * Admin - Delete campaign
     */
    public function destroy(Campaign $campaign): JsonResponse
    {
        $this->campaignService->delete($campaign);

        return response()->json([
            'message' => 'Campaign deleted successfully.',
        ]);
    }

    /**
     * Public landing page
     */
    public function showPublic(string $slug): CampaignResource
    {
        return new CampaignResource(
            Campaign::with('platforms')
                ->where('slug', $slug)
                ->where('published', true)
                ->firstOrFail()
        );
    }
}
