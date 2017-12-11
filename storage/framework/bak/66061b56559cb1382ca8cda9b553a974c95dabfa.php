
<?php $__env->startSection('title','微信支付'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('/css/weixinpay/wxpay.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <body ontouchstart class="weui-wepay-pay-wrap">
    <div class="msg_success">
        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">付款成功</h2>
                <p class="weui-msg__desc">欢迎下次光临</p>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <a href="javascript:;" onclick="closed()" class="weui-btn weui-btn_primary">确认</a>
                    <!-- <a href="javascript:history.back();" class="weui-btn weui-btn_default">辅助操作</a> -->
                </p>
            </div>
        </div>
        <?php $__currentLoopData = $ad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if($v->type=="weixin"&&$v->position==1): ?>
                <div class="weui-msg__opr-area"><a href="<?php echo e($v->url); ?>"><img src="<?php echo e($v->pic); ?>" style="box-sizing: border-box; max-width: 100%; height: auto;  vertical-align: middle;border: 0;"></a></div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <div class="weui-wepay-logos weui-wepay-logos_ft">
            <i class="weui-wepay-logo-default weui-wepay-logo_gray"><span class="path1"></span><span class="path2"></span></i>
        </div>
    </div>
    </body>

<script>
    function closed() {
        WeixinJSBridge.invoke('closeWindow',{},function(res){

        });
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.weixinpay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>