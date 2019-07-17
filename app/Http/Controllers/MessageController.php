<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Message;
use App\Job;
use App\User;
use App\Subscribe;
use App\User_Info;

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
}
