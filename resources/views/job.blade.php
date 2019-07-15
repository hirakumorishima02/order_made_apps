@extends('layouts.layout')

@section('title','案件の詳細')

@section('body')

<hr class="uk-divider-icon">
<div class="container">
    <!--案件タイトル-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1" style="padding-top:10px;padding-bottom:10px;" uk-sticky>
        <p>案件</p>
        <h3 class="uk-card-title" style="margin-top:10px;">スケジュール管理アプリを作って欲しい</h3>
    </div>
    <!--クライアント情報-->
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
            <img src="images/avatar.jpg" alt="" uk-cover width="200" height="200">
        </div>
        <div>
            <div class="uk-card-body">
                <p>クライアント情報</p>
                <h3 class="uk-card-title" style="margin-top:20px;">田中　花子</h3>
                <p>〇〇県でサラリーマンとして働きつつ、二児の母として頑張っています。</p>
            </div>
        </div>
    </div>
    <!--依頼情報-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>依頼条件</p>
        </div>
        <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
                <tr>
                    <td class="uk-width-small">報酬</td>
                    <td>10,000円~30,000円</td>
                </tr>
                <tr>
                    <td class="uk-width-small">納品希望日</td>
                    <td>2019/08/31</td>
                </tr>
                <tr>
                    <td class="uk-width-small">掲載日</td>
                    <td>2019/07/18</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--依頼の詳細-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>依頼の詳細</p>
        </div>
            <div class="uk-child-width-1-3@m uk-child-width-1" uk-grid>
                <div>
                    <p class="uk-text-top" style="width:1200px">
                        依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　
                        依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　
                        依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　
                        依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　依頼の詳細です。　
                    </p>
                </div>
            </div>
    </div>
    <!--イメージ画像-->
        <div class="uk-position-relative uk-visible-toggle uk-light uk-width-1-2" style="margin: 0 auto;margin-top:10px;" tabindex="-1" uk-slideshow>
            <ul class="uk-slideshow-items">
                <li>
                    <img data-src="images/photo.jpg" width="1800" height="1200" alt="" uk-cover uk-img="target: !ul > :last-child, !* +*">
                </li>
                <li>
                    <img data-src="images/dark.jpg" width="1800" height="1200" alt="" uk-cover uk-img="target: !* -*, !* +*">
                </li>
                <li>
                    <img data-src="images/light.jpg" width="1800" height="1200" alt="" uk-cover uk-img="target: !* -*, !ul > :first-child">
                </li>
            </ul>
        
            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
        </div>
<hr class="uk-divider-icon">
<!--応募フォーム-->
<div style="width:700px;margin: 0 auto;">
<form action="confirmSubscribe.html">
    <fieldset class="uk-fieldset">
        <legend class="uk-legend">応募フォーム</legend>
        <div class="uk-margin">
            <textarea class="uk-textarea" rows="5" name="subscribeMessage" placeholder="応募メッセージ"></textarea>
        </div>
    <p style="text-align:center;margin-top:10px;" uk-margin>
        <button class="uk-button uk-button-primary uk-button-large">応募</button>
    </p>
    </fieldset>
</form>
</div>
</div>
<hr class="uk-divider-icon">

@endsection