<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Storage;
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
    
    public function message(MessageRequest $request){
        $message = new Message;
        $message->from_user_id = Auth::user()->id;
        $message->job_id = $request->job_id;
        $message->body = $request->body;
        $message->save();
        
        $user_id = Auth::user()->id;
        return redirect('/job'.'/'.$request->job_id.'/'.$user_id);
        
    }
    
    public function delivery(MessageRequest $request){
        if(isset($request->file)){
                $this->validate($request, [
                    'file' => [
                        // アップロードされたファイルであること
                        'file',
                    ]
                ]);
                if ($request->file('file')->isValid([])) {
                $path = $request->file->store('file', 's3');
                Storage::disk('s3')->setVisibility($path, 'public');
                $url = Storage::disk('s3')->url($path);
                
                $message = new Message;
                $message->from_user_id = Auth::user()->id;
                $message->body = $request->body;
                $message->job_id = $request->job_id;
                $message->file = $url;
                $message->save();
        
                $subscribe = Subscribe::where('id',$request->mySubscribe_id)->first();
                $subscribe->status = 3;
                $subscribe->save();
                
                $user_id = Auth::user()->id;
                return redirect('/job'.'/'.$request->job_id.'/'.$user_id);
            }
        } else {
                $message = new Message;
                $message->from_user_id = Auth::user()->id;
                $message->body = $request->body;
                $message->job_id = $request->job_id;
                $message->save();
        
                $subscribe = Subscribe::where('id',$request->mySubscribe_id)->first();
                $subscribe->status = 3;
                $subscribe->save();
                
                $user_id = Auth::user()->id;
                return redirect('/job'.'/'.$request->job_id.'/'.$user_id);
        }
    }
    
    public function jobComplete(MessageRequest $request) {
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
        return redirect('/job'.'/'.$request->job_id.'/'.$user_id);
    }
}
