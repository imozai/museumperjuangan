<?php

namespace App\Http\Controllers;

use DB;
use App\AdminUser;
use App\Kritik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin',['except' => ['logout','create','updatepass','indexKritik']]);
    }

    public function index() {
        return view('admin.login');
    }

    public function indexregister() {
        if(!Auth::guard('admin')->check()){
            return redirect('admin/login')->withErrors([
                'message' => 'Anda tidak punya akses'
            ]);
        }
        return view('admin.register');
    }

    public function store(Request $request) {
        // Validate the user
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Log the user In
        $credentials = $request->only('email','password');

        if (! Auth::guard('admin')->attempt($credentials)) {
            return back()->withErrors([
                'message' => 'Email atau Password salah, coba lagi !'
            ]);
        }

        // Session message
        session()->flash('msg','Anda telah Login');

        return redirect('/admin');
    }

    public function create(Request $data)
    {
        AdminUser::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'darkmode' => 0,
            'view_userpage' => $data->viewuser,
            'created_at' => Carbon::now()
        ]);

        session()->flash('msg','Berhasil Daftar');

        return redirect('/admin');
    }

    public function updatepass(Request $data)
    {
        $admin = AdminUser::find($data->id);

        $admin->update([
            'password' => Hash::make($data->password),
            'updated_at' => Carbon::now()
        ]);

        session()->flash('msg','Berhasil Ganti Password Master Admin');

        return redirect('/admin');
    }

    public function updatedark(Request $data)
    {
        $admin = AdminUser::find($data->id);

        $slide = 1;

        if($data->darkmode == true){
            $slide = 1;
        }
        else{
            $slide = 0;
        }

        $admin->update([
            'darkmode' => $slide,
            'updated_at' => Carbon::now()
        ]);

        if($data->darkmode == true){
            session()->flash('msg','DarkMode Aktif');
        }
        else{
            session()->flash('msg','DarkMode Non-Aktif');
        }

        return redirect('/admin');
    }

    public function updatenormaladmin(Request $data, $id)
    {
        $admin = AdminUser::find($id);

        $admin->update([
            'password' => Hash::make($data->password),
            'updated_at' => Carbon::now()
        ]);

        session()->flash('msg','Berhasil Ganti Password Admin');

        return redirect('/admin');
    }

    public function deletenormaladmin($id)
    {
        AdminUser::destroy($id);

        session()->flash('msg','Berhasil Hapus Admin');

        return redirect('/admin');
    }

    public function indexKritik() {
        
        $kritik = Kritik::all();

        return view('admin.kritik', compact('kritik'));
    }


    public function logout() {
        DB::table('admin_users')
        ->where('id',Auth::guard('admin')->user()->id)
        ->update([
            'login_at' => Carbon::now(),
        ]);

        auth()->guard('admin')->logout();

        session()->flash('msg','Anda telah Logout');

        return redirect('/admin/login');
    }

}
