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
        </div>
    </div>
    <div class="uk-width-3-4">
        <div class="uk-card  uk-card-default uk-card-body " style="width:1000px;">
            <h3>{{ $userInfo->user->name }}さんのプロフィール</h3>
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
                    @if(isset($portfolio)&&isset($user))
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