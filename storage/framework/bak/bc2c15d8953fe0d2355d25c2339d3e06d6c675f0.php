
<?php $__env->startSection('content'); ?>

    <div style="text-align: center">
        <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(500)->generate($code_url)); ?> ">
        <p><?php echo e($shop->store_name); ?>-微信收款码<?php if($merchant_name): ?>(<?php echo e($merchant_name); ?>)<?php endif; ?></p>
    </div>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>收款码说明</h5>
            </div>
            <div class="ibox-content">
                <div class="well well-lg">

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>