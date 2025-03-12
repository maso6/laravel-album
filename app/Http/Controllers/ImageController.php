<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Token;
use App\Models\TokenGalleries;
use App\Models\Gallery;
use App\Models\Image;

class ImageController extends Controller
{
    function __construct(){}

    public function edit($id)
    {
        if (!Auth::check()) return view("auth.login");

        $image = Image::findOrFail($id);

        return view("admin.images.edit", [
            "image" => $image,
        ]);
    }

    public function update(Request $request)
    {
        if (!Auth::check()) return view("auth.login");

        $this->validate($request, [
            'id' => 'required', 
            'description' => 'required',
        ]);

        $image = Image::findOrFail($request['id']);
        $image->description = $request['description'];

        if($request['newimage']) {
            $image->image = base64_encode(file_get_contents($request['newimage']->path()));
        }
        $image->save();

        return redirect("/admin/galleries/". $image->gallery_id)->withSuccess('Gemt');
    }

    public function store(Request $request)
    {

        if (!Auth::check()) return view("auth.login");

        $this->validate($request, [
            'description' => 'required',
            'image' => 'required',
        ]);

        $image = new Image();
        $image->gallery_id = $request['gallery_id'];
        $image->description = $request['description'];
        $image->image = base64_encode(file_get_contents($request['image']->path()));
        $image->created_at = Carbon::Now();
        $image->save();

        return redirect("/admin/galleries/". $image->gallery_id)->withSuccess('Oprettet');  
    }

    public function create($gallery_id)
    {
        if (!Auth::check()) return view("auth.login");
        return view("admin.images.create", ['gallery_id' => $gallery_id]);
    }

    public function delete($id)
    {
        if (!Auth::check()) return view("auth.login");
        $galleryId = null;
        $image = Image::findOrFail($id);
        $galleryId = $image->gallery_id;
        $image->delete();
        return redirect("/admin/galleries/" . $galleryId)->withSuccess('Slettet');
    }
}
