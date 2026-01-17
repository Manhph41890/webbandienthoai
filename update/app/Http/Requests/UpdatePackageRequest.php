<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
        $id = $this->route('package') ? $this->route('package')->id : null;

        return [
            'name' => 'required|string|max:255|unique:packages,name,' . $id,
            'category_id' => 'required|exists:categories,id', // Thêm dòng này
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'specifications' => 'nullable|array',
            'specifications.data_thang' => 'nullable|string',
            'specifications.data_ngay' => 'nullable|string',
            'specifications.uu_dai_thoai' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên gói cước không được để trống.',
            'name.unique' => 'Tên gói cước này đã tồn tại.',
            'duration_days.required' => 'Thời hạn sử dụng không được để trống.',
            'duration_days.integer' => 'Thời hạn phải là số nguyên.',
            'price.required' => 'Giá cước không được để trống.',
            'price.numeric' => 'Giá cước phải là định dạng số.',
            'specifications.array' => 'Thông số kỹ thuật phải là một mảng dữ liệu.',
        ];
    }
}
