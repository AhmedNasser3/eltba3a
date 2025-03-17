<?php

namespace App\Http\Controllers;

use App\Models\admin\Chat;
use Illuminate\Http\Request;
use App\Models\admin\Message;

class AdminChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['user', 'receiver'])->latest()->get();
        return view('admin.chats.index', compact('chats'));
    }

    /**
     * عرض تفاصيل محادثة معينة مع إمكانية الرد
     */
    public function show($chat_id)
    {
        $chat = Chat::with(['user', 'receiver', 'messages.sender'])->findOrFail($chat_id);
        return view('admin.chats.show', compact('chat'));
    }

    /**
     * إرسال رد من الأدمن داخل المحادثة
     */
    public function sendMessage(Request $request, $chat_id)
    {
        $request->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,gif,webp,pdf,docx,mp4|max:20480',
        ]);

        $messageText = $request->input('message');
        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chat_files', 'public');
        }

        if (!$messageText && !$filePath) {
            return back()->with('error', 'لا يمكنك إرسال رسالة فارغة!');
        }

        if (!$messageText && $filePath) {
            $messageText = '📎 مرفق جديد';
        }

        Message::create([
            'chat_id' => $chat_id,
            'sender_id' => auth()->id(),
            'message' => $messageText,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'تم إرسال الرد بنجاح!');
    }
}