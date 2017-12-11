
<?php $__env->startSection('content'); ?>

    <div style="text-align: center">
        <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(500)->generate($code_url)); ?> ">
        <p><?php echo e($store_name); ?>-收款</p>
    </div>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>多码合一</h5>
            </div>
            <div class="ibox-content">
                <div class="well well-lg">
                    请服务商先测试是否可用！
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>