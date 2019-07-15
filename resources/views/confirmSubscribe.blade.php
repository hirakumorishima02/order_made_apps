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
                    <td>応募メッセージです。　応募メッセージです。　応募メッセージです。　応募メッセージです。　応募メッセージです。　応募メッセージです。　
                    応募メッセージです。　応募メッセージです。　応募メッセージです。　応募メッセージです。　応募メッセージです。</td>
                </tr>
            </tbody>
        </table>
    <div style="display:inline-flex;" uk-margin>
        <form action="item.html" style="margin-right:20px;">
            <button class="uk-button uk-button-danger uk-button-large">戻る</button>            
        </form>
        <form action="subscribe.html">
            <button class="uk-button uk-button-primary uk-button-large">応募</button>            
        </form>
    </div>
    </div>

@endsection