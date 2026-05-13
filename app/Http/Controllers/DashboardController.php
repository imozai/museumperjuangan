<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Dashboard;
use App\Koleksi;
use App\News;
use App\Event;
use App\Kritik;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Input;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
	public $path;
	public $dimensions;

	public function __construct()
    {
    	$this->path = public_path('uploads/compress');
        $this->dimensions = ['800'];
    }

    public function indexKritik() {
        
        $kritik = Kritik::all();

        return view('admin.kritiksaran', compact('kritik'));
    }

    public function filterKritik(Request $request)
    {
        $cari = $request->kritFilter;
        if( $cari == "koleksi" || $cari == "event" || $cari == "dashboard" || $cari == "berita" || $cari == "" ){
            $kritik = Kritik::where('title','like',"%".$cari."%")
                    ->paginate();
            if($cari == ""){
                $cari="Semua";
            }
            $request->session()->flash('msg',$kritik->count().' Hasil dengan filter '.$cari);
            return view('admin.kritiksaran',['kritik' => $kritik]);
            
        }
        else if( $cari == 1 || $cari == 0 ) {
            $kritik = Kritik::where('status','like',"%".$cari."%")
                    ->paginate();
            if($cari == 1){
                $cari="Sudah Review";
            }
            if($cari == "0"){
                $cari="Belum Review";
            }
            $request->session()->flash('msg',$kritik->count().' Hasil dengan filter '.$cari);
            return view('admin.kritiksaran',['kritik' => $kritik]);
        }
        else{
            $kritik = Kritik::where('title','like',"%".$cari."%")
                    ->paginate();
            $request->session()->flash('msg',$kritik->count().' Hasil dengan filter '.$cari);
            return view('admin.kritiksaran',['kritik' => $kritik]);
        }
    }

    public function updateKritik(Request $data)
    {
        $kritik = Kritik::find($data->id);

        $kritik->update([
            'status' => 1,
            'handle_by' => Auth::guard('admin')->user()->name,
            'updated_at' => Carbon::now()
        ]);

        session()->flash('msg','Kritik/Saran dengan id #KS-'.$data->id.' Telah di Review');

        return redirect('/admin/kritik');
    }

    public function printAdmin()
    {
        $admin = AdminUser::all();
 
        $pdf = PDF::loadview('admin.print_admin',['admin'=>$admin]);
        return $pdf->stream();
    }

    public function index() {
        $adminuser = AdminUser::all();
        $kritik = Kritik::all();
        
        $koleksi = new Koleksi();
        $koleksis = Koleksi::where('slide','=',1)->get();

        $news = new News();

        $event = new Event();
        $today = date('Y-m-d');
        $today = date('Y-m-d', strtotime($today));
        $events = Event::where('tgl_mulai','>=',$today)->get();
        

        return view('admin.dashboard', compact('koleksi' , 'news' , 'event' , 'koleksis' , 'events' , 'adminuser','kritik'));
    }

    public function store(Request $request) {

    	if($request->file('image')) {
            if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
                File::makeDirectory($this->path);
        	}
		
        	//MENGAMBIL FILE IMAGE DARI FORM
        	$file = $request->file('image');
        	//MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        	$fileName = "dashboard.jpg";
        	//UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
            $img = Image::make($file)->insert($this->path. '/' .'LogoMBVY.png','bottom-right', 10, 10);
        	$img->save($this->path . '/' . $fileName);
        } else {
            $image = NULL;
        }

		$request->session()->flash('msg','Gambar dashboard telah di updated');
        return redirect('admin');
    }

}