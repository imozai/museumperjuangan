<?php

namespace App\Http\Controllers\Front;

use DB;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index() {

        $news = News::inRandomOrder()->take(4)->get();

        return view('front.info.berita', compact('news'));
    }

    public function show(News $news)
    {
        return view('front.detailsNews', compact ('news'));
    }

    public function filterNew(Request $request)
    {
        $today = date('Y-m-d');
        $today = date('Y-m-d', strtotime($today));
        if($request->new == 'first' ){
            $cari = $request->new;
            $post = News::whereBetween('created_at',['1999-01-01', $today])->orderBy('created_at','asc')->get();

            $request->session()->flash('msg','Pencarian dengan filter Berita Terbaru');
            return view('front.info.berita',['news' => $post])-> with('status',"Hasil Pencarian : ".$cari);
        }
        else{
            $cari = $request->new;
            $post = News::whereBetween('created_at',['1999-01-01', $today])->orderBy('created_at','desc')->get();

            $request->session()->flash('msg','Pencarian dengan filter Berita Terlama');
            return view('front.info.berita',['news' => $post])-> with('status',"Hasil Pencarian : ".$cari);
        }
    }

    public function search(Request $request)
    {
        $cari = $request->search;
        $post = DB::table('news')
        ->where('title','like',"%".$cari."%")
        ->paginate();

        $request->session()->flash('msg','Pencarian dengan filter Berita');
        return view('front.info.berita',['news' => $post])-> with('status',"Hasil Pencarian : ".$cari);
    }

    public function filterDateNews(Request $request)
    {
        $awal = Carbon::parse($request->startD);
        $akhir = Carbon::parse($request->endD);

        $news = News::whereBetween('created_at',[$awal, $akhir])->get();

        $request->session()->flash('msg',$news->count().' Hasil Filter Berita pada Tanggal '.$awal.' - '.$akhir);
        return view('front.info.berita',compact('news'));
    }
}