
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>添加分店</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo e(url('admin/alipayopen/AlipayBranchAddPost')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" id="pid" name="pid" value="<?php echo $_GET['pid']?>">
                            <input type="hidden" name="store_id" value="<?php echo 'o' . date('Ymdhis', time()) . rand(10000, 99999);?>">
                            <div class="form-group">
                                <label>分店名称</label>
                                <input class="form-control" type="text" value="" required="required"
                                       name="auth_shop_name" id="auth_shop_name">
                            </div>
                            <?php if($errors->has('auth_shop_name')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('auth_shop_name')); ?></strong>
                                    </span>
                            <?php endif; ?>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>联系方式:</label>
                                <input class="form-control" type="text" value="" required="required" name="auth_phone"
                                       id="auth_phone">
                            </div>
                            <?php if($errors->has('auth_phone')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('auth_phone')); ?></strong>
                                    </span>
                            <?php endif; ?>
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
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>