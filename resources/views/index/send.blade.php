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
                <p class="mx-auto text-center mb-0">ID: {{$send_user->user_id}}</p>
                <h3 class="mx-auto text-center mb-0">{{$send_user->name}}</h3>
            </div>
        </div>
    </div>
    <div class="card mx-auto mt-3 pb-3">
        <table class="table table-borderless text-right mb-0 balance_table">
            <tr>
                <th>残高 :</th>
                <td>{{number_format($user->now_point)}}&nbsp;Pt</td>
            </tr>
            <tr>
                <th><span id="full_point"></span>送信額 :</th>
                <td><mark><span id="sum_point" >0</span><mark>&nbsp;Pt</td>
            </tr>
            <tr>
                <th>送信後残高 :</th>
                <td><span id="after_point">{{number_format($user->now_point)}}</span>&nbsp;Pt</td>
            </tr>
        </table>
        <form action="/post" method="post">
            {{ csrf_field() }}
            <!-- style非表示でフォームを持つ、JSで値を入れ、coinの額を送信する -->
            <input type="number" id="send_point" name="send_point" style="display:none;">
            <input type="hidden" name="receve_user_id" value="{{$send_user->id}}">
            <div id="send_form" class="text-center mt-3">
                <button type="button" class="btn btn-warning" onclick=sendPointSum(10000)>10000</button>
                <button type="button" class="btn btn-warning" onclick=sendPointSum(1000)>1000</button>
                <button type="button" class="btn btn-warning" onclick=sendPointSum(100)>100</button>
                <button type="button" class="btn btn-warning" onclick=sendPointSum(10)>10</button>
                <button type="button" class="btn btn-warning" onclick=sendPointSum(1)>1</button>
            </div>
            <div class="text-center mt-4">
                <button type="button" onclick=sendPointSum(0) class="btn btn-lg btn-info mr-5">リセット</button>
                <span id="send_btn" style="display:none;">
                    <button type="submit" class="btn btn-lg btn-warning">&nbsp;あげる&nbsp;</button>
                </span>
                <span id="send_btn_disabled">
                    <button type="submit" class="btn btn-lg btn-warning" disabled>&nbsp;あげる&nbsp;</button>
                </span>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
// クロージャで送信ポイントを貯める、リセットする、表示を切り替える
var send_point_sum = function() {
    var sum = 0;
    var point = {{$user->now_point}};
    return function(pt) {
        var full_point = document.getElementById("full_point");
        if (pt == 0) {
            sum = 0;
            point = {{$user->now_point}};
            full_point.innerHTML = "";
            document.getElementById("send_btn").style.display = "none";
            document.getElementById("send_btn_disabled").style.display = "inline";
        } else {
            sum = sum + pt;
            point = point - pt;
            document.getElementById("send_btn").style.display = "inline";
            document.getElementById("send_btn_disabled").style.display = "none";
            // 残高を超えた場合
            if (sum >= {{$user->now_point}}) {
                console.log('残高over!!');
                sum = {{$user->now_point}};
                point = 0;
                full_point.innerHTML = "（全額）";
            }
        }
        document.getElementById("send_point").value = sum;
        send_point.innerHTML = sum;
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
