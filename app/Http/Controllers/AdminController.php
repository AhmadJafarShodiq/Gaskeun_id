<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Inquiry;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with('service')->latest()->take(5)->get();
        $inquiries = Inquiry::latest()->take(5)->get();
        
        $totalEarned = Order::where('status', 'selesai')->sum('price');
        $totalBatal  = Order::where('status', 'batal')->count();
        $totalOrder  = Order::count();
        $totalProgres = Order::where('status', 'proses')->count();
        
        $inquiryCount = Inquiry::count();
        $unreadCount  = Inquiry::where('status', 'unread')->count();
        
        $services = Service::all();
        
        return view('admin.dashboard', compact(
            'orders', 'inquiries', 'totalEarned', 'totalBatal', 
            'totalOrder', 'totalProgres', 'inquiryCount', 'unreadCount', 
            'services'
        ));
    }

    public function orders()
    {
        $orders = Order::with('service')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrder(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:proses,selesai,batal']);
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    public function inquiries()
    {
        $inquiries = Inquiry::latest()->get();
        return view('admin.inquiries', compact('inquiries'));
    }
}
