@extends('admin.master')
@section('AminContent')
<div class="container">
    <h2>جميع المحادثات</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>المستخدم</th>
                <th>العنوان</th>
                <th>نوع المحادثة</th>
                <th>الإجراء</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chats as $chat)
                <tr>
                    <td>{{ $chat->id }}</td>
                    <td>{{ $chat->user->name }}</td>
                    <td>{{ $chat->title ?? 'بدون عنوان' }}</td>
                    <td>{{ $chat->type }}</td>
                    <td>
                        <a href="{{ route('admin.chats.show', $chat->id) }}" class="btn btn-primary">عرض</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
