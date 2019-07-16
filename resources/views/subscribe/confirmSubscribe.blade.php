@extends('layouts.layout')

@section('title','確認画面')

@section('body')
<hr class="uk-divider-icon">
    <!--依頼情報-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>応募条件の確認</p>
        </div>
        <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
                <tr>
                    <td class="uk-width-small">応募メッセージ</td>
                    <td>{{$subscribe->message}}</td>
                </tr>
            </tbody>
        </table>
    <div style="display:inline-flex;" uk-margin>
        <form action="backSubscribe" style="margin-right:20px;" method="post">
            {{ csrf_field() }}
            <button class="uk-button uk-button-danger uk-button-large">戻る</button>
        </form>
        <form action="/completeSubscribe" method="post">
            {{ csrf_field() }}
            <button class="uk-button uk-button-primary uk-button-large" method="post">応募</button>
            <input type="hidden" name="job_id" value="{{$job_id}}">
        </form>
    </div>
    </div>

@endsection