<!-- الشريط الجانبي -->
<aside class="w-64 bg-white shadow-md min-h-screen p-5">
    <h2 class="text-xl font-semibold text-gray-700 mb-5">لوحة التحكم</h2>
    <ul class="space-y-3">
        <li><a href="/admin" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">الرئيسية</a></li>
        <li><a href="{{ route('admin.serviceShow') }}" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">الطلبات المقبولة</a></li>
        <li><a href="#" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">الطلبات المنتهية</a></li>
        <li><a href="#" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">الطلبات المرفوضة</a></li>
    </ul>
</aside>
