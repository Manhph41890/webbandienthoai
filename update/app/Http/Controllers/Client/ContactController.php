<?php

namespace App\Http\Controllers\Client;

use App\Enums\ContactService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    public function index(): View
    {
        // Lấy danh sách enum để đổ ra select box ở View
        $services = ContactService::cases();
        return view('pages.contact', compact('services'));
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        // dd($request->toArray());
        try {
            // Dữ liệu đã được validate tự động bởi StoreContactRequest
            Contact::create($request->validated());

            Alert::success('Cảm ơn bạn! Yêu cầu của bạn đã được gửi thành công. Chúng tôi sẽ liên hệ lại sớm nhất.');
            return back();
        } catch (\Exception $e) {
            // Log lỗi nếu cần thiết: Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Có lỗi xảy ra trong quá trình gửi. Vui lòng thử lại sau!');
        }
    }

    public function getContact(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::query()
            ->when($search, function ($query, $search) {
                return $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // $trashedCount = Contact::onlyTrashed()->count();

        return view('admin.contacts.index', compact('contacts'));
    }

    public function replyMail(Request $request, $id)
    {
        $request->validate(['message' => 'required|string']);

        $contact = Contact::findOrFail($id);

        try {
            // Gửi mail
            Mail::to($contact->email)->send(new ContactReplyMail($contact, $request->message));

            $contact->update(['status' => 'processed']);

            return back()->with('success', 'Đã gửi mail phản hồi thành công!');
        } catch (\Exception $e) {
            // Ghi chi tiết lỗi vào file storage/logs/laravel.log
            Log::error('Lỗi gửi mail tại ContactController: ' . $e->getMessage());
            Log::error('Chi tiết: ' . $e->getTraceAsString());

            // Trả về thông báo lỗi ngắn gọn ra màn hình
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
