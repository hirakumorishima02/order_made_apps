@extends('layouts.layout')
@section('title',$keyword.'の検索結果')
@section('body')

<h4>{{ $keyword }}の検索結果</h4>

    <table class="uk-table">
    <thead>
        <tr>
            <td>案件名</td>
            <td>報酬</td>
            <td>依頼主</td>
        </tr>
    </thead>
    <tbody>
        @foreach($jobs as $job)
        <tr>
            <td><a href="/job/{{$job->id}}/{{$job->user_id}}">{{$job->title}}</a></td>
            <td>{{number_format($job->money)}}円</td>
            <td><a href="/profile/{{$job->user->id}}">{{$job->user->name}}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection