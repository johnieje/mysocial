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
        
        //check for avatar here
        
        $user->update();
        return redirect()->route('account');
   }
    
   public function getUserImage($filename){
       $file = Storage::disk('local')->get($filename);
       return new Response($file, 200);
   }
   
   public function getImageDelete($filename){
       Storage::delete($filename);
       return redirect()->route('account');
   }
   
}
