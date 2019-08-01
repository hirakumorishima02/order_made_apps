@extends('layouts.layout')

@section('title','案件の詳細')

@section('body')

<hr class="uk-divider-icon">
<div class="container">
    <!--案件タイトル-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1" style="padding-top:10px;padding-bottom:10px;" uk-sticky>
        <p>案件</p>
        <h3 class="uk-card-title" style="margin-top:10px;">{{$job->title}}</h3>
    </div>
    <!--クライアント情報-->
    <a href="/profile/{{$job->user_id}}">
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
            @if(null != $job->user()->first()->userInfosToUser()->first()->photo)
            <img src="{{$job->user()->first()->userInfosToUser()->first()->photo}}" alt="" uk-cover width="200" height="200">
            @else
            <img src="/images/avatar.jpg" alt="" uk-cover width="200" height="200">
            @endif
        </div>
        <div>
            <div class="uk-card-body">
                <p>クライアント情報</p>
                <h3 class="uk-card-title" style="margin-top:20px;">{{$job->user->name}}</h3>
                @if(isset($job->user()->first()->userInfosToUser()->first()->profile))
                <p>{{$job->user()->first()->userInfosToUser()->first()->profile}}</p>
                @else
                <p></p>
                @endif
            </div>
        </div>
    </div>
    </a>
    <!--依頼情報-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>依頼条件</p>
        </div>
        <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
                <tr>
                    <td class="uk-width-small">報酬</td>
                    <td>{{number_format($job->money)}}円</td>
                </tr>
                <tr>
                    <td class="uk-width-small">納品希望日</td>
                    <td>{{$job->wish_at}}</td>
                </tr>
                <tr>
                    <td class="uk-width-small">掲載日</td>
                    <td>{{$job->created_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--依頼の詳細-->
    <div class="uk-card uk-card-default uk-card-body uk-width-1">
        <div class="uk-text-large">
        <p>依頼の詳細</p>
        </div>
            <div class="uk-child-width-1@m uk-child-width-1" uk-grid>
                <div>
                    <p class="uk-text-top">{{$job->content}}</p>
                </div>
                @if(isset($job->job_photo))
                    <div>
                        イメージ：<a href="{{$job->job_photo}}"><span uk-icon="file-text"></span></a>
                    </div>
                @endif
            </div>
    </div>
<hr class="uk-divider-icon">

<!--もしこの依頼に応募していなかった場合-->
@if(!isset($mySubscribe))
もしこの依頼に応募していなかった場合
    <!--応募フォーム-->
    <div style="margin: 0 auto;">
    <!--もしこの依頼を出した人ではない場合-->
    @if($job->user_id != $user_id)
    もしこの依頼を出した人ではない場合
        <form action="/confirmSubscribe/{{$job->id}}" method="post">
            {{ csrf_field() }}
            <fieldset class="uk-fieldset">
                <legend class="uk-legend">応募フォーム</legend>
                <div class="uk-margin">
                    <textarea class="uk-textarea" rows="5" name="message" placeholder="応募メッセージ"></textarea>
                    <input type="hidden" name="status" value="1"></textarea>
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <input type="hidden" name="job_id" value="{{$job->id}}">
                </div>
            <p style="text-align:center;margin-top:10px;" uk-margin>
                <button class="uk-button uk-button-primary uk-button-large">応募</button>
            </p>
            </fieldset>
        </form>
    <!--もしこの依頼を出した人の場合-->
    @elseif($job->user_id == $user_id)
    もしこの依頼を出した人の場合
        <!--もし依頼をする人を決めていない場合-->
        <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->where('status','!=',1)->first(); ?>
        @if(!isset($subscribeCheck))
        もし依頼をする人を決めていない場合
        <form action="/editRequest/{{$job->id}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset class="uk-fieldset">
                <legend class="uk-legend">依頼編集</legend>
                <!--依頼タイトル-->
                <div class="uk-margin">
                    <input class="uk-input" type="text" name="title" placeholder="依頼タイトル" value="{{$job->title}}">
                </div>
                <!--報酬-->
                <div class="uk-margin">
                    <input class="uk-input" type="text" name="money" placeholder="希望契約金額" value="{{$job->money}}">
                </div>
                <!--依頼の詳細-->
                <div class="uk-margin">
                    <textarea class="uk-textarea" rows="5" name="content" placeholder="依頼の詳細">{{$job->content}}</textarea>
                </div>
                <div class="uk-margin">
                    <input type="text" data-uk-datepicker="{format:'YYYY.MM.DD'}" placeholder="希望納期" name="wish_at"  value="{{$job->wish_at}}">
                </div>
                <!--参考画像-->
                <div class="uk-margin">
                    <p style="margin-bottom:0px;">参考画像</p>
                    <input type="file" name="job_photo">
                </div>
            <p style="text-align:center;margin-top:10px;" uk-margin>
                <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">編集</button>
            </p>
            <input type="hidden" name="id" value="{{$job->id}}">
            </fieldset>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/deleteRequest/{{$job->id}}" method="post"  onclick='return confirm("本当に削除しますか？");'>
            {{ csrf_field() }}
            <p style="text-align:center;margin-top:10px;" uk-margin>
                <button class="uk-button uk-button-danger uk-button-large" style="border-radius:5px;">削除</button>
            </p>
            <input type="hidden" name="id" value="{{$job->id}}">
            </fieldset>
        </form>
        <!--もし依頼をする人を決めている場合-->
        @else
        もし依頼をする人を決めている場合
            <!--メッセージが届いている場合-->
            @if(null !== $messages->first())
            メッセージが届いている場合2
            <table class="uk-table uk-table-hover uk-table-divider">
                <tbody>
                    @foreach($messages as $message)
                    <tr>
                        <td class="uk-width-small">{{$message->user->name}}</td>
                        <td class="uk-width-small">{{$message->body}}</td>
                        @if(isset($message->file))
                        <td class="uk-width-small"><a href="{{$message->file}}"><span uk-icon="file-text"></span></a></td>
                        @else
                        <td></td>
                        @endif
                        <td class="uk-width-small">{{$message->created_at}}</td>
                    </tr>
                    @endforeach
                    <tr>
                    <form method="post" action="/message" style="width:500px;margin:0 auto;">
                        {{csrf_field()}}
                        <tr><textarea name="body" row="5" style="width:100%;"></textarea></tr>
                        <input type="submit" value="メッセージ送信">
                        <input type="hidden" name="job_id" value="{{$job->id}}">
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </tr>
                    <tr>
                        <!--ペジネーション-->
                        {{ $messages->links() }}
                    </tr>
                </tbody>
            </table>
            <!---->
            <!---->
            <!--依頼を頼まれた人の場合-->
            @if($job->user_id != $user_id) <!--発注者でもなく、受注希望者でもない人を入れる-->
            受注希望者の場合
                <!--依頼を頼まれた人がまだ納品をしていない場合-->
                @if($mySubscribe->status == 2)
                依頼を頼まれた人がまだ納品をしていない場合1
                <h4>納品</h4>
                <form method="post" action="/delivery" enctype="multipart/form-data">
                {{csrf_field()}}
                <textarea name="body" row="5" style="width:100%;"></textarea>
                <input type="file" name="file"><br>
                <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">納品</button>
                <input type="hidden" name="job_id" value="{{$job->id}}">
                <input type="hidden" name="mySubscribe_id" value="{{$subscribeCheck[$i]['id']}}">
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!--依頼を頼まれた人が納品をした場合-->
                @elseif($mySubscribe->status == 3)
                依頼を頼まれた人が納品をした場合1
                <p>ただいま{{$job->user->name}}さんが検収しています。</p>
                <h4>再納品</h4>
                <form method="post" action="/delivery" enctype="multipart/form-data">
                {{csrf_field()}}
                <textarea name="body" row="5" style="width:100%;"></textarea>
                <input type="file" name="file"><br>
                <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">納品</button>
                <input type="hidden" name="job_id" value="{{$job->id}}">
                
                    <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
                    <?php
                        foreach($subscribeCheck as $status => $val) {
                        if($val['status'] == 3){
                                // statusの値が3の配列のindex番号を探している4
                                $i = $status;
                            }else{
                                $i = 0;
                            }
                        };
                    ?>
                
                <input type="hidden" name="mySubscribe_id" value="{{$subscribeCheck[$i]['id']}}">
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @endif
            <!--依頼者の場合-->
            @elseif($job->user_id == $user_id)
            依頼者の場合
                <!--依頼を頼まれた人がまだ納品をしていない場合-->
                依頼を頼まれた人がまだ納品をしていない場合2
                <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
                    @if(null !== App\Subscribe::where('job_id', $job->id)->first())
                        <?php
                            foreach($subscribeCheck as $status => $val) {
                            if($val['status'] == 3){
                                    // statusの値が3の配列のindex番号を探している1
                                    $i = $status;
                                }else{
                                    $i = 0;
                                }
                            };
                        ?>
                        <!--依頼を頼まれた人がすでに納品をした場合-->
                        @if($subscribeCheck[$i]['status'] == 3)
                        依頼を頼まれた人がすでに納品をしている場合
                        <form method="post" action="/jobComplete">
                            {{csrf_field()}}
                            <textarea name="body" row="5" style="width:100%;"></textarea>
                            <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">検収完了</button>
                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <input type="hidden" name="title" value="{{$job->title}}">
                            <input type="hidden" name="subscribe_id" value="{{$subscribeCheck[$i]['id']}}">
                            <input type="hidden" name="subscribe_user_id" value="{{$subscribeCheck[$i]['user_id']}}">
                        </form>
                        @elseif($subscribeCheck[$i]['status'] == 4)
                        <p>検収が完了しました！</p>
                        @endif
                    @endif
            @endif
            <!---->
            <!---->
            
            <!--メッセージが届いてない場合-->
            @else
            メッセージが届いてない場合
            <p style="width:500px;margin:0 auto;">まだやり取りはありません。</p>
            <form method="post" action="/message" style="width:500px;margin:0 auto;">
                {{csrf_field()}}
                <tr><textarea name="body" row="5" style="width:100%;"></textarea></tr>
                <input type="submit">
                <input type="hidden" name="job_id" value="{{$job->id}}">
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!---->
            <!---->
            <!--依頼を頼まれた人の場合-->
            @if($job->user_id != $user_id) <!--発注者でもなく、受注希望者でもない人を入れる-->
            受注希望者の場合
                <!--依頼を頼まれた人がまだ納品をしていない場合-->
                @if($mySubscribe->status == 2)
                依頼を頼まれた人がまだ納品をしていない場合3
                <h4>納品</h4>
                <form method="post" action="/delivery"  enctype="multipart/form-data">
                {{csrf_field()}}
                <textarea name="body" row="5" style="width:100%;"></textarea>
                <input type="file" name="file"><br>
                <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">納品</button>
                <input type="hidden" name="job_id" value="{{$job->id}}">
                <input type="hidden" name="mySubscribe_id" value="{{$mySubscribe->id}}">
                </form>
                {{$mySubscribe->id}}
                <!--依頼を頼まれた人が納品をした場合-->
                @elseif($mySubscribe->status == 3)
                依頼を頼まれた人が納品をした場合2
                <p>ただいま{{$job->user->name}}さんが検収しています。</p>
                <h4>再納品</h4>
                <form method="post" action="/delivery" enctype="multipart/form-data">
                {{csrf_field()}}
                <textarea name="body" row="5" style="width:100%;"></textarea>
                <input type="file" name="file"><br>
                <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">納品</button>
                <input type="hidden" name="job_id" value="{{$job->id}}">
                
                    <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
                    <?php
                        foreach($subscribeCheck as $status => $val) {
                        if($val['status'] == 3){
                                // statusの値が3の配列のindex番号を探している4
                                $i = $status;
                            }else{
                                $i = 0;
                            }
                        };
                    ?>
                
                <input type="hidden" name="mySubscribe_id" value="{{$subscribeCheck[$i]['id']}}">
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @endif
            <!--依頼者の場合-->
            @elseif($job->user_id == $user_id)
            依頼者の場合
                <!--依頼を頼まれた人がまだ納品をしていない場合-->
                依頼を頼まれた人がまだ納品をしていない場合4
                <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
                    @if(null !== App\Subscribe::where('job_id', $job->id)->first())
                        <?php
                            foreach($subscribeCheck as $status => $val) {
                            if($val['status'] == 3){
                                    // statusの値が3の配列のindex番号を探している2
                                    $i = $status;
                                }else{
                                    $i = 0;
                                }
                            };
                        ?>
                        <!--依頼を頼まれた人がすでに納品をした場合-->
                        依頼を頼まれた人がすでに納品をしている場合
                        @if($subscribeCheck[$i]['status'] == 3)
                        <form method="post" action="/jobComplete">
                            {{csrf_field()}}
                            <textarea name="body" row="5" style="width:100%;"></textarea>
                            <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">検収完了</button>
                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <input type="hidden" name="title" value="{{$job->title}}">
                            <input type="hidden" name="subscribe_id" value="{{$subscribeCheck[$i]['id']}}">
                        </form>
                        @elseif($subscribeCheck[$i]['status'] == 4)
                        <p>検収が完了しました！</p>
                        @endif
                    @endif
            @endif
            <!---->
            <!---->
            
            @endif
        @endif
    @endif
    </div>
<!--もしこの依頼に応募しており、まだ依頼主が決定していない場合-->
@elseif($mySubscribe->status == 1 )
もしこの依頼に応募しており、まだ依頼主が決定していない場合1
<p>依頼者が決定されたか、検討中です。</p>
<!--もしこの依頼に応募しており、依頼主に決定された場合-->
@elseif($mySubscribe->status != 1)
もしこの依頼に応募しており、依頼主に決定された場合
<div style="margin:0 auto">
    お仕事チャット欄
    <!--メッセージが届いている場合-->
    @if(isset($messages))
    メッセージが届いている場合1
        <table class="uk-table uk-table-hover uk-table-divider">
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td class="uk-width-small">{{$message->user->name}}</td>
                        <td class="uk-width-small">{{$message->body}}</td>
                        @if(isset($message->file))
                        <td class="uk-width-small"><a href="{{$message->file}}"><span uk-icon="file-text"></span></a></td>
                        @else
                        <td></td>
                        @endif
                        <td class="uk-width-small">{{$message->created_at}}</td>
                    </tr>
                @endforeach
                <tr>
                <form method="post" action="/message" style="width:500px;margin:0 auto;">
                    {{csrf_field()}}
                    <tr><textarea name="body" row="5" style="width:100%;"></textarea></tr>
                    <input type="submit">
                    <input type="hidden" name="job_id" value="{{$job->id}}">
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </tr>
                <tr>
                    <!--ペジネーション-->
                    {{ $messages->links() }}
                </tr>
            </tbody>
        </table>
        @if($mySubscribe->status == 2)
        依頼を頼まれた人がまだ納品をしていない場合5
        <h4>納品</h4>
        <form method="post" action="/delivery" enctype="multipart/form-data">
        {{csrf_field()}}
        <textarea name="body" row="5" style="width:100%;"></textarea>
        <input type="file" name="file"><br>
        <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">納品</button>
        <input type="hidden" name="job_id" value="{{$job->id}}">
        <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
        <?php
            foreach($subscribeCheck as $status => $val) {
            if($val['status'] == 3){
                    // statusの値が3の配列のindex番号を探している3
                    $i = $status;
                }else{
                    $i = 0;
                }
            };
        ?>
        
        <input type="hidden" name="mySubscribe_id" value="{{$subscribeCheck[$i]['id']}}">
        </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <!--依頼を頼まれた人が納品をした場合-->
        @elseif($mySubscribe->status == 3)
        {{$mySubscribe}}
        依頼を頼まれた人が納品をした場合3
        <p>ただいま{{$job->user->name}}さんが検収しています。</p>
        <h4>再納品</h4>
        <form method="post" action="/delivery" enctype="multipart/form-data">
        {{csrf_field()}}
        <textarea name="body" row="5" style="width:100%;"></textarea>
        <input type="file" name="file"><br>
        <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">納品</button>
        <input type="hidden" name="job_id" value="{{$job->id}}">
        
            <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
            <?php
                foreach($subscribeCheck as $status => $val) {
                if($val['status'] == 3){
                        // statusの値が3の配列のindex番号を探している4
                        $i = $status;
                    }else{
                        $i = 0;
                    }
                };
            ?>
        
        <input type="hidden" name="mySubscribe_id" value="{{$subscribeCheck[$i]['id']}}">
        </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
    <!--メッセージが届いてない場合-->
    @else
    メッセージが届いてない場合
    <p style="width:500px;margin:0 auto;">まだやり取りはありません。</p>
    <form method="post" action="/message" style="width:500px;margin:0 auto;">
        {{csrf_field()}}
        <tr><textarea name="body" row="5" style="width:100%;"></textarea></tr>
        <input type="submit">
        <input type="hidden" name="job_id" value="{{$job->id}}">
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($mySubscribe->status == 2)
    依頼を頼まれた人がまだ納品をしていない場合6
    <h4>納品</h4>
    <form method="post" action="/delivery" enctype="multipart/form-data">
    {{csrf_field()}}
    <textarea name="body" row="5" style="width:100%;"></textarea>
    <input type="file" name="file"><br>
    <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">納品</button>
    <input type="hidden" name="job_id" value="{{$job->id}}">
    
        <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
        <?php
            foreach($subscribeCheck as $status => $val) {
            if($val['status'] == 3){
                    // statusの値が3の配列のindex番号を探している4
                    $i = $status;
                }else{
                    $i = 0;
                }
            };
        ?>
    
    <input type="hidden" name="mySubscribe_id" value="{{$subscribeCheck[$i]['id']}}">
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--依頼を頼まれた人が納品をした場合-->
    @elseif($mySubscribe->status == 3)
    依頼を頼まれた人が納品をした場合4
    <p>ただいま{{$job->user->name}}さんが検収しています。</p>
    <h4>再納品</h4>
    <form method="post" action="/delivery" enctype="multipart/form-data">
    {{csrf_field()}}
    <textarea name="body" row="5" style="width:100%;"></textarea>
    <input type="file" name="file"><br>
    <button class="uk-button uk-button-primary uk-button-large" style="border-radius:5px;">納品</button>
    <input type="hidden" name="job_id" value="{{$job->id}}">
    
        <?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
        <?php
            foreach($subscribeCheck as $status => $val) {
            if($val['status'] == 3){
                    // statusの値が3の配列のindex番号を探している4
                    $i = $status;
                }else{
                    $i = 0;
                }
            };
        ?>
    
    <input type="hidden" name="mySubscribe_id" value="{{$subscribeCheck[$i]['id']}}">
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @endif
    @endif
@else
<p>依頼者が決定されたか、検討中です。</p>
@endif
</div>

<?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
@if(null !== App\Subscribe::where('job_id', $job->id)->first())
    <?php
        foreach($subscribeCheck as $status => $val) {
        if($val['status'] == 3){
                // statusの値が3の配列のindex番号を探している5
                $i = $status;
            }else{
                $i = 0;
            }
        };
    ?>
    @if($subscribeCheck[$i]['status'] == 4 && $subscribeCheck[$i]->user()->first()->id == $user_id)
    <p>検収が完了しました！</p>
    @endif
@endif

<?php $subscribeCheck = App\Subscribe::where('job_id', $job->id)->get(); ?>
@if(isset($subscribeCheck))
    @if(null !== App\Subscribe::where('job_id', $job->id)->first())
        <?php
            foreach($subscribeCheck as $status => $val) {
            if($val['status'] == 4){
                    // statusの値が3の配列のindex番号を探している5
                    $i = $status;
                }else{
                    $i = 0;
                }
            };
        ?>
        @if($subscribeCheck[$i]['status'] == 4)
        <p>この依頼はすでに終了しています。</p>
        @endif
    @endif
@endif
</div>
<hr class="uk-divider-icon">
@endsection