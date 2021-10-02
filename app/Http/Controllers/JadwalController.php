<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Jadwal;
        }
        return Jadwal::where($filter);
    }
    public function update(Request $request) {
        $id = $request->id;
        $data = Jadwal::where('id', $id);
        $jadwal = $data->first();

        $updateData = $data->update([
            'waktu_buka' => $request->waktu_buka,
            'waktu_buka_covid' => $request->waktu_buka_covid,
            'waktu_tutup' => $request->waktu_tutup,
            'waktu_tutup_covid' => $request->waktu_tutup_covid,
            'is_covid' => $request->is_covid,
        ]);

        return redirect()->route('admin.jadwal')->with([
            'message' => "Jadwal hari ".$jadwal->hari." diubah"
        ]);
    }
}
