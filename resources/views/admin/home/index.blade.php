@extends('admin.master')
@section('AminContent')
    <main class="p-6">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-indigo-600 text-white text-xl font-semibold py-4 px-6 text-center">طلبات الطباعة</div>
            <div class="p-6 space-y-4 max-h-[500px] overflow-y-auto">
                @foreach ($orders as $order)
                    <div class="bg-gray-100 border-l-4 border-indigo-400 p-4 rounded-lg hover:bg-gray-200 transition duration-300">
                        <h3 class="text-lg font-semibold text-indigo-900">طلب رقم: {{ $order->id }}</h3>
                        <p class="text-sm text-indigo-700">حجم الورق: {{ $order->size }}</p>
                        <p class="text-sm text-indigo-700">لون الطباعة: {{ $order->color }}</p>
                        <p class="text-sm text-gray-600 mt-2">{{ $order->comment }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <a href="#" class="text-indigo-600 font-semibold hover:underline">عرض التفاصيل</a>
                            @if ($order->file)
                                <a href="{{ asset('storage/' . $order->file) }}" class="text-indigo-600 font-semibold hover:underline" download>تحميل الملف 📥</a>
                            @else
                                <span class="text-xs text-gray-500">لا يوجد ملف مرفق</span>
                            @endif
                        </div>
                        <div class="mt-4 flex gap-4">
                            <button onclick="updateOrderStatus({{ $order->id }}, 1)" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition duration-300">
                                قبول الطلب ✅
                            </button>
                            <button onclick="updateOrderStatus({{ $order->id }}, 2)" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition duration-300">
                                رفض الطلب ❌
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <script>
        function updateOrderStatus(orderId, status) {
            fetch("{{ route('orders.updateStatus') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    order_id: orderId,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // إعادة تحميل الصفحة لرؤية التحديثات
                } else {
                    alert("حدث خطأ أثناء تحديث الحالة.");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    </script>
@endsection
