<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Validator;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Admin - Data Koleksi";
        $collections = Collection::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.koleksi.index', compact('title', 'collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $collection = Collection::findOrFail($id);
        return view('admin.koleksi.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul_tugas_akhir' => 'required',
            'nama_penulis' => 'required',
            'nama_pembimbing' => 'required',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'tahun_terbit' => 'required|digits:4',
            'abstrak_indo' => 'required',
            'abstrak_eng' => 'required',
            'nomer_reg' => 'required',
            'kata_kunci' => 'required',
            'tanggal_unggah' => 'required|date',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $collection = Collection::findOrFail($id);
        $collection->update($request->all());

        return redirect()->route('admin.koleksi.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $koleksi = Collection::findOrFail($id); // Find or 404 if not found
        $koleksi->delete(); // Delete the record

        return redirect()->route('admin.koleksi.index')
                        ->with('success', 'Koleksi berhasil dihapus.');
    }
}
