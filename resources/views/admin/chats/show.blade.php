@extends('admin.master')
@section('AminContent')
<div class="container">
    <h2>المحادثة مع {{ $chat->user->name }}</h2>
    <div class="chat-box">
            <div class="chat {{ $chat->receiver_id == auth()->id() ? 'sent' : 'received' }}">
                <p>{{ $chat->chat }}</p>
                <span class="timestamp">{{ $chat->created_at->format('H:i') }}</span>
            </div>
    </div>
    <form action="{{ route('admin.chats.send', $chat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="chat" placeholder="اكتب ردك..." class="form-control">
        <button type="submit" class="btn btn-success">إرسال</button>
    </form>
</div>
@endsection
