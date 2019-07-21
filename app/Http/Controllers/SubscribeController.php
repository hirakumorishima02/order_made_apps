<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subscribe;
use App\Job;

class SubscribeController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function confirmSubscribe(Request $request) {
        $subscribe = new Subscribe($request->all());
        $request->session()->put('subscribe', $subscribe);
        $user_id = Auth::user()->id;
        $job_id = $request->job_id;
        $my_jobs = Job::where('user_id',Auth::user()->id)->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})->get();
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        return view('subscribe.confirmSubscribe',compact('subscribe','user_id','job_id','subscribes','my_jobs'));
    }
    
    public function completeSubscribe(Request $request) {
        $subscribe = $request->session()->get('subscribe');
        $subscribe->user_id = Auth::user()->id;
        $subscribe->job_id = $request->job_id;
        $subscribe->save();
        $user_id = Auth::user()->id;
        $my_jobs = Job::where('user_id',Auth::user()->id)->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})->get();
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        return view('subscribe.completeSubscribe',compact('user_id','subscribes','my_jobs'));
    }
    
    public function backSubscribe(Request $request) {
        $job_id = $request->job_id;
        $user_id = $request->user_id;
        $data = $request->session()->reflash();
        return redirect()->back()->with(['job_id'=>$job_id,'user_id'=>$user_id,'data'=>$data]);
    }
    
}
