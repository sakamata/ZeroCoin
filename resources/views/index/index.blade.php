@extends('layouts.app')

@section('content')
<div class="col-12">
    <div id="qr_receve" class="card mx-auto">
        <div class="card p-1 pb-0">
            <h2>もらう</h2>
            <div class="mx-auto">
                <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ Request::root() }}/send/{{$user->user_id}}&size=180x180" alt="ZeroCoin QR code send {{$user->user_id}}" />
            </div>
            <p class="mx-auto text-center mb-0">もらう場合はお相手にZeroCoinでこのQRコードを撮影してもらいます</p>
        </div>
    </div>

    <div class="card mx-auto mt-3 pb-3">
        <div id="qr_res_message" class="text-center p-3"></div>
        <h2 class="mt-3">残高 : {{number_format($user->now_point)}}Pt</h2>
        <form id="qr_form">
            <input type=text id="qr_url" size=1 placeholder="Tracking Code" class=qrcode-text>
            <label class=qrcode-text-btn mx-auto>
                <input type=file accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1>
            </label>
        </form>

        <div id="send_form" class="mx-auto mt-3" style="display:none">
            <button type="button" class="btn btn-lg btn-warning d-block mx-auto"  onclick=checkQRpath()>あげる</button>
        </div>
        <div class="d-flex mt-3">
            <a id="btn_back" style="display:none" role="button" href="/" class="btn btn-lg btn-warning mx-auto">もどる</a>
        </div>
        <div class="d-flex mt-3">
            <a role="button" href="/" class="btn btn-lg btn-warning d-block mx-auto disabled">別の人にあげる</a>
        </div>
        <div class="d-flex mt-3">
            <a role="button" href="/history/{{$user->user_id}}" class="btn btn-lg btn-warning d-block mx-auto">通帳を見る</a>
        </div>
    </div>
</div>

<script type="text/javascript">
function openQRCamera(node) {
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("QRコードが見つかりませんでした。 QRコードが画面中央に全て入るよう撮影してください。");
      } else {
        node.parentNode.previousElementSibling.value = res;

        var message = document.getElementById("qr_res_message");
        message.innerHTML = "<div class='alert alert-warning text-center mt-5 mb-5'>QRコードを読み取りました<br>『あげる』を押してください</div>";
        document.getElementById("qr_form").style.display="none";
        document.getElementById("qr_receve").style.display="none";
        document.getElementById("btn_back").style.display="inline";
        document.getElementById("send_form").style.display="block";
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function showQRIntro() {
  return confirm("起動するカメラでお相手のQRコードを撮影してください");
}

function checkQRpath() {
    var qr_url = document.getElementById("qr_url").value;
    // URLのバリテーション
    var check_url =  qr_url.slice(0,7);
    if (
        (qr_url.slice(0,7) == "http://"
        || qr_url.slice(0,8) == "https://")
        && qr_url.match('{{ Request::root() }}')
    ) {
        // ToDo 自身のQRコードだった場合のエラー処理

        // console.log("http開始の文字列です。");
        // console.log('ZeroCoinのドメインです');
        location.href=qr_url;
    } else {
        console.log("httpのQRではない");
        console.log(qr_url);
        // pathがZeroCoinでない場合はメッセージ表示
        var message = document.getElementById("qr_res_message");
        message.innerHTML = "ZeroCoinのQRコードではありません" + qr_url;
        document.getElementById("qr_form").style.display="block";
        document.getElementById("send_form").style.display="none";
        document.getElementById("qr_url").value="";
        return;
    }
}
</script>
@endsection
