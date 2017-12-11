

<?php $__env->startSection('content'); ?>
    <div class="am-message result">
        <i class="am-icon result pay"></i>
        <div class="am-message-main">支付成功</div>
        <div class="am-message-em"><?php echo e($price); ?>元</div>
        <a class="am-button blue success" role="alert" aria-live="assertive" onclick="closed()">
            确认
        </a>
    </div>
    <script>
        function closed() {
            AlipayJSBridge.call('closeWebview');
        }

    </script>
    <?php $__currentLoopData = $ad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <?php if($v->type=="alipay"&&$v->position==1): ?>
            <div class="am-message-main"><a href="<?php echo e($v->url); ?>"><img src="<?php echo e($v->pic); ?>" style="box-sizing: border-box; max-width: 100%; height: auto;  vertical-align: middle;border: 0;"></a></div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.antui', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>