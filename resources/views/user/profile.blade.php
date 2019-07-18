@extends('layouts.layout')

@section('title','プロフィール')

@section('body')

<hr class="uk-divider-icon">
<div uk-grid>
    <div class="uk-width-1-4">
        <div class="uk-card">
            @if(isset($userInfo->photo))
            <img data-src="{{ $userInfo->photo }}" width="" height="" alt="" uk-img>
            @else
            <img data-src="/images/avatar.jpg" width="" height="" alt="" uk-img>
            @endif
                <!--忘れてはいけないリレーションメソッドの使用例!-->
                @if($thisUser->id != $user_id && null == $user->followsToUser()->where('follow_user_id',$thisUser->id)->first())
                    <form action="/follow" method="post" onsubmit="doSomething();return false;">
                        {{csrf_field()}}
                        <a href="javascript:void(0)" onclick="this.parentNode.submit()" uk-icon="heart" id="hidden"></a>follow
                        <input type="hidden" name="follow_user_id" value="{{$thisUser->id}}">
                        <input type="hidden" name="user_id" value="{{$user_id}}">
                    </form>
                @elseif(isset($follow->follow_user_id))
                        @if($follow->follow_user_id == $thisUser->id)
                        <form action="/deleteFollow" method="post" onsubmit="doSomething();return false;">
                            {{csrf_field()}}
                            <a href="javascript:void(0)" onclick="this.parentNode.submit()" uk-icon="heart" id="fav"></a>follow解除
                            <input type="hidden" name="follow_user_id" value="{{$thisUser->id}}">
                            <input type="hidden" name="follow_id" value="{{$follow->id}}">
                        </form>
                        @endif
                @endif
        </div>
    </div>
    <div class="uk-width-3-4">
        <div class="uk-card  uk-card-default uk-card-body " style="width:1000px;">
            <h3>{{ $thisUser->name }}さんのプロフィール</h3>
            @if(isset($userInfo)&&isset($user))
            <p>{{ $userInfo->profile }}</p>
            @else
            <p></p>
            @endif
        </div>
    </div>
</div>
    <div>
        <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
                <tr>
                    <td class="uk-width-medium">制作実績</td>
                    @if(isset($portfolios))
                    @foreach($portfolios as $val)
                    <td>{{$val->title}}</td>
                    @endforeach
                    @endif
                </tr>
                <tr>
                    <td class="uk-width-medium">ポートフォリオサイト</td>
                    @if(isset($userInfo->url))
                    <td>{{$userInfo->url}}</td>
                    @endif
                </tr>
                <tr>
                    <td class="uk-width-medium">GitHubアカウント</td>
                    @if(isset($userInfo->github))
                    <td>{{$userInfo->github}}</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
    @if($user->id == $user_id)
    <a href="/editProfile"><button class="uk-button uk-button-primary">情報の登録</button></a>
    @endif
@endsection