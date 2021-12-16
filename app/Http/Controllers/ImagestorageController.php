<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Image;

class ImagestorageController extends Controller
{
    public function create() {
        $images =Image::all();
        return view('create', ['images' => $images]);
    }

    public function store(Request $request){
        $extension = $request->file('imgupload')->extention();
        $imgname = date('dmyHis').'.'.$extension;
        $this->validate($request, ['imgupload' => 'file|max:5000']);
        $path = Storage::putFileAs('public/images', $request->file('imgupload'), $imgname);
        Image::create(['path' => $imgname]);
        return redirect()->back()->withSuccess("Image upload success in ".$path);
    }
}
