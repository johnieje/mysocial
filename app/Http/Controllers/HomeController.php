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
use Image;

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
        
        //check for avatar here
        $file = $request->file('image');
        $file_name = $user->name . '-' . $user->id . '-' .'.jpg';
        
        $user->avatar = $file_name;
        if($request->hasFile('image')){
           Storage::disk('local')->put($file_name, File::get($file));
           //return redirect()->route('account');
        }
        $user->update();
        return redirect()->route('account');
   }
    
   public function getUserImage($filename){
       $file = Storage::disk('local')->get($filename);
       return new Response($file, 200);
   }
   
   public function getImageDelete($filename){
       $user = Auth::user();
       $file = User::where('avatar', $filename)->first();
       if($file){
           $default_avatar = 'default.jpg';
           $user->avatar = $default_avatar;
           
           $user->update();
           Storage::delete($filename);
       }
       
       return redirect()->route('account');
   }
   
}
