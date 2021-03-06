@extends('layouts.app')

@section('content')
<div class="col-12">
    <div id="qr_receve" class="card mx-auto">
        <div class="card p-1 pb-0">
            <h2>送信完了</h2>
            <div class="mx-auto">
                <img src="../img/dummy.png" alt="Portrait {{$receve_user->name}}" />
            </div>
            <div class="mx-auto">
                <p class="mx-auto text-center mb-0">ID: {{$receve_user->user_id}}</p>
                <h3 class="mx-auto text-center mb-0">{{$receve_user->name}} さんに<br>{{$sent_book->receve_point}} Pt<br>送信しました</h3>
            </div>
        </div>
    </div>
    <div class="card mx-auto mt-3 pb-3">
        <h2 class="mt-3">残高 : {{number_format($now_point)}}Pt</h2>
        <a role="button" href="/" class="btn btn-lg btn-warning d-block mx-auto mt-3">HOME</a>
        <a role="button" href="/" class="btn btn-lg btn-warning d-block mx-auto mt-3 disabled">別の人にあげる</a>
        <a role="button" href="/history/{{$user->user_id}}" class="btn btn-lg btn-warning d-block mx-auto mt-3">通帳を見る</a>
    </div>
</div>

@endsection
