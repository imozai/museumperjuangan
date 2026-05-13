<?php

namespace App\Http\Controllers\Front;

use DB;
use App\Koleksi;
use App\News;
use App\Event;
use App\AdminUser;
use App\Kritik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        $koleksi = Koleksi::where('slide','=',1)->get();
        $news = News::inRandomOrder()->take(3)->get();
        $event = Event::inRandomOrder()->take(3)->get();
        $adminuser = AdminUser::all();

        $today = date('Y-m-d H:i');
        $today = date('Y-m-d H:i', strtotime($today));
        $events = Event::where('tgl_selesai','>=',$today)->get();

        foreach ($adminuser as $key) {
            DB::table('admin_users')
            ->where('id',$key->id)
            ->update([
                'view_userpage' => DB::raw('view_userpage + 1')
            ]);
        }
        

        return view('front.index', compact('koleksi','news','event','events'));
    }

    public function lantai_bawah() {
        $koleksi = Koleksi::where('lantai','Bawah')->get();
        

        return view('front.info.lantai_bawah', compact('koleksi'));
    }

    public function lantai_atas() {
        $koleksi = Koleksi::where('lantai','Atas')->get();
        

        return view('front.info.lantai_atas', compact('koleksi'));
    }

    public function showKoleksi($id)
    {
        $koleksi = Koleksi::find($id);

        return view('front.layouts.detailskoleksi', compact ('koleksi'));
    }

    public function showBerita($id)
    {
        $news = News::find($id);

        return view('front.layouts.detailsnews', compact ('news'));
    }

    public function showEvent($id)
    {
        $event = Event::find($id);

        return view('front.layouts.detailsevent', compact ('event'));
    }

    public function searchKoleksi(Request $request)
    {
        if($request->searchBawah == ""){ 
            $cari = $request->searchAtas;
            $post = DB::table('koleksis')
            ->where('lantai','Atas')
            ->where('name','like',"%".$cari."%")
            ->paginate();
            $request->session()->flash('msg',$post->count().' Hasil untuk Pencarian Koleksi : '.$cari);
            return view('front.info.lantai_atas',['koleksi' => $post])-> with('status',"Hasil Pencarian : ".$cari);
        }
        else{
            $cari = $request->searchBawah;
            $post = DB::table('koleksis')
            ->where('lantai','Bawah')
            ->where('name','like',"%".$cari."%")
            ->paginate();
            $request->session()->flash('msg',$post->count().' Hasil untuk Pencarian Koleksi : '.$cari);
            return view('front.info.lantai_bawah',['koleksi' => $post])-> with('status',"Hasil Pencarian : ".$cari);
        }
    }

    public function createKritik(Request $data)
    {
        Kritik::create([
            'nama' => $data->name,
            'email' => $data->email,
            'title' => $data->title,
            'kritik' => $data->kritik,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'status' => 0,
            'handle_by' => 'Admin'
        ]);


        $data->session()->flash('msg','Kritik/Saran anda telah terkirim, secepatnya akan kami tanggapi lewat email.  Terima Kasih');
        return redirect('/');
    }
}