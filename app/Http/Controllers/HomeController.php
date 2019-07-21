<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\Job;
use App\User_Info;
use App\User;
use App\Portfolio;
use App\Subscribe;
use App\Favorite;
use App\Follow;

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
        $jobList1 = Job::
            whereDoesntHave('subscribesToJob', function($query){$query->where('status', 2);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 3);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})
            ->inRandomOrder()->take(4)->get();
        $jobList2 = Job::
            whereDoesntHave('subscribesToJob', function($query){$query->where('status', 2);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 3);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})
            ->inRandomOrder()->take(4)->get();
        $jobList3 = Job::
            whereDoesntHave('subscribesToJob', function($query){$query->where('status', 2);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 3);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})
            ->inRandomOrder()->take(4)->get();
        $jobList4 = Job::
            whereDoesntHave('subscribesToJob', function($query){$query->where('status', 2);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 3);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})
            ->inRandomOrder()->take(4)->get();
        
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $subscribesOver2 = Subscribe::where('user_id',Auth::user()->id)->where('status',2)
                                    ->orwhere('user_id',Auth::user()->id)->where('status',3)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})->get();
        $my_follows = Follow::where('user_id',Auth::user()->id)->get();
        return view('user.user',compact('jobList1','jobList2','jobList3','jobList4','user_id','subscribes','my_jobs','user','my_follows','subscribesOver2'));
    }
    
    public function profile($user_id) {
        $userInfo = User_Info::where('user_id',$user_id)->first();
        $thisUser = User::where('id',$user_id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        $portfolios = Portfolio::where('user_id',$user_id)->get();
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})->get();
        $subscribesOver2 = Subscribe::where('user_id',Auth::user()->id)->where('status',2)
                                    ->orwhere('user_id',Auth::user()->id)->where('status',3)->get();
        $follow = Follow::where('follow_user_id', $thisUser->id)->first();
        return view('user.profile',compact('user','userInfo','user_id','portfolios','subscribes','my_jobs','thisUser','follow','subscribesOver2'));
    }
    
    public function editProfile(){
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})->get();
        $subscribesOver2 = Subscribe::where('user_id',Auth::user()->id)->where('status',2)
                                    ->orwhere('user_id',Auth::user()->id)->where('status',3)->get();
        return view('user.editProfile',compact('user','userInfo','user_id','subscribes','my_jobs','subscribesOver2'));
    }
    
    public function addProfile(ProfileRequest $request){
        if(isset($request->photo)){
            $this->validate($request, [
                'photo' => [
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
                
                if(isset($request->photo)){
                    $userInfo->photo = $url;
                }
                
                $userInfo->github = $request->github;
                $userInfo->url = $request->url;
                $userInfo->save();
                
                $user = User::where('id','=', Auth::user()->id)->first();
                $user->name = $request->name;
                $user->save();
                
                $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
                $user = User::where('id','=', Auth::user()->id)->first();
                $user_id = Auth::user()->id;
                $subscribesOver2 = Subscribe::where('user_id',Auth::user()->id)->where('status',2)
                                            ->orwhere('user_id',Auth::user()->id)->where('status',3)->get();
                return redirect('/profile/'.$user_id)->with( ['user' => $user,'userInfo' => $userInfo, 'user_id' => $user_id, 'subscribesOver2' => $subscribesOver2] );
                
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
                }
            } else {
                $userInfo = new User_Info;
                $userInfo->user_id = Auth::user()->id;
                $userInfo->profile = $request->profile;
                
                $userInfo->github = $request->github;
                $userInfo->url = $request->url;
                $userInfo->save();
                
                $user = User::where('id','=', Auth::user()->id)->first();
                $user->name = $request->name;
                $user->save();
                
                $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
                $user = User::where('id','=', Auth::user()->id)->first();
                $user_id = Auth::user()->id;
                $subscribesOver2 = Subscribe::where('user_id',Auth::user()->id)->where('status',2)
                                            ->orwhere('user_id',Auth::user()->id)->where('status',3)->get();
                return redirect('/profile/'.$user_id)->with( ['user' => $user,'userInfo' => $userInfo, 'user_id' => $user_id, 'subscribesOver2' => $subscribesOver2] );
            }
    }
    
    public function updateProfile(ProfileRequest $request){
        if(isset($request->photo)){
            $this->validate($request, [
                'photo' => [
                    // アップロードされたファイルであること
                    'file',
                    // 画像ファイルであること
                    'image',
                    // MIMEタイプを指定
                    'mimes:jpeg,png',
                    // 最小縦横20px 最大縦横500px
                    'dimensions:min_width=20,min_height=20,max_width=700,max_height=700',
                ]
            ]);
        if ($request->file('photo')->isValid([])) {
        $path = $request->photo->store('photo', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
        $url = Storage::disk('s3')->url($path);
        }
        
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $userInfo->user_id = Auth::user()->id;
        $userInfo->profile = $request->profile;
            
        if(isset($url)){
            $userInfo->photo = $url;
        }
        
        $userInfo->github = $request->github;
        $userInfo->url = $request->url;
        $userInfo->save();
        
        $user = User::where('id','=', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->save();
        
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        $user_id = Auth::user()->id;
        $subscribesOver2 = Subscribe::where('user_id',Auth::user()->id)->where('status',2)
                                    ->orwhere('user_id',Auth::user()->id)->where('status',3)->get();
        return redirect('/profile/'.$user_id)->with( ['user' => $user,'userInfo' => $userInfo, 'user_id' => $user_id, 'subscribesOver2' => $subscribesOver2] );
        
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
        }
    }
    
    public function serch(Request $request){
        $keyword = $request->input('keyword');
        $jobs = Job::where('title', 'like', '%'.$keyword.'%')
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 2);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 3);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})
            ->orWhere('content','like','%'.$keyword.'%')
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 2);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 3);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})
            ->get();
        
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})->get();
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        $subscribesOver2 = Subscribe::where('user_id',Auth::user()->id)->where('status',2)
                                    ->orwhere('user_id',Auth::user()->id)->where('status',3)->get();
        return view ('job.serch_resault',compact('jobs','keyword','user_id','user_id','subscribes','my_jobs','userInfo','user','subscribesOver2'));
    }
    
    public function follow(Request $request) {
        $follow = new follow;
        $follow->follow_user_id = $request->follow_user_id;
        $follow->user_id = $request->user_id;
        $follow->save();
        
        return redirect('/profile/'. $request->follow_user_id);
    }
    public function deleteFollow(Request $request) {
        $follow = Follow::find($request->follow_id);
        $follow->delete();
        return redirect('/profile/'. $request->follow_user_id);
    }
}
