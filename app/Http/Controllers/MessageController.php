<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Message;
use App\Job;
use App\User;
use App\Subscribe;
use App\User_Info;
use App\Portfolio;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function message(Request $request){
        $message = new Message;
        $message->from_user_id = Auth::user()->id;
        $message->body = $request->body;
        $message->job_id = $request->job_id;
        $message->save();
        
        $user_id = Auth::user()->id;
        $job = Job::find($user_id);
        $user = User::find($user_id);
        $userInfo = User_Info::where('user_id',$user_id)->first();
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        $mySubscribe = Subscribe::where('job_id',$request->job_id)->where('user_id',$user_id)->first();
        return redirect('/job'.'/'.$request->job_id.'/'.$user_id);
        
    }
    
    public function delivery(Request $request){
        $message = new Message;
        $message->from_user_id = Auth::user()->id;
        $message->body = $request->body;
        $message->job_id = $request->job_id;
        $message->save();
        
        $subscribe = Subscribe::where('id',$request->mySubscribe_id)->first();
        $subscribe->status = 3;
        $subscribe->save();
        
        
        $user_id = Auth::user()->id;
        $job = Job::find($user_id);
        $user = User::find($user_id);
        $userInfo = User_Info::where('user_id',$user_id)->first();
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        $mySubscribe = Subscribe::where('job_id',$request->job_id)->where('user_id',$user_id)->first();
        return redirect('/job'.'/'.$request->job_id.'/'.$user_id);
    }
    
    public function jobComplete(Request $request) {
        $message = new Message;
        $message->from_user_id = Auth::user()->id;
        $message->body = $request->body;
        $message->job_id = $request->job_id;
        $message->save();
        
        $subscribe = Subscribe::where('id',$request->subscribe_id)->first();
        $subscribe->status = 4;
        $subscribe->save();
        
        $portfolio = new Portfolio;
        $portfolio->user_id = $request->subscribe_user_id;
        $portfolio->title = $request->title;
        $portfolio->save();
        
        $user_id = Auth::user()->id;
        $job = Job::find($user_id);
        $user = User::find($user_id);
        $userInfo = User_Info::where('user_id',$user_id)->first();
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        $mySubscribe = Subscribe::where('job_id',$request->job_id)->where('user_id',$user_id)->first();
        return redirect('/job'.'/'.$request->job_id.'/'.$user_id);
    }
}
