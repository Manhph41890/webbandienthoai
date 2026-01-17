<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'nullable|string|max:255|unique:phones,slug',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Validate mảng biến thể
            'variants' => 'required|array|min:1',
            'variants.*.size_id' => 'nullable|exists:sizes,id',
            'variants.*.color_id' => 'nullable|exists:colors,id',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.sku' => 'nullable|string|max:100',
            'variants.*.image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'other_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'category_id.required' => 'Vui lòng chọn danh mục cho sản phẩm.',
            'category_id.exists' => 'Danh mục đã chọn không hợp lệ.',
            'slug.unique' => 'Đường dẫn (Slug) này đã tồn tại, vui lòng nhập slug khác hoặc để trống.',
            'main_image.image' => 'Ảnh chính phải là định dạng hình ảnh.',
            'main_image.max' => 'Ảnh chính không được vượt quá 2MB.',

            'variants.required' => 'Sản phẩm phải có ít nhất một biến thể.',
            'variants.*.price.required' => 'Giá biến thể là bắt buộc.',
            'variants.*.price.numeric' => 'Giá biến thể phải là con số.',
            'variants.*.stock.required' => 'Số lượng tồn kho là bắt buộc.',
            'variants.*.stock.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'variants.*.image_path.image' => 'Ảnh biến thể phải là định dạng hình ảnh.',
        ];
    }
}
