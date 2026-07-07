<?php

namespace App\Http\Requests\Artist;

use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'song_title' => [
                'required',
                'string',
                'max:255',
            ],

            'promo' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'artwork' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'youtube_video_url' => [
                'nullable',
                'url',
            ],

            'youtube_channel_url' => [
                'nullable',
                'url',
            ],

            'youtube_button_text' => [
                'nullable',
                'string',
                'max:50',
            ],

            'youtube_button_url' => [
                'nullable',
                'url',
            ],

            'show_video' => [
                'sometimes',
                'boolean',
            ],

            'autoplay_video' => [
                'sometimes',
                'boolean',
            ],

            'autoplay_seconds' => [
                'nullable',
                'integer',
                'min:1',
                'max:120',
            ],

            'platforms' => [
                'required',
                'array',
                'min:1',
            ],

            'platforms.*.platform_id' => [
                'required',
                'exists:platforms,id',
            ],

            'platforms.*.destination_url' => [
                'required',
                'url',
            ],

        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [

            'song_title.required' => 'Song title is required.',

            'artwork.required' => 'Artwork is required.',

            'artwork.image' => 'Artwork must be an image.',

            'platforms.required' => 'Add at least one streaming platform.',

            'platforms.*.destination_url.required' => 'Every selected platform must have a destination URL.',

            'platforms.*.destination_url.url' => 'Please enter a valid platform URL.',

        ];
    }
}
