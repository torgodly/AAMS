<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //check if user type is admin.
        return Auth::user()->type == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:groups',
            //check if teacher_id exists in user table and if it's not assigned to another group and if the user type is teacher.
             'teacher_id' => 'required|exists:users,id|unique:groups,teacher_id',
//            'teacher_id' => 'required|exists:user,id|unique:groups,teacher_id',
        ];
    }
}
