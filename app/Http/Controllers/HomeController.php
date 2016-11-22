<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function getAccount(){
        return view('account', ['user' => Auth::user()]);
    }
  
    public function postUpdateAccount(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        
        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();
        
        $file = $request->file('image');
        $filename = $user->name . '-' . $user->id . '-' .'.jpg';
        if($request->hasFile('image')){
           Storage::disk('local')->put($filename, File::get($file));
           return redirect()->route('account');
        } 
   }
    
   public function getUserImage($filename){
       $file = Storage::disk('local')->get($filename);
       return new Response($file, 200);
   }
   
}
