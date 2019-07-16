@extends('layouts.layout')

@section('title','案件の詳細')

@section('body')

<hr class="uk-divider-icon">
<div class="container">
    <!--案件タイトル-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1" style="padding-top:10px;padding-bottom:10px;" uk-sticky>
        <p>案件</p>
        <h3 class="uk-card-title" style="margin-top:10px;">{{$job->title}}</h3>
    </div>
    <!--クライアント情報-->
    <a href="/profile/{{$userInfo->user_id}}">
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
            @if(isset($userInfo->photo))
            <img src="{{$userInfo->photo}}" alt="" uk-cover width="200" height="200">
            @else
            <img src="/images/avatar.jpg" alt="" uk-cover width="200" height="200">
            @endif
        </div>
        <div>
            <div class="uk-card-body">
                <p>クライアント情報</p>
                <h3 class="uk-card-title" style="margin-top:20px;">{{$user->name}}</h3>
                @if(isset($userInfo->profile))
                <p>{{$userInfo->profile}}</p>
                @else
                <p></p>
                @endif
            </div>
        </div>
    </div>
    </a>
    <!--依頼情報-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>依頼条件</p>
        </div>
        <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
                <tr>
                    <td class="uk-width-small">報酬</td>
                    <td>{{number_format($job->money)}}円</td>
                </tr>
                <tr>
                    <td class="uk-width-small">納品希望日</td>
                    <td>{{$job->wish_at}}</td>
                </tr>
                <tr>
                    <td class="uk-width-small">掲載日</td>
                    <td>{{$job->created_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--依頼の詳細-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>依頼の詳細</p>
        </div>
            <div class="uk-child-width-1@m uk-child-width-1" uk-grid>
                <div>
                    <p class="uk-text-top">{{$job->content}}</p>
                </div>
            </div>
    </div>
    <!--イメージ画像-->
    <div style="margin:0 auto;width:600px;">
        @if(isset($job->job_photo))
        <img data-src="{{$job->job_photo}}" width="900" height="600" alt="" uk-img>
        @endif
    </div>
<hr class="uk-divider-icon">
<!--応募フォーム-->
<div style="width:700px;margin: 0 auto;">
@if($job->user_id != $user_id)
<form action="/confirmSubscribe/{{$job->id}}" method="post">
    {{ csrf_field() }}
    <fieldset class="uk-fieldset">
        <legend class="uk-legend">応募フォーム</legend>
        <div class="uk-margin">
            <textarea class="uk-textarea" rows="5" name="message" placeholder="応募メッセージ"></textarea>
            <input type="hidden" name="status" value="1"></textarea>
            <input type="hidden" name="user_id" value="{{$user_id}}">
            <input type="hidden" name="job_id" value="{{$job->id}}">
        </div>
    <p style="text-align:center;margin-top:10px;" uk-margin>
        <button class="uk-button uk-button-primary uk-button-large">応募</button>
    </p>
    </fieldset>
</form>
@else
<form action="/editRequest/{{$job->id}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <fieldset class="uk-fieldset">
        <legend class="uk-legend">依頼編集</legend>
        <!--依頼タイトル-->
        <div class="uk-margin">
            <input class="uk-input" type="text" name="title" placeholder="依頼タイトル" value="{{$job->title}}">
        </div>
        <!--報酬-->
        <div class="uk-margin">
            <input class="uk-input" type="text" name="money" placeholder="希望契約金額" value="{{$job->money}}">
        </div>
        <!--依頼の詳細-->
        <div class="uk-margin">
            <textarea class="uk-textarea" rows="5" name="content" placeholder="依頼の詳細">{{$job->content}}</textarea>
        </div>
        <div class="uk-margin">
            <input type="text" data-uk-datepicker="{format:'YYYY.MM.DD'}" placeholder="希望納期" name="wish_at"  value="{{$job->wish_at}}">
        </div>
        <!--参考画像-->
        <div class="uk-margin">
            <p style="margin-bottom:0px;">参考画像</p>
            <input type="file" name="job_photo">
        </div>
    <p style="text-align:center;margin-top:10px;" uk-margin>
        <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">編集</button>
    </p>
    <input type="hidden" name="id" value="{{$job->id}}">
    </fieldset>
</form>
<form action="/deleteRequest/{{$job->id}}" method="post"  onclick='return confirm("本当に削除しますか？");'>
    {{ csrf_field() }}
    <p style="text-align:center;margin-top:10px;" uk-margin>
        <button class="uk-button uk-button-danger uk-button-large" style="border-radius:5px;">削除</button>
    </p>
    <input type="hidden" name="id" value="{{$job->id}}">
    </fieldset>
</form>
@endif
</div>
</div>
<hr class="uk-divider-icon">

@endsection