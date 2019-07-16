@extends('layouts.layout')
@section('title','プロフィール編集画面')
@section('body')

<div class="container">
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>プロフィール情報</p>
        </div>
            <table class="uk-table uk-table-hover uk-table-divider">
                @if(isset($userInfo)&&isset($user))
                <form action="/updateProfile" method="post" enctype="multipart/form-data">
                @else
                <form action="/addProfile" method="post" enctype="multipart/form-data">
                @endif
                {{ csrf_field() }}
                <tr>
                    <td>お名前</td>
                    <td><input class="uk-input" type="text" name="name" value="{{$user->name}}"></td>
                </tr>
                <tr>
                    <td>プロフィール写真</td>
                    <td>
                    @if(isset($userInfo->photo))
                    <img src="{{$userInfo->photo}}" width="50" height="50">
                    @endif
                    <input type="file" name="photo">
                    </td>
                </tr>
                <tr>
                    <td>プロフィール文</td>
                    <td><textarea class="uk-textarea" type="text" name="profile" rows="5">@if(isset($userInfo->profile)){{$userInfo->profile}}@endif</textarea>
                    </td>
                </tr>
                <tr>
                    <td>ポートフォリオサイト</td>
                    @if(isset($userInfo->url))
                    <td><input class="uk-input" type="text" name="url" value="{{$userInfo->url}}"></td>
                    @else
                    <td><input class="uk-input" type="text" name="url"></td>
                    @endif
                </tr>
                <tr>
                    <td>GitHubアカウント</td>
                    @if(isset($userInfo->github))
                    <td><input class="uk-input" type="text" name="github" value="{{$userInfo->github}}"></td>
                    @else
                    <td><input class="uk-input" type="text" name="github"></td>
                    @endif
                </tr>
                <tr>
                    <td>
                        <button class="uk-button uk-button-primary" onclick='return confirm("編集を完了しますか？");'>編集完了</button>
                    </td>
                </tr>
            </form>
        </table>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@endsection