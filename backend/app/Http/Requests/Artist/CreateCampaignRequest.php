<?php

namespace App\Http\Requests\Artist;

use Illuminate\Foundation\Http\FormRequest;

class CreateCampaignRequest extends FormRequest
{
    /**
     * Authorize request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare incoming data.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([

            'show_video_buttons' => filter_var(
                $this->show_video_buttons,
                FILTER_VALIDATE_BOOLEAN,
                FILTER_NULL_ON_FAILURE
            ),

            'autoplay_video' => filter_var(
                $this->autoplay_video,
                FILTER_VALIDATE_BOOLEAN,
                FILTER_NULL_ON_FAILURE
            ),

        ]);
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | YouTube
            |--------------------------------------------------------------------------
            */

            'youtube_video_url' => [
                'nullable',
                'url',
            ],

            'youtube_channel_url' => [
                'nullable',
                'url',
            ],

            /*
            |--------------------------------------------------------------------------
            | Subscribe button is always "Subscribe"
            |--------------------------------------------------------------------------
            */

            'youtube_button_url' => [
                'nullable',
                'url',
            ],

            /*
            |--------------------------------------------------------------------------
            | Show / Hide Buttons
            |--------------------------------------------------------------------------
            */

            'show_video_buttons' => [
                'nullable',
                'boolean',
            ],

            'autoplay_video' => [
                'nullable',
                'boolean',
            ],

            'autoplay_seconds' => [
                'nullable',
                'integer',
                'min:1',
                'max:120',
            ],

            /*
            |--------------------------------------------------------------------------
            | Platforms
            |--------------------------------------------------------------------------
            */

            'platforms' => [
                'nullable',
                'array',
            ],

            'platforms.*.platform_id' => [
                'required',
                'exists:platforms,id',
            ],

            'platforms.*.destination_url' => [
                'nullable',
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

            'song_title.required' =>
                'Song title is required.',

            'artwork.required' =>
                'Artwork is required.',

            'artwork.image' =>
                'Artwork must be an image.',

            'platforms.*.platform_id.required' =>
                'A platform is missing.',

            'platforms.*.destination_url.url' =>
                'Please enter a valid platform URL.',

        ];
    }
}
