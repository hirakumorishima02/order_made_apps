@extends('layouts.layout')

@section('title','ユーザートップページ')

@section('body')

<div class="container">
<section class="new-item uk-background-muted" style="padding-bottom:100px;">
    <div class="uk-card uk-card-default uk-card-body" style="z-index: 980;text-align:center;" uk-sticky="bottom: #offset"><h3>新着ご依頼</h3></div>
    <div class="uk-child-width-expand@s uk-text-center uk-animation-slide-bottom" uk-grid="parallax: 150">
    @foreach($jobList1 as $job)
    <div>
        <div class="uk-card uk-card-default job-card">
            <div class="uk-card-media-top uk-height-small"><img src="{{$job->user()->first()->userInfosToUser()->first()->photo}}"></div>
            <a href="/job/{{$job->id}}/{{$job->user_id}}">
                <div class="uk-card uk-card-default uk-card-body uk-grid-margin">
                    <h3 class="uk-card-title" style="overflow:scroll;height:100px;">{{ $job->title }}</h3>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    </div>
    <div class="uk-child-width-expand@s uk-text-center uk-animation-slide-bottom" uk-grid="parallax: 150">
    @foreach($jobList2 as $job)
    <div>
        <div class="uk-card uk-card-default job-card">
            <div class="uk-card-media-top uk-height-small"><img src="{{$job->user()->first()->userInfosToUser()->first()->photo}}"></div>
            <a href="/job/{{$job->id}}/{{$job->user_id}}">
                <div class="uk-card uk-card-default uk-card-body uk-grid-margin">
                    <h3 class="uk-card-title" style="overflow:scroll;height:100px;">{{ $job->title }}</h3>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    </div>
    <div class="uk-child-width-expand@s uk-text-center uk-animation-slide-bottom" uk-grid="parallax: 150">
    @foreach($jobList3 as $job)
    <div>
        <div class="uk-card uk-card-default job-card">
            <div class="uk-card-media-top uk-height-small"><img src="{{$job->user()->first()->userInfosToUser()->first()->photo}}"></div>
            <a href="/job/{{$job->id}}/{{$job->user_id}}">
                <div class="uk-card uk-card-default uk-card-body uk-grid-margin">
                    <h3 class="uk-card-title" style="overflow:scroll;height:100px;">{{ $job->title }}</h3>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    </div>
    <div class="uk-child-width-expand@s uk-text-center uk-animation-slide-bottom" uk-grid="parallax: 150">
    @foreach($jobList4 as $job)
    <div>
        <div class="uk-card uk-card-default job-card">
            <div class="uk-card-media-top uk-height-small"><img src="{{$job->user()->first()->userInfosToUser()->first()->photo}}"></div>
            <a href="/job/{{$job->id}}/{{$job->user_id}}">
                <div class="uk-card uk-card-default uk-card-body uk-grid-margin">
                    <h3 class="uk-card-title" style="overflow:scroll;height:100px;">{{ $job->title }}</h3>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    </div>
    </div>
</div>
</section>

<hr class="uk-divider-icon">
    <section class="follow-item">
    <div class="uk-card uk-card-default uk-card-body" style="z-index: 980;text-align:center;" uk-sticky="bottom: #offset"><h3>フォロークライアントのご依頼</h3></div>
    <!--もしログインユーザーが1人でも誰かをフォローしていたら-->
    @if(null !== $my_follows->first())
        @foreach($my_follows as $follow)
        <a href="/job/{{ $follow->follow_user->jobsToUser()->first()->id }}/{{ $follow->follow_user->jobsToUser()->first()->user_id }}">
            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                <div class="uk-card-media-left uk-cover-container">
                    <img src="/images/light.jpg" alt="" uk-cover>
                    <canvas width="300" height="200"></canvas>
                </div>
                <div id="follow_item">
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">{{ $follow->follow_user->jobsToUser()->first()->title }}</h3>
                        <p>{{ $follow->follow_user->jobsToUser()->first()->content }}</p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    @endif
    </section>
</div>
@endsection