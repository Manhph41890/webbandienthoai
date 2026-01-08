<h2>Xin chào {{ $contact->name }},</h2>
<p>Chúng tôi đã nhận được yêu cầu của bạn về dịch vụ: <strong>{{ $contact->service->value }}</strong>.</p>
<p>Nội dung phản hồi từ bộ phận hỗ trợ:</p>
<div style="padding: 15px; background: #f4f4f4; border-radius: 5px;">
    {!! nl2br(e($replyMessage)) !!}
</div>
<br>
<p>Trân trọng,<br>Đội ngũ hỗ trợ khách hàng.</p>