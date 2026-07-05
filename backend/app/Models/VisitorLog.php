<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    protected $fillable = [

        'campaign_id',

        'platform_id',

        'ip_address',

        'country',

        'device',

        'browser',

        'clicked_at',

        'completed',

    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
