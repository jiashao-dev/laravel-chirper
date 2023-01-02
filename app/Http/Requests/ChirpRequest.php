<?php

namespace App\Http\Requests;

use App\Policies\ChirpPolicy;
use Illuminate\Foundation\Http\FormRequest;

class ChirpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(ChirpPolicy $chirpPolicy)
    {
        return $chirpPolicy->update($this->user(), $this->chirp);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'message' => 'required|string|max:255',
        ];
    }
}
