<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Session;
use Carbon\Carbon;
use App\Models\Chat;
use App\Models\Admin;
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
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        $message = Session::get('message');
        
        return view('admin.login', [
            'message' => $message
        ]);
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
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $visitors = VisitorController::get()->whereBetween('created_at', [$startDate, $endDate])->get('id');
        $services = LayananController::get()->get('id');
        $books = BukuController::get()->get('id');

        $famousBookRawData = Chat::where('interested_book', '!=', 'NULL')
        ->whereBetween('created_at', [$startDate, $endDate])->get();
        $famousServiceRawData = Chat::where('interested_service', '!=', 'NULL')
        ->whereBetween('created_at', [$startDate, $endDate])->get();

        $famousBooks = $famousServices = [];
        foreach ($famousBookRawData as $data) {
            if (array_key_exists($data->buku->judul, $famousBooks)) {
                $famousBooks[$data->buku->judul] += 1;
            } else {
                $famousBooks[$data->buku->judul] = 1;
            }
        }
        foreach ($famousServiceRawData as $data) {
            if (array_key_exists($data->service->name, $famousServices)) {
                $famousServices[$data->service->name] += 1;
            } else {
                $famousServices[$data->service->name] = 1;
            }
        }
        ksort($famousBooks);
        ksort($famousServices);

        return view('admin.dashboard', [
            'myData' => $myData,
            'message' => $message,
            'visitors' => $visitors,
            'books' => $books,
            'services' => $services,
            'famousBooks' => $famousBooks,
            'famousServices' => $famousServices,
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

        $bukus = BukuController::get($filter)->paginate(25);

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

        $visitors = VisitorController::get()->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.visitor', [
            'myData' => $myData,
            'message' => $message,
            'visitors' => $visitors,
        ]);
    }
    public function admin() {
        $myData = self::me();
        $message = Session::get('message');

        $admins = Admin::orderBy('created_at', 'DESC')->get();

        return view('admin.admin', [
            'myData' => $myData,
            'message' => $message,
            'admins' => $admins,
        ]);
    }
    public function store(Request $request) {
        $saveData = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.admin')->with(['message' => "Admin baru berhasil ditambahkan"]);
    }
    public function delete($id) {
        $data = Admin::where('id', $id);
        $admin = $data->first();
        $deleteData = $data->delete();

        return redirect()->route('admin.admin')->with(['message' => "Admin ".$admin->name." berhasil dihapus"]);
    }
    public function update(Request $request) {
        $id = $request->id;
        $data = Admin::where('id', $id);
        $admin = $data->first();
        $toUpdate = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password != "") {
            $toUpdate['password'] = bcrypt($request->password);
        }

        $updateData = $data->update($toUpdate);

        if ($request->from_profile != 1) {
            return redirect()->route('admin.admin')->with(['message' => "Data admin ".$admin->name." berhasil diubah"]);
        } else {
            return redirect()->route('admin.profile')->with(['message' => "Profil berhasil diubah"]);
        }
    }
    public function updatePassword(Request $request) {
        $myData = self::me();
        $data = Admin::where('id', $myData->id);
        $admin = $data->first();

        if (!Hash::check($request->old_password, $admin->password)) {
            return redirect()->route('admin.profile')->withErrors(["Password lama tidak tepat"]);
        } else {
            if ($request->new_password != $request->retype_password) {
                return redirect()->route('admin.profile')->withErrors(["Verifikasi gagal, password tidak sama"]);
            }
        }
        
        $updateData = $data->update(['password' => bcrypt($request->new_password)]);
        $loggingOut = Auth::guard('admin')->logout();
        
        return redirect()->route('admin.loginPage')->with(['message' => "Password berhasil diubah. Silakan login kembali menggunakan password baru"]);
    }
    public function profile() {
        $myData = self::me();
        $message = Session::get('message');

        return view('admin.profile', [
            'myData' => $myData,
            'message' => $message
        ]);
    }
}
