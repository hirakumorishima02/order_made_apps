@extends('layouts.layout')

@section('title','依頼投稿フォーム')

@section('body')

<hr class="uk-divider-icon">
<!--応募フォーム-->
<div style="width:700px;margin: 0 auto;">
<form action="confirmSubscribe.html">
    <fieldset class="uk-fieldset">
        <legend class="uk-legend">依頼投稿フォーム</legend>
        <!--依頼タイトル-->
        <div class="uk-margin">
            <input class="uk-input" type="text"　name="contactMoney" placeholder="依頼タイトル">
        </div>
        <!--報酬-->
        <div class="uk-margin">
            <input class="uk-input" type="text"　name="contactMoney" placeholder="希望契約金額">
        </div>
        <!--依頼の詳細-->
        <div class="uk-margin">
            <textarea class="uk-textarea" rows="5" name="subscribeMessage" placeholder="依頼の詳細"></textarea>
        </div>
        
        <!--参考画像-->
        <div uk-form-custom="target: true">
            <input type="file">
            <input class="uk-input uk-form-width-medium" type="text" placeholder="画像アップロード" disabled>
        </div>
        
    <p style="text-align:center;margin-top:10px;" uk-margin>
        <button class="uk-button uk-button-primary uk-button-large">投稿</button>
    </p>
    </fieldset>
</form>
</div>
</div>
<hr class="uk-divider-icon">

@endsection