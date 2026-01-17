<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            // Mật khẩu không bắt buộc, nhưng nếu có nhập thì phải min 8 và confirmed
            'password'  => 'nullable|string|min:8|confirmed',
            'phone'     => 'nullable|string|max:15',
            'bio'       => 'nullable|string',
            'avatar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'role_id'   => 'required|integer|exists:roles,id',
            'is_active' => 'required|boolean',
        ];
    }

    // Thêm messages() tiếng Việt
    public function messages(): array
    {
        return [
            'name.required' => 'Họ và tên không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'avatar.image' => 'File tải lên phải là một hình ảnh.',
            'avatar.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, webp.',
            'avatar.max' => 'Hình ảnh không được lớn hơn 2MB.',
            'role_id.required' => 'Vui lòng chọn vai trò cho nhân viên.',
            'is_active.required' => 'Vui lòng chọn trạng thái.',
        ];
    }
}
