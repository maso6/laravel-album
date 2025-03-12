<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Token;
use App\Models\TokenGalleries;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    function __construct(){}

    public function index_admin(Request $request)
    {
        if ($request->search_field){
            $tokens = Token::where("name","like","%" . $request->search_field . "%")->paginate(20);
        } else {
            $tokens = Token::paginate(20);
        }
        
        return view("admin.tokens.index", [
            "paginator" => $tokens,
            "search_field" => $request->search_field,
        ]);
    }

    public function edit($id)
    {
        $token = Token::findOrFail($id);

        return view("admin.tokens.edit", [
            "token" => $token
        ]);
    }

    public function updategallery(Request $request) 
    {
        if (Auth::check()) {

            $this->validate($request, [
                'gallery_id' => 'required', 
            ]);
 
            TokenGalleries::where('gallery_id', $request['gallery_id'])->delete();

            if($request->tokens) {
                foreach($request->tokens as $token) {
                    $tokenGallery = new TokenGalleries();
                    $tokenGallery->gallery_id = $request->gallery_id;
                    $tokenGallery->token_id = $token;
                    $tokenGallery->save();
                }
            }
            return redirect("/admin/galleries/". $request->gallery_id)->withSuccess('Oprettet');

        }
        return view("auth.login");    
    }

    public function update(Request $request)
    {
        if (Auth::check()) {

            $this->validate($request, [
                'id' => 'required', 
                'name' => 'required', 
                'description' => 'required',
                'token' => 'required',
            ]);

            $token = Token::findOrFail($request['id']);
            $token->name = $request['name'];
            $token->description = $request['description'];
            $token->token = $request['token'];


            $token->save();

            return redirect("/admin/tokens/". $request['id'])->withSuccess('Gemt');
        }
        return view("auth.login");    
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            
            $this->validate($request, [
                'name' => 'required', 
                'description' => 'required',
                'token' => 'required',

            ]);

            $token = new Token();
            $token->name = $request['name'];
            $token->description = $request['description'];
            $token->token = $request['token'];
            $token->created_at = Carbon::Now();
            $token->save();

            return redirect("/admin/tokens/". $token->id)->withSuccess('Oprettet');
        }
        return view("auth.login");    
    }

    public function create()
    {
        return view("admin.tokens.create", [
            'uuid' => Str::uuid()
        ]);
    }

    public function delete($id)
    {
        $token = Token::findOrFail($id);
        $token->delete();
        return redirect("/admin/tokens")->withSuccess('Slettet');
    }
}
