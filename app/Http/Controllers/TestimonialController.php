<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'project_name' => 'nullable|string|max:100',
            'comment' => 'required|string|max:1000',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'project_name', 'comment']);

        if ($request->hasFile('screenshot')) {
            $data['screenshot'] = $request->file('screenshot')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return back()->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'project_name' => 'nullable|string|max:100',
            'comment' => 'required|string|max:1000',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $data = $request->only(['name', 'project_name', 'comment']);

        if ($request->hasFile('screenshot')) {
            if ($testimonial->screenshot && Storage::disk('public')->exists($testimonial->screenshot)) {
                Storage::disk('public')->delete($testimonial->screenshot);
            }
            $data['screenshot'] = $request->file('screenshot')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return back()->with('success', 'Testimoni berhasil diupdate!');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->screenshot && Storage::disk('public')->exists($testimonial->screenshot)) {
            Storage::disk('public')->delete($testimonial->screenshot);
        }
        $testimonial->delete();

        return back()->with('success', 'Testimoni berhasil dihapus!');
    }
}
