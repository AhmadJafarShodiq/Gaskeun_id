<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolios', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:2000',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image_path')->store('portfolios', 'public');

        Portfolio::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return back()->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:2000',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $portfolio = Portfolio::findOrFail($id);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ];

        if ($request->hasFile('image_path')) {
            // Delete old
            if (Storage::disk('public')->exists($portfolio->image_path)) {
                Storage::disk('public')->delete($portfolio->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('portfolios', 'public');
        }

        $portfolio->update($data);

        return back()->with('success', 'Portofolio berhasil diupdate!');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if (Storage::disk('public')->exists($portfolio->image_path)) {
            Storage::disk('public')->delete($portfolio->image_path);
        }
        $portfolio->delete();

        return back()->with('success', 'Portofolio berhasil dihapus!');
    }
}
