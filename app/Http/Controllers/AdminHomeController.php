<?php

namespace App\Http\Controllers;

use App\Models\admin\Service;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(){
        $orders = Service::where('status', 0)->get();
        return view('admin.home.index',compact('orders'));
    }
    public function serviceShow(){
        $orders = Service::where('status', 1)->get();
        return view('admin.pages.services.show',data: compact('orders'));
    }
    public function updateStatus(Request $request)
    {
        $order = Service::find($request->order_id);

        if ($order) {
            $order->status = $request->status;
            $order->save();

            return response()->json(['success' => true, 'message' => 'تم تحديث الحالة بنجاح']);
        }

        return response()->json(['success' => false, 'message' => 'لم يتم العثور على الطلب'], 404);
    }

}