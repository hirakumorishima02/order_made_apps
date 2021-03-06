<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSSCO-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssco/1.0.0/cssco.css">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/css/uikit.min.css" />
    <!-- UIkit JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/js/uikit-icons.min.js"></script>
    <!--Datepicker用のcdn-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.26.1/js/components/datepicker.js"></script>-->
    <link href="{{ secure_asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
<header>
    <nav class="uk-navbar-container" uk-navbar="mode: click">
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li class="uk-active"><a href="/">TOP</a></li>
                <li>
                    <a href="#">自分の依頼</a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            @foreach($my_jobs as $my_job)
                            <li><a href="/job/{{$my_job->id}}/{{$my_job->user_id}}">{{$my_job->title}}</a></li>
                            @endforeach
                            <li class="uk-active"><a href="/jobRequest">依頼の投稿</a></li>
                            @if(isset($my_job))
                            <li class="uk-active"><a href="/applicants">応募者状況</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#">契約中の依頼</a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            @foreach($subscribesOver2 as $subscribe)
                            <li><a href="/job/{{$subscribe->job_id}}/{{$subscribe->job->user_id}}">{{$subscribe->job->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li><a href="/profile/{{$user_id}}">Profile</a></li>
            </ul>
        </div>
            <div class="uk-margin">
                <form class="uk-search uk-search-default" action="/serch" method="post">
                    {{ csrf_field() }}
                    <span uk-search-icon></span>
                    <input class="uk-search-input" type="search" placeholder="依頼の検索" name="keyword">
                </form>
            </div>
    </nav>
</header>

@yield('body')


<footer style="height:300px;" class="uk-background-muted">
<div class="uk-position-relative">
    <div class="uk-position-top">
        <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
            <div class="uk-navbar-left">
                <ul class="uk-navbar-nav">
                    <li class="uk-active"><a href="/">TOP</a></li>
                    <li>
                        <a href="#">menu</a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="/profile/{{$user_id}}">プロフィール</a></li>
                                <li><a href="">依頼一覧</a></li>
                                <li><a href="/jobRequest">依頼投稿</a></li>
                                <li><a href="/logout">ログアウト</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">開発者の他アプリ</a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="https://invoice-andtodo.herokuapp.com/">請求書&タスク管理</a></li>
                                <li><a href="https://old-book-store.herokuapp.com">古本ECサイト</a></li>
                                <li><a href="https://sharehouse-australia.herokuapp.com">Share House Australia</a></li>
                                <li><a href="#">健康管理アプリ</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
</footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
<script>

    
	$('#datepicker').datepicker();
	$('#datepicker').datepicker("option", "dateFormat", 'yy-mm-dd' );
	
	
// followボタンを押すと、followが消えたり出てきたり、という機能
// 'use strict';
// var target = document.getElementById("hidden");
//     target.onclick = function(){
//         target.classList.add("hidden");    
//         target.parentNode.submit();
// };


</script>
</body>
</html>