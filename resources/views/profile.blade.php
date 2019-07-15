@extends('layouts.layout')

@section('title','プロフィール')

@section('body')

<hr class="uk-divider-icon">
<div uk-grid>
    <div class="uk-width-1-4">
        <div class="uk-card">
            <img data-src="images/avatar.jpg" width="" height="" alt="" uk-img>
        </div>
    </div>
    <div class="uk-width-3-4">
        <div class="uk-card  uk-card-default uk-card-body " style="width:1000px;">
            <h3>〇〇さんのプロフィール</h3>
            <p>プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。
            プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。
            プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。
            プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。
            プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。
            プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。
            プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。プロフィール文です。
            </p>
        </div>
    </div>
</div>
<hr class="uk-divider-icon">
    <div>
        <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
                <tr>
                    <td class="uk-width-medium">ポートフォリオサイト</td>
                    <td>http://..........</td>
                </tr>
                <tr>
                    <td class="uk-width-medium">GitHubアカウント</td>
                    <td>...............</td>
                </tr>
            </tbody>
        </table>
    </div>
<hr class="uk-divider-icon">

@endsection