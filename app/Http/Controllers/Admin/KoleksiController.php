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
        return view('admin.koleksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
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
        ],
        [
            'required' => ':attribute wajib diisi.',
            'digits' => ':attribute harus berupa :digits digit angka.',
            'date' => ':attribute harus berupa tanggal yang valid.',
        ],
        [
            'judul_tugas_akhir' => 'Judul Tugas Akhir',
            'nama_penulis' => 'Nama Penulis',
            'nama_pembimbing' => 'Nama Pembimbing',
            'program_studi' => 'Program Studi',
            'fakultas' => 'Fakultas',
            'tahun_terbit' => 'Tahun Terbit',
            'abstrak_indo' => 'Abstrak (Indonesia)',
            'abstrak_eng' => 'Abstrak (English)',
            'nomer_reg' => 'Nomor Registrasi',
            'kata_kunci' => 'Kata Kunci',
            'tanggal_unggah' => 'Tanggal Unggah',
            'status' => 'Status',
        ]);

        Collection::create($request->all());

        return redirect()->route('admin.koleksi.index')->with('success', 'Data berhasil ditambahkan!');
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
        $request->validate([
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
        ], 
        [
            // Custom messages
            'required' => ':attribute wajib diisi.',
            'digits' => ':attribute harus berupa :digits digit angka.',
            'date' => ':attribute harus berupa tanggal yang valid.',
        ], 
        [
            // Custom attribute names
            'judul_tugas_akhir' => 'Judul Tugas Akhir',
            'nama_penulis' => 'Nama Penulis',
            'nama_pembimbing' => 'Nama Pembimbing',
            'program_studi' => 'Program Studi',
            'fakultas' => 'Fakultas',
            'tahun_terbit' => 'Tahun Terbit',
            'abstrak_indo' => 'Abstrak (Indonesia)',
            'abstrak_eng' => 'Abstrak (English)',
            'nomer_reg' => 'Nomor Registrasi',
            'kata_kunci' => 'Kata Kunci',
            'tanggal_unggah' => 'Tanggal Unggah',
            'status' => 'Status',
        ]);

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
