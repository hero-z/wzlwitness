
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>修改配置信息</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo e(route('WxEditShopPost')); ?>" method="post">
                            <input type="hidden" name='id' value="<?php echo e($Shop->id); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>商户名称</label>
                                <input value="<?php echo e($Shop->store_name); ?>" id="store_name" required placeholder="请填写商户名称" class="form-control"
                                       name="store_name" type="text">
                            </div>
                            <?php if($errors->has('mch_id')): ?>
                                <span class="ui-icon-help">
                                        <strong><?php echo e($errors->first('mch_id')); ?></strong>
                                    </span>
                            <?php endif; ?>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>商户号</label>
                                <input id="mch_id"  value="<?php echo e($Shop->mch_id); ?>" required placeholder="请填写微信支付商户号" class="form-control" name="mch_id"
                                       type="text">
                            </div>
                            <?php if($errors->has('mch_id')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('mch_id')); ?></strong>
                                    </span>
                            <?php endif; ?>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>公众号</label>
                                <input id="app_id" value="<?php echo e($Shop->app_id); ?>" placeholder="请填写app_id" class="form-control" name="app_id"
                                       type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>机具信息</label>
                                <input id="device_info" value="<?php echo e($Shop->device_info); ?>" placeholder="请填写门店号或收银设备ID" class="form-control"
                                       name="device_info" type="text">
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="submit">
                                    <strong>保存</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="con"></div>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>