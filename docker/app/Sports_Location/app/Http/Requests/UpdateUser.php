<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UpdateUser extends FormRequest
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
    public function rules(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $user = User::find($request->user_id);
        } else {
            $user = Auth::user();
        }

        return [
            'profile_image' => 'image|nullable',
            'username' => ['required', 'string', 'max:15', Rule::unique('users')->ignore($user->id, 'id')],
            'introduction' => 'nullable|max:500',
        ];
    }
}
