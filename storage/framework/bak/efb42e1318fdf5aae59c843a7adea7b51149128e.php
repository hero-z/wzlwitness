
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>修改收银员</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo e(route('updateMerchantNames')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" id="id" value="<?php echo $_GET['id']?>" name="id">
                            <?php if($errors->has('name')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">手机号</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="<?php echo e($list->phone); ?>" required>
                                        <span class="help-block">
                                        <strong><?php echo e(session("warnning")); ?></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <?php if($errors->has('phone')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                            <?php endif; ?>
                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                                <label for="password-confirm" class="col-md-4 control-label">确认密码</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password"  class="form-control" name="password_confirmation">

                                    <?php if($errors->has('password_confirmation')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                            type="submit">
                                        <strong>保存</strong>
                                    </button>
                                </div>
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