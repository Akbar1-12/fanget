<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    protected $fillable = [
        'campaign_id',
        'platform',
        'ip_address',
        'user_agent',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
