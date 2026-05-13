<?php

namespace App\Http\Controllers;

use App\Koleksi;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use File;
use PDF;

class KoleksiController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        $this->path = public_path('uploads/image');
        $this->dimensions = ['245', '300', '500'];
    }

    public function index() {
        
        $koleksi = Koleksi::all();

        return view('admin.koleksi.index', compact('koleksi'));
    }

    public function create() {
        $koleksi = new Koleksi();
        return view('admin.koleksi.create', compact('koleksi'));
    }

    public function print()
    {
        $koleksi = Koleksi::all();
 
        $pdf = PDF::loadview('admin.koleksi.print',['koleksi'=>$koleksi]);
        return $pdf->stream();
    }

    public function store(Request $request) {

        // Validate the form
        $request->validate([
           'name' => 'required',
            'description' => 'required',
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
            $fileName = rand(11111,99999).'-'.str_replace(' ', '', $request->name).'.'.$acak;
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

        Koleksi::create([
            'name' => $request->name,
            'description' => $request->description,
            'sejarah' => $request->sejarah,
            'lantai' => $request->lantai,
            'slide' => 0,
            'image' => $fileName

        ]);

        // Sessions Message
        $request->session()->flash('msg','Koleksi baru telah di tambahkan');

        // Redirect

        return redirect('admin/koleksi');

    }

    public function edit($id) {
        $koleksi = Koleksi::find($id);
        return view('admin.koleksi.edit', compact('koleksi'));
    }

    public function update(Request $request, $id) {

        // Find the product
        $koleksi = Koleksi::find($id);
        $slide = 1;

        if($request->slide == true){
            $slide = 1;
        }
        else{
            $slide = 0;
        }

        // Validate The form
        $request->validate([
           'name' => 'required',
            'description' => 'required',
        ]);

        // Check if there is any image
        if ($request->hasFile('image')) {
            // Check if the old image exists inside folder
            if (file_exists(public_path('public/uploads/image/500') . $koleksi->image)) {
                unlink(public_path('public/uploads/image/500') . $koleksi->image);
            }

            // Upload the new image
            $image = $request->image;
            $image->move('uploads/image/500', $image->getClientOriginalName());

            $koleksi->image = $request->image->getClientOriginalName();
        }

        // Updating the product
        $koleksi->update([
           'name' => $request->name,
            'description' => $request->description,
            'sejarah' => $request->sejarah,
            'lantai' => $request->lantai,
            'slide' => $slide,
            'image' => $koleksi->image
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Koleksi telah di update');

        // Redirect
        return redirect('admin/koleksi');

    }

    public function show($id) {
        $koleksi = Koleksi::find($id);

        // get previous user id
        $previous = Koleksi::where('id', '<', $koleksi->id)->max('id');

        // get next user id
        $next = Koleksi::where('id', '>', $koleksi->id)->min('id');

        return view('admin.koleksi.details', compact('koleksi'))->with('previous', $previous)->with('next', $next);
    }

    public function showUser($id) {
        $koleksi = Koleksi::find($id);
        return view('front.koleksi.details', compact('koleksi'));
    }

    public function destroy($id) {
        // Delete the product
        Koleksi::destroy($id);

        // Store a message
        session()->flash('msg','Koleksi has been deleted');

        // Redirect back
        return redirect('admin/koleksi');


    }
}
