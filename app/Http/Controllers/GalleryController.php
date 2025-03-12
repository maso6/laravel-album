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

class GalleryController extends Controller
{
    function __construct(){}

    public function index()
    {
        return view("public.index", []);
    }

    public function index_public(Request $request, $token)
    {
        $gallery_ids = [];
        $token = Token::where('token', $token)->firstOrFail();
        $galleryIds = TokenGalleries::where('token_id', $token->id)->pluck('gallery_id')->toArray();

        if ($request->search_field){
            $galleries = Gallery::whereIn('id', $galleryIds)->where("title","like","%" . $request->search_field . "%")->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $galleries = Gallery::whereIn('id', $galleryIds)->orderBy('created_at', 'desc')->paginate(20);
        }

        return view("public.galleries", [
            "token" => $token,
            "galleries" => $galleries
        ]);
    }
    
    public function gallery_public(Request $request, $token, $gallery_id)
    {
        $token = Token::where('token', $token)->firstOrFail();
        $tokenGallery = TokenGalleries::where('token_id', $token->id)->where('gallery_id', $gallery_id)->firstOrFail();

        $gallery = Gallery::findOrFail($gallery_id);

        if ($request->search_field){
            $images = Image::where('gallery_id', $gallery->id)->where("name","like","%" . $request->search_field . "%")->orderBy('created_at', 'desc')->paginate(50);
        } else {
            $images = Image::where('gallery_id', $gallery->id)->orderBy('created_at', 'desc')->paginate(50);
        }

        return view("public.gallery", [
            "token" => $token,
            "images" => $images,
            "gallery" => $gallery
        ]);
    }

    public function index_admin(Request $request)
    {
        if (!Auth::check()) return view("auth.login");

        if ($request->search_field){
            $galleries = Gallery::where("title","like","%" . $request->search_field . "%")->paginate(20);
        } else {
            $galleries = Gallery::paginate(20);
        }
        
        return view("admin.galleries.index", [
            "paginator" => $galleries,
            "search_field" => $request->search_field,
        ]);
    }

    public function edit($id)
    {
        if (!Auth::check()) return view("auth.login");

        $gallery = Gallery::findOrFail($id);
        $images = Image::where("gallery_id", "=", $gallery->id)->paginate(20);

        $tokens = Token::get();
        
        $galleryIds = TokenGalleries::where('gallery_id', $gallery->id)->pluck('gallery_id')->toArray();

        foreach($tokens as $token) {
            $token->active = false;
            if(TokenGalleries::where('gallery_id', $gallery->id)->where('token_id', $token->id)->count() > 0) {
                $token->active = true;
            }
        }

        return view("admin.galleries.edit", [
            "gallery" => $gallery,
            "paginator" => $images,
            "tokens" => $tokens
        ]);
    }

    public function update(Request $request)
    {

        if (!Auth::check()) return view("auth.login");

        $this->validate($request, [
            'id' => 'required', 
            'title' => 'required', 
            'description' => 'required',
        ]);

        $gallery = Gallery::findOrFail($request['id']);
        $gallery->title = $request['title'];
        $gallery->description = $request['description'];

        if($request['newimage']) {
            $gallery->image = base64_encode(file_get_contents($request['newimage']->path()));
        }

        $gallery->save();

        return redirect("/admin/galleries/". $request['id'])->withSuccess('Gemt');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) return view("auth.login");

        $this->validate($request, [
            'title' => 'required', 
            'description' => 'required',
            'image' => 'required',
        ]);

        $gallery = new Gallery();
        $gallery->title = $request['title'];
        $gallery->description = $request['description'];
        $gallery->image = base64_encode(file_get_contents($request['image']->path()));
        $gallery->created_at = Carbon::Now();
        $gallery->save();

        return redirect("/admin/galleries/". $gallery->id)->withSuccess('Oprettet');
    }

    public function create()
    {
        if (!Auth::check()) return view("auth.login");
        
        return view("admin.galleries.create", []);
    }

    public function delete($id)
    {
        if (!Auth::check()) return view("auth.login");

        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect("/admin")->withSuccess('Slettet');
    }
}
