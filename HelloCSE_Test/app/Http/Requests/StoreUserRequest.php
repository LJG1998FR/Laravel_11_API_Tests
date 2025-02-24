<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'image_path' => 'required|string|max:255',
            'status' => 'required|string|in:actif,inactif,en attente',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'firstname' => Str::ucfirst($this->firstname),
            'lastname'  => Str::ucfirst($this->lastname),
            'email'     => Str::lower($this->email),
        ]);
    }
}
