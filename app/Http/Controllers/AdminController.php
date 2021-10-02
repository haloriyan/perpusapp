<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public static function me() {
        $myData = Auth::guard('admin')->user();
        if ($myData != "") {
            $name = explode(" ", $myData->name);
            $myData->first_name = $name[0];
            if (array_key_exists(1, $name)) {
                $myData->initial = $myData->first_name[0].$name[1][0];
            } else {
                $myData->initial = $myData->first_name[0];
            }
        }

        return $myData;
    }
    public function loginPage() {
        return view('admin.login');
    }
    public function login(Request $request) {
        $loggingIn = Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        if (!$loggingIn) {
            return redirect()->route('admin.loginPage')->withErrors([
                'Kombinasi email dan kata sandi tidak tepat'
            ]);
        }

        return redirect()->route('admin.dashboard');
    }
    public function logout() {
        $loggingOut = Auth::guard('admin')->logout();
        return redirect()->route('admin.loginPage');
    }
    public function dashboard() {
        $myData = self::me();
        $message = Session::get('message');

        return view('admin.dashboard', [
            'myData' => $myData,
            'message' => $message,
        ]);
    }
    public function layananPerpustakaan() {
        $myData = self::me();
        $message = Session::get('message');
        $layanans = LayananController::get()->get();
        
        return view('admin.layanan', [
            'myData' => $myData,
            'message' => $message,
            'layanans' => $layanans,
        ]);
    }
    public function buku(Request $request) {
        $myData = self::me();
        $message = Session::get('message');
        $filter = [];

        if ($request->judul != "") {
            $filter[] = ['judul', 'LIKE', "%".$request->judul."%"];
        }

        $bukus = BukuController::get($filter)->paginate(10);

        return view('admin.buku', [
            'myData' => $myData,
            'message' => $message,
            'bukus' => $bukus,
        ]);
    }
    public function jadwalPerpustakaan() {
        $myData = self::me();
        $message = Session::get('message');

        $jadwals = JadwalController::get()->get();

        return view('admin.jadwal', [
            'myData' => $myData,
            'message' => $message,
            'jadwals' => $jadwals,
        ]);
    }
    public function visitor() {
        $myData = self::me();
        $message = Session::get('message');

        $visitors = VisitorController::get()->orderBy('created_at', 'DESC')->get();

        return view('admin.visitor', [
            'myData' => $myData,
            'message' => $message,
            'visitors' => $visitors,
        ]);
    }
}
