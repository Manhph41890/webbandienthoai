<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhoneRequest extends FormRequest
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
        $phoneId = $this->route('phone')->id;
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|max:255|unique:phones,slug,' . $phoneId,
            'short_description' => 'nullable|string|max:500',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'variants' => 'required|array|min:1',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.size_id' => 'nullable|exists:sizes,id',
            'variants.*.color_id' => 'nullable|exists:colors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'slug.required' => 'Đường dẫn (Slug) không được để trống.',
            'slug.unique' => 'Đường dẫn này đã tồn tại.',
            'variants.required' => 'Sản phẩm phải có ít nhất một biến thể.',
            'variants.*.price.required' => 'Giá biến thể không được trống.',
            'variants.*.price.numeric' => 'Giá phải là số.',
            'variants.*.stock.required' => 'Số lượng tồn kho không được trống.',
            'variants.*.stock.integer' => 'Tồn kho phải là số nguyên.',
        ];
    }
}
