
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>修改信息</h5>
            </div>
            <?php if(session('info')): ?>
            <span style="color:red"><?php echo e(session('info')); ?></span>
            <?php endif; ?>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo e(route("upWebank")); ?>" method="post">
                            <input type="hidden" id="store_id" value="<?php echo e($store_id); ?>" name="id">
                            <div class="form-group">
                                <label>店铺名称</label>
                                <input value="<?php echo e($name); ?>" disabled id="name" class="form-control"
                                       type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label>收款码编号<span style="color:red">(修改后,原收款码将作废)</span></label>
                                <?php if($qr): ?>
                                    <input value="<?php echo e($qr->code_number); ?>" id="code_number" class="form-control"
                                           type="text" name="code_number">
                                <?php else: ?>

                                    <input value="" id="code_number" class="form-control"
                                           type="text" name="code_number" placeholder="暂无收款码编号">
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>微信支付返回商户号<span style="color:red">(不可修改)</span></label>
                                <input value="<?php echo e($wb_merchant_id); ?>" id="" readonly class="form-control"
                                       type="text" name="">
                            </div>
                            <div class="form-group">
                                <label>商户公众号appid</label>
                                <?php if($store): ?>
                                    <input value="<?php echo e($store->wx_app_id); ?>" id="wx_app_id" class="form-control"
                                           type="text" name="wx_app_id">
                                <?php else: ?>

                                    <input value="" id="wx_app_id" class="form-control"
                                           type="text" name="wx_app_id" placeholder="">
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>商户公众号secret</label>
                                <?php if($store): ?>
                                    <input value="<?php echo e($store->wx_secret); ?>" id="wx_secret" class="form-control"
                                           type="text" name="wx_secret">
                                <?php else: ?>

                                    <input value="" id="wx_secret" class="form-control"
                                           type="text" name="wx_secret" placeholder="">
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="id" value="<?php echo e($qr->id); ?>">
                            <input type="hidden" name="store_id" value="<?php echo e($store_id); ?>">
                            <div class="hr-line-dashed"></div>
                            <div>
                                <button  class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                         type="submit">
                                    <strong>保存</strong>
                                </button>
                            </div>
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="con"></div>
    <?php if($code_number): ?>
        <div>
            <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(300)->generate(url('admin/webank/webankQrCode?code_number='.$code_number))); ?> ">
        </div>
    <?php endif; ?>
<?php $__env->startSection('js'); ?>
    

    
    
    
    
    
    
    
    
    
    
    

    
    

    
    
    
    
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>