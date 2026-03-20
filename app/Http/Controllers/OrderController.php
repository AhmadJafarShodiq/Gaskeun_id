<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_title' => 'required|string|max:100',
            'client_name'   => 'required|string|max:100',
            'project_title' => 'required|string|max:200',
            'project_details' => 'required|string|max:2000',
            'duration_days' => 'required|string|max:50',
            'price'         => 'required|numeric|min:0',
        ]);

        // Cari service berdasarkan title
        $service = Service::where('title', $request->service_title)->first();

        // Generate order number unik
        $orderNumber = 'ORD-' . strtoupper(Str::random(8));

        Order::create([
            'order_number'   => $orderNumber,
            'service_id'     => $service ? $service->id : null,
            'client_name'    => $request->client_name,
            'whatsapp_number' => $request->whatsapp_number ?? '-',
            'project_title'  => $request->project_title,
            'project_details' => $request->project_details,
            'duration_days'  => $request->duration_days,
            'price'          => $request->price,
            'status'         => 'proses',
        ]);

        return response()->json(['success' => true, 'order_number' => $orderNumber]);
    }
}
