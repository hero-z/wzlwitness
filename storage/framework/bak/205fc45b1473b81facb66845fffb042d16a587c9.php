
<?php $__env->startSection('title','微信支付'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('/css/weixinpay/wxpay.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="msg_success">
        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-cancel weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">付款失败</h2>
                <?php if($code): ?>
                <p class="weui-msg__desc" style='color:#FF6633'>已取消订单付款</p>
                <?php else: ?>
                <p class="weui-msg__desc" style='color:#FF6633'>请重新尝试付款</p>
                <?php endif; ?>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <a onclick="WeixinJSBridge.invoke('closeWindow',{},function(res){});" class="weui-btn weui-btn_primary" style='background-color:#DA3E00'>确认</a>
                    <!-- <a href="javascript:history.back();" class="weui-btn weui-btn_default">辅助操作</a> -->
                </p>
            </div>
        </div>
        <div class="weui-wepay-logos weui-wepay-logos_ft">
            <img src="https://act.weixin.qq.com/static/cdn/img/wepayui/0.1.1/wepay_logo_default_gray.svg" alt="" height="16">
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.weixinpay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>