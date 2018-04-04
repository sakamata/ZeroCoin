@extends('layouts.app')

@section('content')
<div class="col-12">
    <div id="qr_receve" class="card mx-auto">
        <div class="card p-1 pb-0">
            <h2>あげる</h2>
            <div class="mx-auto">
                <img src="../img/dummy.png" alt="Portrait {{$send_user->name}}" />
            </div>
            <div class="mx-auto">
                <p class="mx-auto text-center mb-0">{{$send_user->user_id}}</p>
                <h3 class="mx-auto text-center mb-0">{{$send_user->name}}</h3>
            </div>
        </div>
    </div>
    <div class="card mx-auto mt-3 pb-3">
        <h2 class="mx-auto mt-3"><span>送信額 : <span id="sum_point">0</span> Pt </span><span id="full_point"></span><button type="button" class="btn btn-lg btn-warning mx-auto">送信</button></h2>
        <div id="send_form" class="text-center mt-3">
            <button type="button" class="btn btn-warning" onclick=sendPointSum(10000)>10000</button>
            <button type="button" class="btn btn-warning" onclick=sendPointSum(1000)>1000</button>
            <button type="button" class="btn btn-warning" onclick=sendPointSum(100)>100</button>
            <button type="button" class="btn btn-warning" onclick=sendPointSum(10)>10</button>
            <button type="button" class="btn btn-warning" onclick=sendPointSum(1)>1</button>
        </div>
        <button type="button" onclick=sendPointSum(0) class="mt-3 btn btn-info d-block mx-auto">リセット</button>
    </div>
    <h2 class="mt-3">残高 : {{number_format($user->now_point)}}Pt</h2>
    <h2 class="mt-3">送信後残高 : <span id="after_point">{{number_format($user->now_point)}}</span>Pt</h2>
</div>

<script type="text/javascript">

// クロージャで送信ポイントを貯める、リセットする
var send_point_sum = function() {
    var sum = 0;
    var point = {{$user->now_point}};
    return function(pt) {
        var full_point = document.getElementById("full_point");
        if (pt == 0) {
            sum = 0;
            point = {{$user->now_point}};
            full_point.innerHTML = "";
        } else {
            sum = sum + pt;
            point = point - pt;
            // 残高を超えた場合
            if (sum >= {{$user->now_point}}) {
                console.log('残高over!!');
                sum = {{$user->now_point}};
                point = 0;
                full_point.innerHTML = "（全額）";
            }
        }
        var sum_point = document.getElementById("sum_point");
        sum_point.innerHTML = sum;
        var after_point = document.getElementById("after_point");
        after_point.innerHTML = point;
        console.log(sum);
    }
}
var sendPointSum = send_point_sum();

</script>
@endsection
