<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Chat;
use Illuminate\Http\Request;
use App\Models\admin\Message;
use App\Http\Controllers\Controller;
use App\Models\admin\MessageAttachment;

class ChatController extends Controller
{
    /**
     * عرض جميع المحادثات
     */
    public function index()
    {
        $chats = Chat::where('user_id', auth()->user()->id)->latest()->get();
        return view('chat.orders',compact('chats'));
    }
    /**
     * إنشاء محادثة جديدة
     */
    public function createChat(Request $request)
    {
        $request->validate([
            'type' => 'required|in:service,support',
            'user_id' => 'required|exists:users,id',
            'receiver_id' => 'nullable|exists:users,id',
            'title' => 'nullable|string|max:255',
        ]);

        $chat = Chat::create([
            'type' => $request->type,
            'user_id' => $request->user_id,
            'receiver_id' => $request->receiver_id,
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'تم إنشاء المحادثة بنجاح', 'chat' => $chat]);
    }

    /**
     * جلب الرسائل الخاصة بمحادثة معينة
     */
    public function getMessages($chat_id)
    {
        $messages = Message::where('chat_id', $chat_id)->with('sender')->get();
        return response()->json($messages);
    }

    /**
     * إرسال رسالة داخل محادثة
     */
    public function sendMessage(Request $request, $chatId)
    {
        $request->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048', // السماح بالصور فقط
        ]);

        $messageText = $request->input('message'); // جلب النص
        $filePath = null;

        // ✅ إذا تم رفع ملف، نقوم بحفظه
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chat_files', 'public'); // تخزين الملف
        }

        // ✅ التحقق إذا كان كلاهما فارغًا
        if (!$messageText && !$filePath) {
            return back()->with('error', 'لا يمكنك إرسال رسالة فارغة!');
        }

        // ✅ تعيين نص افتراضي إذا كانت الصورة فقط بدون رسالة
        if (!$messageText && $filePath) {
            $messageText = '📷 صورة مرفقة';
        }

        // ✅ إنشاء الرسالة في قاعدة البيانات
        Message::create([
            'chat_id' => $chatId,
            'sender_id' => auth()->id(),
            'message' => $messageText,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'تم إرسال الرسالة بنجاح!');
    }



    /**
     * رفع مرفقات مع الرسالة
     */
    public function uploadAttachment(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
            'file' => 'required|file|mimes:jpg,png,pdf,docx,mp4|max:20480',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('attachments', 'public');

        $attachment = MessageAttachment::create([
            'message_id' => $request->message_id,
            'file_path' => $filePath,
            'file_type' => $file->getClientOriginalExtension(),
        ]);

        return response()->json(['message' => 'تم رفع المرفق بنجاح', 'data' => $attachment]);
    }
    public function show(Chat $chat)
    {


        $messages = $chat->messages()->with('sender')->get();

        return view('chat.customer', compact('chat', 'messages'));
    }

}
