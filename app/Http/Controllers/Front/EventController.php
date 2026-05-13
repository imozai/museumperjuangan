<?php

namespace App\Http\Controllers\Front;

use DB;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(){

        $event = Event::all();

        return view('front.info.event', compact('event'));
    }

    public function show(Event $event)
    {
        return view('front.detailsEvent', compact('event'));
    }

    public function filterNew(Request $request)
    {
        $today = date('Y-m-d H:i');
        $today = date('Y-m-d H:i', strtotime($today));

        if($request->new == 'first' ){
            $cari = $request->new;
            $post = Event::whereBetween('created_at',['1999-01-01', '3000-01-01'])->orderBy('created_at','asc')->get();

            $request->session()->flash('msg',$posts->count().' Hasil Pencarian dengan filter Event Paling Lama');
            return view('front.info.event',['event' => $post])-> with('status',"Hasil Pencarian : ".$cari);
        }
        else if($request->new == 'berlangsung' ){
            $cari = $request->new;
            $posts =  Event::whereBetween('tgl_mulai',[$today,'tgl_selesai'])->get();

            $request->session()->flash('msg',$posts->count().' Hasil Pencarian dengan filter Event yang sedang Berlangsung');
            return view('front.info.event',['event' => $posts])-> with('status',$posts->count()."Hasil Pencarian : ".$cari);
        }
        else if($request->new == 'segera' ){
            $cari = $request->new;
            $posts = Event::where('tgl_mulai','>=',$today)->get(); 
            

            $request->session()->flash('msg',$posts->count().' Hasil Pencarian dengan filter Event yang akan Segara mulai');
            return view('front.info.event',['event' => $posts])-> with('status',"Hasil Pencarian : ".$cari);
        }
        else if($request->new == 'berakhir' ){
            $cari = $request->new;
            $posts = Event::where('tgl_mulai','<=',$today)->where('tgl_selesai','<',$today)->get();

            $request->session()->flash('msg',$posts->count().' Hasil Pencarian dengan filter Event yang telah Berakhir');
            return view('front.info.event',['event' => $posts])-> with('status',"Hasil Pencarian : ".$cari);
        }
        else if($request->new == 'last' ){
            $cari = $request->new;
            $post = Event::whereBetween('created_at',['1999-01-01', '3000-01-01'])->orderBy('created_at','desc')->get();

            $request->session()->flash('msg',$posts->count().' Hasil Pencarian dengan filter Event Paling Baru');
            return view('front.info.event',['event' => $post])-> with('status',"Hasil Pencarian : ".$cari);
        }
        else{
            $event = Event::all();

            return view('front.info.event', compact('event'));
        }
    }

    public function search(Request $request)
    {
        $cari = $request->search;
        $post = DB::table('events')
        ->where('title','like',"%".$cari."%")
        ->paginate();

        $request->session()->flash('msg',$post->count().' Hasil untuk Pencarian Event : '.$cari);
        return view('front.info.event',['event' => $post])-> with('status',"Hasil Pencarian : ".$cari);
    }

    public function filterDateEvent(Request $request)
    {
        $awal = date('Y-m-d', strtotime($request->startD));
        $akhir = date('Y-m-d', strtotime($request->endD));

        $event = Event::whereBetween('tgl_mulai',[$awal, $akhir])->get();

        $request->session()->flash('msg',$event->count().' Hasil Filter Event pada Tanggal '.$awal.' - '.$akhir);
        return view('front.info.event',compact('event'));
    }
}