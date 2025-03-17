@extends('frontend.master')
@section('Content')
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة الشات</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex flex-col">
    <div class="max-w-4xl mx-auto w-full h-full flex flex-col border shadow-md bg-white">
        <div class="p-4 bg-green-600 text-white text-lg font-semibold">الطلبات</div>
        <div class="flex-1 overflow-y-auto p-4">
            <div class="space-y-4">
                @foreach ($chats as $chat)

                <a href="{{ route('chats.show', ['chat' => $chat->id]) }}">
                    <div class="p-3 bg-gray-200 rounded-md cursor-pointer hover:bg-gray-300">{{ $chat->title }}</div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="p-4 border-t flex items-center">
            <input type="text" placeholder="اكتب رسالتك..." class="flex-1 p-2 border rounded-md focus:outline-none">
            <button class="ml-2 p-2 bg-green-600 text-white rounded-md">إرسال</button>
        </div>
    </div>
</body>
</html>

@endsection
