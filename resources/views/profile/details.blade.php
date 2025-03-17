<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            تفاصيل الطلبات
        </h2>
    </x-slot>

    <body class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="max-w-lg w-full bg-white p-6 rounded-lg shadow-lg animate-fade-in">
            <!-- تفاصيل الطلب -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner mb-4">
                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">الحجم:</span>
                        <span>A4</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">اللون:</span>
                        <span>أسود</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">المقاس:</span>
                        <span>XL</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">ملاحظة:</span>
                        <span>يرجى التوصيل في الوقت المحدد</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-semibold text-gray-700">الملفات المرفقة:</span>
                        <a href="#" class="text-blue-500 underline hover:text-blue-700 transition duration-300">ملف.pdf</a>
                    </div>
                </div>
            </div>

            <!-- صندوق الشات -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner h-64 overflow-y-auto animate-slide-up flex flex-col" id="chat-box">
                <div class="bg-gray-200 p-3 rounded-lg self-start max-w-xs">مرحبًا! هل يمكنك تأكيد الطلب؟</div>
                <div class="bg-green-500 text-white p-3 rounded-lg self-end max-w-xs text-right">نعم، الطلب مؤكد.</div>
            </div>

            <!-- إدخال رسالة -->
            <div class="mt-4 flex gap-2">
                <input type="file" id="fileUpload" class="hidden" />
                <label for="fileUpload" class="cursor-pointer bg-gray-200 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-300 transition duration-300">
                    📎
                </label>
                <input type="text" id="message" placeholder="اكتب رسالتك..." class="flex-1 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center gap-1" onclick="sendMessage()">
                    ➤
                </button>
            </div>
        </div>

        <script>
            function sendMessage() {
                let messageBox = document.getElementById('message');
                let chatBox = document.getElementById('chat-box');
                let message = messageBox.value.trim();
                if (message !== '') {
                    let newMessage = document.createElement('div');
                    newMessage.className = 'bg-green-500 text-white p-3 rounded-lg self-end max-w-xs text-right';
                    newMessage.textContent = message;
                    chatBox.appendChild(newMessage);
                    messageBox.value = '';
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            }
        </script>

        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: scale(0.9); }
                to { opacity: 1; transform: scale(1); }
            }

            @keyframes slideUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .animate-fade-in { animation: fadeIn 0.5s ease-in-out; }
            .animate-slide-up { animation: slideUp 0.5s ease-in-out; }

            /* تحسين شكل الرسائل */
            #chat-box div {
                margin-bottom: 8px;
                padding: 8px 12px;
                max-width: 70%;
                word-wrap: break-word;
            }

            .self-start {
                background-color: #e5e5e5;
                color: black;
                align-self: flex-start;
            }

            .self-end {
                background-color: #25d366;
                color: white;
                align-self: flex-end;
            }
        </style>
    </body>
</x-app-layout>
