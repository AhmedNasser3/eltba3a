<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\admin\ChatController;
use App\Http\Controllers\admin\ServiceController;

Route::get('/', function(){
return view('frontend.home.index');
})->name('home.page');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/order', function(){
return view('profile.order');
});
Route::get('/order/detail', function(){
return view('profile.details');
});
// Service
Route::controller(ServiceController::class)->prefix('/service')->group(function(){
    Route::get('/create','create')->name('service.create');
    Route::post('/store',action: 'store')->name('service.store');
});
// chat
Route::controller(ChatController::class)->prefix('chat')->group(function(){
    Route::get('/showOrder', 'index')->name('chat.show.order');
});
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index'); // صفحة عرض المحادثات
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show'); // صفحة عرض الرسائل داخل محادثة معينة
    Route::post('/chats/{chat}/messages', [ChatController::class, 'sendMessage'])->name('chats.send');
// admin
Route::get('/admin', [AdminHomeController::class, 'index'])->name('admin.page');
Route::get('/admin/service/show', [AdminHomeController::class, 'serviceShow'])->name('admin.serviceShow');
Route::post('/orders/update-status', [AdminHomeController::class, 'updateStatus'])->name('orders.updateStatus');
