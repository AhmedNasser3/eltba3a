@extends('frontend.master')

@section('Content')
<style>
    /* ✅ تصميم عام */
    .chat-container {
        width: 100%;
        max-width: 800px;
        height: 90vh;
        margin: 20px auto;
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background-color: white;
    }

    /* ✅ الهيدر */
    .chat-header {
        background: linear-gradient(to right, #1fa73c, #1fa73c);
        color: white;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* ✅ صندوق الرسائل */
    .chat-box {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
        background-color: #f5f5f5;
    }

    /* ✅ تصميم فقاعات الرسائل */
    .message {
        max-width: 70%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 15px;
        font-size: 14px;
        line-height: 1.4;
        position: relative;
        display: inline-block;
    }

    .sent {
        background-color: #1fa73c;
        color: white;
        align-self: flex-end;
        text-align: right;
    }

    .received {
        background-color: #ddd;
        color: black;
        align-self: flex-start;
        text-align: left;
    }

    .timestamp {
        font-size: 12px;
        opacity: 0.7;
        position: absolute;
        bottom: 2px;
        right: 10px;
    }

    /* ✅ عرض الصور داخل الرسائل */
    .message img {
        max-width: 150px;
        border-radius: 10px;
        margin-top: 5px;
    }

    /* ✅ نموذج الإدخال */
    .chat-form {
        display: flex;
        padding: 10px;
        background: #fff;
        border-top: 1px solid #ddd;
        align-items: center;
    }

    .chat-form input[type="text"] {
        flex: 1;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 14px;
    }

    .chat-form button {
        background: #1fa73c;
        color: white;
        border: none;
        padding: 10px 15px;
        margin-left: 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .chat-form button:hover {
        background: #0f5a1f;
    }

    /* ✅ زر رفع الملفات */
    .file-upload {
        cursor: pointer;
        margin-left: 10px;
        font-size: 20px;
        color: gray;
    }

    .file-upload:hover {
        color: black;
    }

    /* ✅ عرض الصورة قبل الإرسال */
    #preview-container {
        display: none;
        margin-right: 10px;
    }

    #preview-image {
        max-width: 80px;
        border-radius: 10px;
        border: 1px solid #ccc;
    }

    .remove-preview {
        background: red;
        color: white;
        border: none;
        padding: 2px 5px;
        font-size: 12px;
        border-radius: 5px;
        margin-left: 5px;
        cursor: pointer;
    }

</style>

<div class="chat-container">

    <!-- ✅ الهيدر -->
    <div class="chat-header">
        <span>{{ $chat->title ?? 'محادثة' }}</span>
        <span class="text-sm opacity-80">📅 {{ now()->format('Y-m-d') }}</span>
    </div>

    <!-- ✅ صندوق الرسائل -->
    <div id="chat-box" class="chat-box">
        @foreach($messages as $message)
            <div style="display: flex; justify-content: {{ $message->sender_id == auth()->id() ? 'flex-end' : 'flex-start' }};">
                <div class="message {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                    @if ($message->message)
                        <p>{{ $message->message }}</p>
                    @endif

                    @if ($message->file_path)
                    @php
                        $fileExtension = pathinfo($message->file_path, PATHINFO_EXTENSION);
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    @endphp

                    @if (in_array(strtolower($fileExtension), $imageExtensions))
                        <!-- عرض الصورة مباشرة -->
                        <a href="{{ asset('storage/' . $message->file_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $message->file_path) }}" alt="صورة مرفقة">
                        </a>
                    @else
                        <!-- عرض أيقونة "📷 صورة مرفقة" مع رابط التنزيل -->
                        <a href="{{ asset('storage/' . $message->file_path) }}" target="_blank" style="color: blue; text-decoration: none;">
                            📎 تحميل الملف
                        </a>
                    @endif
                @endif


                    <span class="timestamp">{{ $message->created_at->format('H:i') }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ✅ نموذج إرسال الرسائل -->
    <form action="{{ route('chats.send', $chat->id) }}" method="POST" enctype="multipart/form-data"
        class="chat-form">
        @csrf

        <!-- 📎 زر اختيار الملفات -->
        <label for="file-upload" class="file-upload">📎</label>
        <input type="file" name="file" id="file-upload" class="hidden" accept="image/*" onchange="previewImage(event)">

        <!-- ✅ عرض الصورة قبل الإرسال -->
        <div id="preview-container">
            <img id="preview-image" src="">
            <button type="button" class="remove-preview" onclick="removePreview()">X</button>
        </div>

        <!-- 📜 إدخال النص -->
        <input type="text" name="message" placeholder="اكتب رسالتك...">

        <!-- 📤 زر إرسال -->
        <button type="submit">إرسال 🚀</button>
    </form>

</div>

<!-- ✅ إضافة تأثيرات عند استقبال الرسائل -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chatBox = document.getElementById("chat-box");
        chatBox.scrollTop = chatBox.scrollHeight;
    });

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('preview-container').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }

    function removePreview() {
        document.getElementById('file-upload').value = '';
        document.getElementById('preview-container').style.display = 'none';
    }
</script>

@endsection
