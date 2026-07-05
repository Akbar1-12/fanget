<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlatformResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->slug,
            'name' => $this->name,
            'logo' => asset('storage/' . $this->logo),
            'action' => $this->action,
            'destination_url' => $this->pivot->destination_url,
        ];
    }
}
