<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar kategori + fitur pencarian
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search')) {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
        }

        $categories = $query->orderBy('id', 'asc')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        $lastId = Category::max('id');
        $nextId = $lastId ? $lastId + 1 : 1;

        return view('categories.create', compact('nextId'));
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $lastId = Category::max('id');
        $nextId = $lastId ? $lastId + 1 : 1;

        Category::create([
            'id'          => $nextId,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
