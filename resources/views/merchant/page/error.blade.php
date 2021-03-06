@extends('layouts.antui')
@section('content')
    <div class="am-message result">
        <i class="am-icon result error"></i>
        <div class="am-message-main">支付失败</div>
        <div class="am-message-sub">{{$msg}}<span id="jumpTo">5</span>秒后自动跳转到收款界面</div>
        </div>
    </div>


    <script type="text/javascript">
        window.onload = get;
        function get() {
            countDown(5, '{{route('AlipayTradePayCreate')}}');
        }
    </script>
    <script>
        function countDown(secs, surl) {
            var jumpTo = document.getElementById('jumpTo');
            jumpTo.innerHTML = secs;
            if (--secs > 0) {
                setTimeout("countDown(" + secs + ",'" + surl + "')", 1000);
            }
            else {
                location.href = surl;
            }
        }
    </script>
@endsection