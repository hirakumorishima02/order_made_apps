@extends('layouts.layout')

@section('title','依頼投稿フォーム')

@section('body')
@if(isset($userInfo))
<hr class="uk-divider-icon">
<!--応募フォーム-->
<div style="width:700px;margin: 0 auto;">
<form action="/confirmRequest" enctype="multipart/form-data" class="uk-form" method="post">
    <fieldset class="uk-fieldset">
        {{ csrf_field() }}
        <legend class="uk-legend">依頼投稿フォーム</legend>
        <!--依頼タイトル-->
        <div class="uk-margin">
            <input class="uk-input" type="text" name="title" placeholder="依頼タイトル">
        </div>
        <!--報酬-->
        <div class="uk-margin">
            <input class="uk-input" type="text" name="money" placeholder="希望契約金額">
        </div>
        <!--依頼の詳細-->
        <div class="uk-margin">
            <textarea class="uk-textarea" rows="5" name="content" placeholder="依頼の詳細"></textarea>
        </div>
        <div class="uk-margin">
            <input type="text" data-uk-datepicker="{format:'YYYY.MM.DD'}" placeholder="希望納期" name="wish_at">
        </div>
        <!--参考画像-->
        <div class="uk-margin">
            <p style="margin-bottom:0px;">参考画像</p>
            <input type="file" name="job_photo">
        </div>
    <p style="text-align:center;margin-top:10px;" uk-margin>
        <button class="uk-button uk-button-primary uk-button-large">投稿</button>
    </p>
    </fieldset>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
</div>

@else
<p><a href="/editProfile">依頼投稿前にプロフィールを登録してください。</a></p>
@endif
<hr class="uk-divider-icon">

@endsection