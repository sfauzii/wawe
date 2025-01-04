<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'travel_packages_id' => 'required|exists:travel_packages,id',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'images.required' => 'Please select at least one image to upload.',
            'images.array' => 'Invalid image format.',
            'images.min' => 'Please select at least one image to upload.',
            'images.*.required' => 'Each selected file must be an image.',
            'images.*.image' => 'The file must be an image.',
            'images.*.mimes' => 'The image must be a file of type: jpeg, png, jpg, webp.',
            'images.*.max' => 'Each image must not be greater than 2MB.',
        ];
    }
}
