<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

  public function rules(): array
{
    return [

        'artist_name' => ['required','max:255'],

        'song_title' => ['required','max:255'],

        'slug' => ['required','unique:campaigns,slug'],

        'promo' => ['nullable'],

        'youtube_url' => ['nullable','url'],

        'release_date' => ['nullable','date'],

        'published' => ['boolean'],

        'youtube_video_id' => ['nullable', 'string'],

        'youtube_channel_url' => ['nullable', 'url'],

        'youtube_button_url' => ['nullable', 'url'],

        'youtube_button_text' => ['nullable', 'string', 'max:50'],

        'show_video' => ['boolean'],

        'autoplay_video' => ['boolean'],

        'autoplay_seconds' => ['nullable', 'integer', 'min:5', 'max:60'],

        'artwork' => [

            'required',

            'image',

            'mimes:jpg,jpeg,png,webp',

            'max:5120'

        ],

    ];
}
}
