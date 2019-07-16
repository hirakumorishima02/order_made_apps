<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Job;
use App\User_Info;
use App\Subscribe;

class JobController extends Controller
{
    public function job($job_id,$user_id){
        $job = Job::find($job_id);
        $user = User::find($user_id);
        $userInfo = User_Info::where('user_id',$user_id)->first();
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        return view('job.job',compact('job','user','userInfo','user_id','subscribes','my_jobs'));
    }
    
    public function jobRequest(){
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $user_id = Auth::user()->id;
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        return view('job.job_request',compact('subscribes','user_id','my_jobs'));
    }
    
    public function confirmRequest(Request $request) {
        $job = new Job($request->except(['job_photo']));
        $request->session()->put('job', $job);
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        return view('job.confirmRequest',compact('job','user_id','subscribes','my_jobs'));
    }
    
    public function completeRequest(Request $request) {
        $job = $request->session()->get('job');
        $job->user_id = Auth::user()->id;
        $job->save();
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        return view('job.completeRequest',compact('user_id','subscribes','my_jobs'));
    }
    
    public function editRequest(Request $request) {
        $job = Job::where('id',$request->id)->first();
        $job->title = $request->title;
        $job->money = $request->money;
        $job->content = $request->content;
        $job->wish_at = $request->wish_at;
        $job->job_photo = $request->job_photo;
        $job->save();
        
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        return view('job.completeRequest',compact('user_id','subscribes','my_jobs'));
    }
    
    public function deleteRequest(Request $request) {
        Job::destroy($request->id);

        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        
        return redirect('/')->with( ['user' => $user,'userInfo' => $userInfo, 'user_id' => $user_id, 'subscribes' => $subscribes, 'my_jobs' => $my_jobs] );
    }
}
