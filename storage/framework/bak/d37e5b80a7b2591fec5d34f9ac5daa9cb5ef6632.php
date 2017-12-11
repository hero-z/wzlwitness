

<?php $__env->startSection('content'); ?>
    <?php if($code=="6001"): ?>
        <div class="am-message result">
            <i class="am-icon result error"></i>
            <div class="am-message-main">失败</div>
            <div class="am-message-sub">已经取消订单付款</div>
        </div>
    <?php else: ?>
        <div class="am-message result">
            <i class="am-icon result error"></i>
            <div class="am-message-main">失败</div>
            <div class="am-message-sub">交易失败请重新付款</div>
        </div>
    <?php endif; ?>
    <?php $__currentLoopData = $ad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if($v->type=="alipay"&&$v->position==0): ?>
                <div class="am-message-main"><a href="<?php echo e($v->url); ?>"><img src="<?php echo e($v->pic); ?>" style="box-sizing: border-box; max-width: 100%; height:auto;  vertical-align: middle;border: 0;"></a></div>
            <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.antui', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>