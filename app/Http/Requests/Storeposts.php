<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storeposts extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:200',
            'category_id' => 'required|integer',
            'client_id' => 'required|integer',
            'approach_id' => 'required|integer',
            'user_id' => 'required|integer',
        ];
    }
}
