<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
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
    
    public function getDeleteAccount($id){
        $user = Auth::user();
        
        $posts = Post::where('user_id', $id)->delete(); // delete all posts of user
        
        if($posts){
           if($user->delete()){ //delete user
               return redirect()->route('home');
           }
        }
        return false;
    }
   
    public function query(Request $request)
    {
        $query = $request->term;
        $results = User::where('name', 'LIKE', '%'.$query.'%')->get();

        //This will only send the e-mail and avatar to avoid that users can view all the rows from selected user table
        foreach($results as $user ){
            $usersArray[] = [
                'name' => $user->name,
                'avatar' => $user->avatar
                //'avatar_path' => URL::asset($user->avatar_path)
            ];
        }
        return response()->json($usersArray);
    }
    
    public function getSearchUser(Request $request){
        $name = $request->user;
        $results = User::where('name', 'LIKE', '%'.$name.'%')->get();
        if($results)
        {
           return view('search_results')->with('results', $results);
            //return var_dump($results);
        }else{
            $message_fail = "No results! Try again.";
            return redirect()->route('search_results')->with(['message-fail' => $message_fail]);
        }
        
    }
}
