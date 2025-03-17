<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            الطلبات
        </h2>
    </x-slot>

    <!DOCTYPE html>
    <html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>جدول الطلبات</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const rows = document.querySelectorAll("#table-body tr");
                const searchInput = document.getElementById("search");
                const pagination = document.getElementById("pagination");
                let currentPage = 1;
                const rowsPerPage = 10;

                function renderTable() {
                    const searchQuery = searchInput.value.toLowerCase();
                    let filteredRows = Array.from(rows).filter(row =>
                        row.innerText.toLowerCase().includes(searchQuery)
                    );

                    const start = (currentPage - 1) * rowsPerPage;
                    const end = start + rowsPerPage;

                    rows.forEach(row => row.style.display = "none");
                    filteredRows.slice(start, end).forEach(row => row.style.display = "table-row");

                    renderPagination(filteredRows.length);
                }

                function renderPagination(totalItems) {
                    pagination.innerHTML = "";
                    const pageCount = Math.ceil(totalItems / rowsPerPage);

                    for (let i = 1; i <= pageCount; i++) {
                        const button = document.createElement("button");
                        button.innerText = i;
                        button.className = `px-3 py-1 mx-1 rounded ${i === currentPage ? "bg-blue-500 text-white" : "bg-gray-200"}`;
                        button.addEventListener("click", () => {
                            currentPage = i;
                            renderTable();
                        });
                        pagination.appendChild(button);
                    }
                }

                searchInput.addEventListener("input", () => {
                    currentPage = 1;
                    renderTable();
                });

                renderTable();
            });
        </script>
    </head>
    <body class="p-8 bg-gray-100">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow mt-12">

            <!-- شريط البحث -->
            <input type="text" id="search" placeholder="ابحث عن طلب..." class="w-full mb-4 p-2 border rounded">

            <!-- الجدول -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border bg-white shadow-md">
                    <thead>
                        <tr class="bg-gray-200 text-center">
                            <th class="px-4 py-2 border">رقم الطلب</th>
                            <th class="px-4 py-2 border">الطلب</th>
                            <th class="px-4 py-2 border">الحجم</th>
                            <th class="px-4 py-2 border">المقاس</th>
                            <th class="px-4 py-2 border">اللون</th>
                            <th class="px-4 py-2 border">الملاحظة</th>
                            <th class="px-4 py-2 border">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr class="border-b hover:bg-gray-100 text-center">
                            <td class="px-4 py-2">1001</td>
                            <td class="px-4 py-2">قميص</td>
                            <td class="px-4 py-2">كبير</td>
                            <td class="px-4 py-2">XL</td>
                            <td class="px-4 py-2">أزرق</td>
                            <td class="px-4 py-2">لا يوجد</td>
                            <td class="px-4 py-2 space-x-2">
                                <button class="bg-green-500 text-white px-3 py-1 rounded">تم</button>
                                <button class="bg-blue-500 text-white px-3 py-1 rounded">تواصل</button>
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded">إرسال ملاحظة</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded">مسح</button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 text-center">
                            <td class="px-4 py-2">1002</td>
                            <td class="px-4 py-2">بنطلون</td>
                            <td class="px-4 py-2">متوسط</td>
                            <td class="px-4 py-2">L</td>
                            <td class="px-4 py-2">أسود</td>
                            <td class="px-4 py-2">يرجى التأكد من الجودة</td>
                            <td class="px-4 py-2 space-x-2">
                                <button class="bg-green-500 text-white px-3 py-1 rounded">تم</button>
                                <button class="bg-blue-500 text-white px-3 py-1 rounded">تواصل</button>
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded">إرسال ملاحظة</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded">مسح</button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 text-center">
                            <td class="px-4 py-2">1003</td>
                            <td class="px-4 py-2">حذاء</td>
                            <td class="px-4 py-2">صغير</td>
                            <td class="px-4 py-2">42</td>
                            <td class="px-4 py-2">أبيض</td>
                            <td class="px-4 py-2">عند التوصيل يرجى الاتصال</td>
                            <td class="px-4 py-2 space-x-2">
                                <button class="bg-green-500 text-white px-3 py-1 rounded">تم</button>
                                <button class="bg-blue-500 text-white px-3 py-1 rounded">تواصل</button>
                                <button class="bg-yellow-500 text-white px-3 py-1 rounded">إرسال ملاحظة</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded">مسح</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- الترقيم -->
            <div id="pagination" class="flex justify-center mt-4 space-x-2"></div>
        </div>
    </body>
    </html>
</x-app-layout>
