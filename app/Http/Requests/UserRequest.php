<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
     *const = ゲストログインユーザーid
     *バリデーション指定を外すことで編集できないようにする
     * @return array
     */
    private const GUEST_USER_ID = 22;

    public function rules()
    {

        if (Auth::id() == self::GUEST_USER_ID) {
            return [
                'introduction' => 'string|max:200|nullable',
            ];
        } else {
            return [
                'name' => 'required|string',
                'age' => 'required|max:70|integer',
                'company' => 'required|string|max:255',
                'occupation' => 'required|string|max:50',
                'position' => 'required|string|max:50',
                'introduction' => 'string|max:500|nullable',
                // 'password' => ['required']
            ];
        }
    }
}
