<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Thêm dòng này
            'slug' => 'nullable|string|unique:packages,slug',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'carrier' => 'required|in:sk,kt,lgu',
            'payment_type' => 'required|in:tra_truoc,tra_sau',
            'sim_type' => 'required|in:hop_phap,bat_hop_phap',
            'status' => 'required|in:con_hang,het_hang',
            'is_active' => 'nullable', // Chấp nhận bất cứ giá trị nào từ checkbox/switch

            // PHẦN QUAN TRỌNG NHẤT: Định nghĩa quy tắc cho mảng specifications
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
