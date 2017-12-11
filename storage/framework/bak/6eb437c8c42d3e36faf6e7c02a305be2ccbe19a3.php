
<?php $__env->startSection('content'); ?>
    <div style="text-align: center">
        <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(500)->generate($code_url)); ?> ">
    <p><h3><?php echo e(\Illuminate\Support\Facades\Auth::user()->name); ?></h3>平安银行通道自助商户二维码</p>
    </div>

    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>平安银行通道-商户自助提交码</h5>
            </div>
            <div class="ibox-content">
                <div class="well">
                    <h3>
                        说明
                    </h3> 你可以把这个二维码打印出来商户用微信或者支付宝扫码提交资料
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>