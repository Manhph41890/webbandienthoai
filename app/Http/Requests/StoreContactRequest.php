<?php

namespace App\Http\Requests;

use App\Enums\ContactService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreContactRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'phone_number' => ['required', 'string', 'regex:/^(0)[0-9]{9,10}$/'], // Validate số điện thoại VN
            'service' => ['required', new Enum(ContactService::class)],
            // 'request' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.regex' => 'Số điện thoại không đúng định dạng Việt Nam.',
            'service.Illuminate\Validation\Rules\Enum' => 'Dịch vụ đã chọn không hợp lệ.',
        ];
    }
}
