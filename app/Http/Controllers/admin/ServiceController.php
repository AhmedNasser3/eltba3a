<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Chat;
use Illuminate\Http\Request;
use App\Models\admin\Message;
use App\Models\admin\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function create()
    {
        return view('services.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required|string',
            'size' => 'required|string',
            'comment' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'file' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/services', 'public');
        } else {
            $filePath = null;
        }

        $service = Service::create([
            'color' => $request->color,
            'size' => $request->size,
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'file' => $filePath,
        ]);

        $chat = Chat::create([
            'type' => 'service',
            'user_id' => $request->user_id,
            'receiver_id' => null,
            'title' => "طلب خدمة جديدة - {$service->id}",
        ]);

        Message::create([
            'chat_id' => $chat->id,
            'sender_id' => $request->user_id,
            'message' => $request->comment,
        ]);

    return redirect()->route('chats.index')->with('success', 'تم إنشاء الخدمة وفتح المحادثة بنجاح.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'color' => 'required|string',
            'size' => 'required|string',
            'comment' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $service->update($request->all());

        return redirect()->route('home.page')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('home.page')->with('success', 'Service deleted successfully.');
    }
}