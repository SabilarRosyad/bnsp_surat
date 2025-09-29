<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{
    /**
     * Tampilkan daftar surat + fitur pencarian
     */
    public function index(Request $request)
    {
        $query = Letter::query();

        if ($request->has('search')) {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(title) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(nomor_surat) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(kategori) LIKE ?', ['%' . $search . '%']);
        }

        $letters = $query->orderBy('date', 'desc')->paginate(10);

        return view('letters.index', compact('letters'));
    }

    /**
     * Tampilkan form tambah surat
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('letters.create', compact('categories'));
    }

    /**
     * Simpan surat baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'kategori' => 'required|string',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Upload file
        $filePath = null;
        if ($request->hasFile('file')) {
            // Simpan ke storage/app/public/uploads
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        // Simpan ke database
        Letter::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'title' => $request->title,
            'date' => $request->date,
            'file_path' => $filePath, // otomatis terisi path hasil upload
        ]);

        return redirect()->route('letters.index')->with('success', 'Surat berhasil ditambahkan.');
    }

    /**
     * Download file surat
     */
    public function download($id)
    {
        $letter = Letter::findOrFail($id);
        return Storage::disk('public')->download($letter->file_path);
    }

    /**
     * Detail surat
     */
    public function show($id)
    {
        $letter = Letter::findOrFail($id);
        return view('letters.show', compact('letter'));
    }

    /**
     * Form edit surat
     */
    public function edit($id)
    {
        $letter = Letter::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('letters.edit', compact('letter', 'categories'));
    }

    /**
     * Update surat
     */
    public function update(Request $request, $id)
    {
        $letter = Letter::findOrFail($id);

        // Validasi input
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'nomor_surat' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'file_path'   => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Ambil data selain file
        $data = $request->only(['title', 'description', 'date', 'nomor_surat', 'kategori']);

        // Kalau ada file baru di-upload
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');

            // Hapus file lama jika ada
            if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
                Storage::disk('public')->delete($letter->file_path);
            }

            // Simpan file baru ke folder storage/app/public/letters
            $filePath = $file->store('letters', 'public');
            $data['file_path'] = $filePath;
        }

        // Update data ke database
        $letter->update($data);

        return redirect()->route('letters.index')->with('success', 'Surat berhasil diperbarui.');
    }

    /**
     * Hapus surat
     */
    public function destroy($id)
    {
        $letter = Letter::findOrFail($id);

        if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
            Storage::disk('public')->delete($letter->file_path);
        }

        $letter->delete();

        return redirect()->route('letters.index')->with('success', 'Surat berhasil dihapus.');
    }
}
