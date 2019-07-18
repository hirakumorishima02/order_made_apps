@extends('layouts.layout')

@section('title','確認画面')

@section('body')
<hr class="uk-divider-icon">
    <!--依頼情報-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>投稿依頼の確認</p>
        </div>
        <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
                <tr>
                    <td class="uk-width-small">依頼タイトル</td>
                    <td>{{$job->title}}</td>
                </tr>
                <tr>
                    <td class="uk-width-small">報酬</td>
                    <td>{{$job->money}}円</td>
                </tr>
                <tr>
                    <td class="uk-width-small">依頼の詳細</td>
                    <td>{{$job->content}}</td>
                </tr>
                <tr>
                    <td class="uk-width-small">希望納期</td>
                    <td>{{$job->wish_at}}</td>
                </tr>
                <tr>
                    <td>添付画像</td>
                    <td><img src="{{}}"></td>
                </tr>
            </tbody>
        </table>
    <div style="display:inline-flex;" uk-margin>
        <form action="backRequest" style="margin-right:20px;" method="post">
            {{ csrf_field() }}
            <button class="uk-button uk-button-danger uk-button-large">戻る</button>
        </form>
        <form action="/completeRequest" method="post">
            {{ csrf_field() }}
            <button class="uk-button uk-button-primary uk-button-large" method="post">応募</button>
        </form>
    </div>
    </div>

@endsection