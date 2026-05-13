<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use PDF;

class EventController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        $this->path = public_path('uploads/event');
        $this->dimensions = ['245', '300', '500'];
    }

    public function index() {

        $event = Event::all();

        return view('admin.event.index', compact('event'));
    }

    public function create() {
        $event = new Event();
        return view('admin.event.create', compact('event'));
    }

    public function print()
    {
        $event = Event::all();
 
        $pdf = PDF::loadview('admin.event.print',['event'=>$event]);
        return $pdf->stream();
    }

    public function store(Request $request) {

        // Validate the form
        $request->validate([
           'title' => 'required',
            'content' => 'required',
            'created_by' => 'required',
        ]);

        // Upload the image
        if($request->file('image')) {
            if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
            }
        
            //MENGAMBIL FILE IMAGE DARI FORM
            $file = $request->file('image');
            //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.str_replace(' ', '', $request->title).'.'.$acak;
            //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
            
            foreach ($this->dimensions as $row) {
                //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY 
                $canvas = Image::canvas($row, $row);
                //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY 
                //DENGAN MEMPERTAHANKAN RATIO
                $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                    $constraint->aspectRatio();
                });
            
                //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
                $canvas->insert($resizeImage, 'center');
                //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
                $canvas->save($this->path . '/' . $row . '/' . $fileName);
            }
        } else {
            $fileName = NULL;
        }

        Event::create([
            'title' => $request->title,
            'content' => $request->content,
            'tempat' => $request->tempat,
            'tgl_mulai' => $request->tgl_mulai. ' ' .$request->jam_mulai,
            'tgl_selesai' => $request->tgl_selesai. ' ' .$request->jam_selesai,
            'created_by' => $request->created_by,
            'image' => $fileName

        ]);

        // Sessions Message
        $request->session()->flash('msg','Event '.$request->title.' telah di Tambahkan');

        // Redirect

        return redirect('admin/event');

    }

    public function edit($id) {
        $event = Event::find($id);
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, $id) {

        // Find the product
        $event = Event::find($id);

        // Validate The form
        $request->validate([
           'title' => 'required',
            'content' => 'required',
            'created_by' => 'required',
        ]);

        // Check if there is any image
        if ($request->hasFile('image')) {
            // Check if the old image exists inside folder
            if (file_exists(public_path('public/uploads/event/500') . $event->image)) {
                unlink(public_path('public/uploads/event/500') . $event->image);
            }

            $file = $request->file('image');
            // Upload the new image
            $acak  = $file->getClientOriginalExtension();
            
            $fileName = rand(11111,99999).'-Event.'.$acak;
            //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
            
            foreach ($this->dimensions as $row) {
                //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY 
                $canvas = Image::canvas($row, $row);
                //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY 
                //DENGAN MEMPERTAHANKAN RATIO
                $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                    $constraint->aspectRatio();
                });
            
                //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
                $canvas->insert($resizeImage, 'center');
                //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
                $canvas->save($this->path . '/' . $row . '/' . $fileName);
            }

            $event->image = $fileName;
        }

        // Updating the product
        $event->update([
           'title' => $request->title,
            'content' => $request->content,
            'tempat' => $request->tempat,
            'tgl_mulai' => $request->tgl_mulai . ' ' . $request->jam_mulai,
            'tgl_selesai' => $request->tgl_selesai . ' ' . $request->jam_selesai,
            'created_by' => $request->created_by,
            'image' => $event->image
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Event '.$request->title.' telah di Update');

        // Redirect
        return redirect('admin/event');

    }

    public function show($id) {
        $event = Event::find($id);

        $previous = Event::where('id', '<', $event->id)->max('id');

        $next = Event::where('id', '>', $event->id)->min('id');

        return view('admin.event.details', compact('event'))->with('previous', $previous)->with('next', $next);
    }

    public function showUser($id) {
        $event = Event::find($id);
        return view('front.event.details', compact('event'));
    }

    public function destroy($id) {
        // Delete the product
        Event::destroy($id);

        // Store a message
        session()->flash('msg','Event has been deleted');

        // Redirect back
        return redirect('admin/event');


    }
}
