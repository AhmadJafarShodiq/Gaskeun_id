<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'icon' => 'required|string|max:50',
            'base_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'estimated_days' => 'required|numeric|min:1|max:365',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        Service::create($validated);

        return back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'icon' => 'required|string|max:50',
            'base_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'estimated_days' => 'required|numeric|min:1|max:365',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);

        return back()->with('success', 'Layanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return back()->with('success', 'Layanan berhasil dihapus!');
    }
}
