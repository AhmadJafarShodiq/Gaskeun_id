<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'whatsapp_number' => ['nullable', 'string', 'max:25', 'regex:/^[\d\s\-\+]+$/'],
            'message' => 'required|string|max:2000',
        ]);

        Inquiry::create($validated);

        return response()->json(['success' => true, 'message' => 'Pesan terkirim! Admin akan segera membalas.']);
    }

    public function update($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->update(['status' => 'replied']);
        return back()->with('success', 'Chat ditandai sebagai dibalas!');
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();
        return back()->with('success', 'Chat berhasil dihapus!');
    }
}
