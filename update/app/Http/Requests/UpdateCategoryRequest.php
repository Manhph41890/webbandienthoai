<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|alpha_dash',
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|integer|exists:categories,id', // Phải tồn tại trong bảng categories
            'is_active'   => 'required|boolean',
            'order'       => 'nullable|integer|min:0',
        ];
    }


    /**
     * Tùy chỉnh thông báo lỗi validate.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'Tên chuyên mục không được để trống.',
            'name.string'       => 'Tên chuyên mục phải là một chuỗi ký tự.',
            'name.max'          => 'Tên chuyên mục không được vượt quá 255 ký tự.',


            'slug.string'       => 'Slug phải là một chuỗi ký tự.',
            'slug.max'          => 'Slug không được vượt quá 255 ký tự.',
            'slug.alpha_dash'   => 'Slug chỉ được chứa chữ cái, số, dấu gạch ngang và gạch dưới.',


            'parent_id.integer' => 'Chuyên mục cha không hợp lệ.',
            'parent_id.exists'  => 'Chuyên mục cha không tồn tại.',


            'is_active.required' => 'Trạng thái không được để trống.',
            'is_active.boolean' => 'Trạng thái không hợp lệ.',


            'order.integer'     => 'Thứ tự phải là một số nguyên.',
            'order.min'         => 'Thứ tự phải lớn hơn hoặc bằng 0.',
        ];
    }
}
