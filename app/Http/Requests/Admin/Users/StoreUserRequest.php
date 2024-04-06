<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'nullable|min:3|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'nullable|min:3',
            'role_id' => 'required|integer|in:1,2',
            'birthday' => 'nullable|date_format:d/m/Y|before:today',
            'avatar' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
            'phone' => 'nullable|numeric|digits:10',
            'province_code' => 'nullable|numeric|digits:2',
            'district_code' => 'nullable|numeric|digits:3',
            'ward_code' => 'nullable|numeric|digits:5',
            'street' => 'nullable|string',
            'address' => 'nullable|string',
            'note' => 'nullable',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'địa chỉ email',
            'name' => 'họ tên',
            'password' => 'Mật khẩu',
            'confirm_password' => 'Mật khẩu xác thực',
            'role_id' => 'vai trò',
            'birthday' => 'ngày sinh',
            'avatar' => 'ảnh đại diện',
            'phone' => 'số điện thoại',
            'province_code' => 'tỉnh thành',
            'district_code' => 'quận huyện',
            'ward_code' => 'phường xã',
            'street' => 'Đường',
            'address' => 'địa chỉ',
            'note' => 'ghi chú',
        ];
    }
}
