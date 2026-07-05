<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = [

        'name',

        'slug',

        'logo',

        'action',

        'sort_order',

        'enabled'

    ];

    public function campaigns()
{
    return $this->belongsToMany(Campaign::class)
        ->withPivot([
            'destination_url',
            'enabled',
        ])
        ->withTimestamps();
}
}
