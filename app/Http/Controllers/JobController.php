<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\JobRequest;
use Session;
use Storage;
use App\User;
use App\Job;
use App\User_Info;
use App\Subscribe;
use App\Message;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function job($job_id,$user_id){
        $job = Job::find($job_id);
        $user = User::find($user_id);
        $userInfo = User_Info::where('user_id',$user_id)->first();
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        $mySubscribe = Subscribe::where('job_id',$job_id)->where('user_id',$user_id)->first();
        
        // if(null !==Message::where('job_id',$job_id)->first()){
            $messages = Message::where('job_id',$job_id)->latest()->simplePaginate(5);
        // }

        return view('job.job',compact('job','user','userInfo','user_id','subscribes','my_jobs','mySubscribe','messages'));
    }
    
    public function jobRequest(){
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $user_id = Auth::user()->id;
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        $userInfo = User_Info::where('user_id',Auth::user()->id)->first();
        return view('job.job_request',compact('subscribes','user_id','my_jobs','userInfo'));
    }
    
    public function confirmRequest(JobRequest $request) {
        if(isset($request->job_photo)){
            $this->validate($request, [
                'job_photo' => [
                    // 必須
                    'required',
                    // アップロードされたファイルであること
                    'file',
                ]
            ]);
            if ($request->file('job_photo')->isValid([])) {
                $path = $request->job_photo->store('job_photo', 's3');
                Storage::disk('s3')->setVisibility($path, 'public');
                $url = Storage::disk('s3')->url($path);
                $request->session()->put('job_photo_url', $url);
            }else{
                return redirect()->back();  
            }
            
            $job = new Job($request->except(['job_photo']));
            $job->job_photo = $url;
            $request->session()->put('job', $job);
    
            $user_id = Auth::user()->id;
            $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
            $my_jobs = Job::where('user_id',Auth::user()->id)->get();
            return view('job.confirmRequest',compact('job','user_id','subscribes','my_jobs'));
        } else {
            $job = new Job($request->except(['job_photo']));
            $request->session()->put('job', $job);
    
            $user_id = Auth::user()->id;
            $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
            $my_jobs = Job::where('user_id',Auth::user()->id)->get();
            return view('job.confirmRequest',compact('job','user_id','subscribes','my_jobs'));
        }
    }
    
    public function completeRequest(JobRequest $request) {
        if(null != Session::get('job_photo_url')){
            $fileUrl = Session::get('job_photo_url');
            
            $job = $request->session()->get('job');
            $job->user_id = Auth::user()->id;
            $job->job_photo = $fileUrl;
            $job->save();
            $user_id = Auth::user()->id;
            $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
            $my_jobs = Job::where('user_id',Auth::user()->id)->get();
            return view('job.completeRequest',compact('user_id','subscribes','my_jobs'));
        } else {
            $job = $request->session()->get('job');
            $job->user_id = Auth::user()->id;
            $job->save();
            $user_id = Auth::user()->id;
            $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
            $my_jobs = Job::where('user_id',Auth::user()->id)->get();
            return view('job.completeRequest',compact('user_id','subscribes','my_jobs'));
        }
    }
    
    public function editRequest(JobRequest $request) {
        if(isset($request->job_photo)){
            $job = Job::where('id',$request->id)->first();
            $job->title = $request->title;
            $job->money = $request->money;
            $job->content = $request->content;
            $job->wish_at = $request->wish_at;
            $job->job_photo = $request->job_photo;
            $job->save();
        } else {
            $job = Job::where('id',$request->id)->first();
            $job->title = $request->title;
            $job->money = $request->money;
            $job->content = $request->content;
            $job->wish_at = $request->wish_at;
            $job->save();
        }
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
    
    
    // 応募者決定->納品まで
    public function applicants() {
        
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 2);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 3);})
            ->whereDoesntHave('subscribesToJob', function($query){$query->where('status', 4);})->get();
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();

        return view('job.applicants',compact('user_id','subscribes','my_jobs','userInfo','user','subsc'));
    }
    public function decideApplicant($applicant_id) {
        $subscribe = Subscribe::where('id',$applicant_id)->first();
        $subscribe->status = 2;
        $subscribe->save();
        
        $user_id = Auth::user()->id;
        $subscribes = Subscribe::where('user_id',Auth::user()->id)->get();
        $my_jobs = Job::where('user_id',Auth::user()->id)->get();
        $userInfo = User_Info::where('user_id','=', Auth::user()->id)->first();
        $user = User::where('id','=', Auth::user()->id)->first();
        return view('job.decideApplicant',compact('user_id','subscribes','my_jobs','userInfo','user','subsc'));
    }
    
    
}
