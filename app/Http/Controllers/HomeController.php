<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Job;
use App\User_Info;
use App\User;
use App\Portfolio;
use App\Subscribe;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user() {
        $jobList1 = Job::inRandomOrder()->take(4)->get();
        $jobList2 = Job::inRandomOrder()->take(4)->get();
        $jobList3 = Job::inRandomOrder()->take(4)->get();
        $jobList4 = Job::inRandomOrder()->take(4)->get();
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        return view('user.user',compact('jobList1','jobList2','jobList3','jobList4','user_id','subscribes','my_jobs'));
    }
    public function profile($user_id) {
        $userInfo = User_Info::where('user_id',$user_id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        $portfolios = Portfolio::where('user_id','=', Auth::user()->id)->get();
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        return view('user.profile',compact('user','userInfo','user_id','portfolios','subscribes','my_jobs'));
    }
    
    public function editProfile(){
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        return view('user.editProfile',compact('user','userInfo','user_id','subscribes','my_jobs'));
    }
    
    public function addProfile(Request $request){
        $this->validate($request, [
            'photo' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
                // 最小縦横20px 最大縦横500px
                'dimensions:min_width=20,min_height=20,max_width=500,max_height=500',
            ]
        ]);
        if ($request->file('photo')->isValid([])) {
        $path = $request->photo->store('photo', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
        $url = Storage::disk('s3')->url($path);
            
        $userInfo = new User_Info;
        $userInfo->user_id = Auth::user()->id;
        $userInfo->profile = $request->profile;
        $userInfo->photo = $url;
        $userInfo->github = $request->github;
        $userInfo->url = $request->url;
        $userInfo->save();
        
        $user = User::where('id','=', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->save();
        
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        return redirect('/profile/'.$user_id)->with( ['user' => $user,'userInfo' => $userInfo, 'user_id' => $user_id] );
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
        }
    }
    
    public function updateProfile(Request $request){
        $this->validate($request, [
            'photo' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
                // 最小縦横20px 最大縦横500px
                'dimensions:min_width=20,min_height=20,max_width=500,max_height=500',
            ]
        ]);
        if ($request->file('photo')->isValid([])) {
        $path = $request->photo->store('photo', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
        $url = Storage::disk('s3')->url($path);
        
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $userInfo->user_id = Auth::user()->id;
        $userInfo->profile = $request->profile;
        $userInfo->photo = $url;
        $userInfo->github = $request->github;
        $userInfo->url = $request->url;
        $userInfo->save();
        
        $user = User::where('id','=', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->save();
        
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        
        return redirect('/profile/'.$user_id)->with( ['user' => $user,'userInfo' => $userInfo, 'user_id' => $user_id] );
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
        }
    }
    
    public function serch(Request $request){
        $keyword = $request->input('keyword');
        $jobs = Job::where('title', 'like', '%'.$keyword.'%')->orWhere('content','like','%'.$keyword.'%')->get();
        
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        
        return view ('job.serch_resault',compact('jobs','keyword','user_id','user_id','subscribes','my_jobs','userInfo','user'));
    }
}
