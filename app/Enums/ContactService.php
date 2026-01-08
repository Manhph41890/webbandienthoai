<?php

namespace App\Enums;

enum ContactService: string
{
    case PHONE_CONSULTATION = 'Tư vấn mua điện thoại';
    case SIM_REGISTRATION = 'Hướng dẫn làm sim';
    case WARRANTY_SUPPORT = 'Hỗ trợ bảo hành';
    case RETURN_SUPPORT = 'Hỗ trợ đổi trả hàng';
    case FEEDBACK = 'Góp ý dịch vụ';

    // Hàm hỗ trợ lấy danh sách label nếu cần hiển thị lên UI
    public static function labels(): array
    {
        return array_column(self::cases(), 'value');
    }
}