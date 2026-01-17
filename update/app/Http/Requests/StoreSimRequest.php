<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSimRequest extends FormRequest
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
        // Lấy ID của SIM hiện tại để bỏ qua lỗi unique khi cập nhật
        $id = $this->route('sim') ? $this->route('sim')->id : null;

        return [
            'sim_number' => 'required|string|max:20|unique:sims,sim_number,' . $id,
            'serial' => 'nullable|string|max:50|unique:sims,serial,' . $id,
            'carrier' => 'required|in:skt,kt,lgu',
            'package_id' => 'nullable|exists:packages,id',
            'status' => 'required|in:Hoạt_động,ngừng_bán',
        ];
    }

    public function messages(): array
    {
        return [
            'sim_number.required' => 'Số SIM không được để trống.',
            'sim_number.unique' => 'Số SIM này đã tồn tại trên hệ thống.',
            'serial.unique' => 'Số Serial này đã tồn tại.',
            'carrier.required' => 'Vui lòng chọn nhà mạng.',
            'carrier.in' => 'Nhà mạng phải là SKT, KT hoặc LG U+.',
            'package_id.exists' => 'Gói cước được chọn không tồn tại.',
            'status.required' => 'Trạng thái không được để trống.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
