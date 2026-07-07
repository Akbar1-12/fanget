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
     * Admin - List all campaigns
     */
    public function index(): JsonResponse
    {
        $campaigns = $this->campaignService
            ->all()
            ->load('user', 'platforms');

        return response()->json([
            'success' => true,
            'total'   => $campaigns->count(),
            'data'    => CampaignResource::collection($campaigns),
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
            'success' => true,
            'message' => 'Campaign created successfully.',
            'data'    => new CampaignResource(
                $campaign->load('user', 'platforms')
            ),
        ], 201);
    }

    /**
     * Admin - Show campaign
     */
    public function show(Campaign $campaign): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => new CampaignResource(
                $campaign->load('user', 'platforms')
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
            'success' => true,
            'message' => 'Campaign updated successfully.',
            'data'    => new CampaignResource(
                $campaign->load('user', 'platforms')
            ),
        ]);
    }

    /**
     * Admin - Delete campaign
     */
    public function destroy(Campaign $campaign): JsonResponse
    {
        $this->campaignService->delete($campaign);

        return response()->json([
            'success' => true,
            'message' => 'Campaign deleted successfully.',
        ]);
    }

    /**
     * Public Campaign Page
     */
    public function showPublic(string $slug): JsonResponse
    {
        $campaign = Campaign::with('user', 'platforms')
            ->where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data'    => new CampaignResource($campaign),
        ]);
    }
}
