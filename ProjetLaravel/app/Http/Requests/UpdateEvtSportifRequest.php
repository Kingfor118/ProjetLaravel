<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvtSportifRequest extends FormRequest
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
            'title'=>'required|max:255',
            'slug'=>'required|string|max:255',
            'description'=>'required|string',
            'location'=>'required|max:255',
            'date'=>'required|date|max:255',
            'category'=>'required|max:255',
            'max_participants'=>'required|integer'
        ];
    }
}
