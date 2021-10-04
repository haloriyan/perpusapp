<?php

namespace App\Http\Controllers;

use App\Models\LayananPerpustakaan as Layanan;
use Sastrawi\Stemmer\StemmerFactory;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Layanan;
        }
        return Layanan::where($filter);
    }
    public function store(Request $request) {
        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        $name = $request->name;
        $stemmedName = $stemmer->stem($name);

        $saveData = Layanan::create([
            'name' => $name,
            'stemmed_name' => $stemmedName,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.layananPerpustakaan')->with([
            'message' => "Layanan ".$request->name." berhasil ditambahkan"
        ]);
    }
    public function edit($id) {
        $myData = AdminController::me();
        $layanan = Layanan::where('id', $id)->first();

        return view('admin.layananEdit', [
            'layanan' => $layanan,
            'myData' => $myData,
        ]);
    }
    public function update(Request $request) {
        $id = $request->id;
        $data = Layanan::where('id', $id);
        $layanan = $data->first();

        $updateData = $data->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.layananPerpustakaan')->with([
            'message' => "Layanan ".$layanan->name." berhasil diubah"
        ]);
    }
    public function delete($id) {
        $data = Layanan::where('id', $id);
        $layanan = $data->first();
        $deleteData = $data->delete();

        return redirect()->route('admin.layananPerpustakaan')->with([
            'message' => "Layanan ".$layanan->name." berhasil dihapus"
        ]);
    }
}
