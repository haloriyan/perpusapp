<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Buku;
        }
        return Buku::where($filter);
    }
    public function store(Request $request) {
        $saveData = Buku::create([
            'no_klasifikasi' => $request->no_klasifikasi,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'subyek' => $request->subyek,
            'deskripsi_fisik' => $request->deskripsi_fisik,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('admin.buku')->with([
            'message' => "Buku ".$request->judul." berhasil ditambahkan"
        ]);
    }
    public function update(Request $request) {
        $id = $request->id;

        $data = Buku::where('id', $id);
        $buku = $data->first();

        $updateData = $data->update([
            'no_klasifikasi' => $request->no_klasifikasi,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'subyek' => $request->subyek,
            'deskripsi_fisik' => $request->deskripsi_fisik,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('admin.buku')->with([
            'message' => "Buku ".$buku->judul." berhasil diubah"
        ]);
    }
    public function delete($id) {
        $data = Buku::where('id', $id);
        $buku = $data->first();
        $deleteData = $buku->delete();
        
        return redirect()->route('admin.buku')->with([
            'message' => "Buku ".$buku->judul." berhasil dihapus"
        ]);
    }
}
