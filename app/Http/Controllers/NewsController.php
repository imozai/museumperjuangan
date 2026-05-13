<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use PDF;

class NewsController extends Controller
{
    public $path;
    public $dimensions;

    public function __construct()
    {
        $this->path = public_path('uploads/news');
        $this->dimensions = ['245', '300', '500'];
    }

    public function index() {

        $news = News::all();

        return view('admin.news.index', compact('news'));
    }

    public function create() {
        $news = new News();
        return view('admin.news.create', compact('news'));
    }

    public function print()
    {
        $news = News::all();
 
        $pdf = PDF::loadview('admin.news.print',['news'=>$news]);
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

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'created_by' => $request->created_by,
            'image' => $fileName

        ]);

        // Sessions Message
        $request->session()->flash('msg','Berita '.$request->title.' telah di Tambahkan');

        // Redirect

        return redirect('admin/news');

    }

    public function edit($id) {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id) {

        // Find the product
        $news = News::find($id);

        // Validate The form
        $request->validate([
           'title' => 'required',
            'content' => 'required',
            'created_by' => 'required',
        ]);

        // Check if there is any image
        if ($request->hasFile('image')) {
            // Check if the old image exists inside folder
            if (file_exists(public_path('public/uploads/news/500') . $news->image)) {
                unlink(public_path('public/uploads/news/500') . $news->image);
            }

            $file = $request->file('image');
            // Upload the new image
            $acak  = $file->getClientOriginalExtension();
            
            $fileName = rand(11111,99999).'-Berita.'.$acak;
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

            $news->image = $fileName;
        }

        // Updating the product
        $news->update([
           'title' => $request->title,
            'content' => $request->content,
            'created_by' => $request->created_by,
            'image' => $news->image
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Berita '.$request->title.' telah di Update');

        // Redirect
        return redirect('admin/news');

    }

    public function show($id) {
        $news = News::find($id);

        $previous = News::where('id', '<', $news->id)->max('id');

        $next = News::where('id', '>', $news->id)->min('id');

        return view('admin.news.details', compact('news'))->with('previous', $previous)->with('next', $next);
    }

    public function showUser($id) {
        $news = News::find($id);
        return view('front.news.details', compact('news'));
    }

    public function destroy($id) {
        // Delete the product
        News::destroy($id);

        // Store a message
        session()->flash('msg','News has been deleted');

        // Redirect back
        return redirect('admin/news');


    }
}
