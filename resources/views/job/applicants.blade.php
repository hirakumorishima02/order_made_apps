@extends('layouts.layout')

@section('title','確認画面')

@section('body')
<hr class="uk-divider-icon">
    <!--依頼情報-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>投稿した依頼への応募者</p>
    </div>
    <div>
        @foreach($my_jobs as $my_job)
        <h4><a>{{$my_job->title}}</a></h4>
            <?php $applicants = App\Subscribe::where('job_id', $my_job->id)->get(); ?>
            <ul>
            @foreach($applicants as $applicant)
            <li><a href="/profile/{{$applicant->user->id}}">{{$applicant->user->name}}</a><button><a href="/decideApplicant/{{$applicant->id}}" onclick='return confirm("依頼者を決定しますか？");'>依頼者決定</a></button></li>
            <li style="list-style: none;">{{$applicant->message}}</li>
            @endforeach
            </ul>
        @endforeach
    </div>
@endsection