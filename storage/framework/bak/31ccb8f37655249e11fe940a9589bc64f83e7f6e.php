
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>角色对应权限表</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="<?php echo e(url('admin/alipayopen/assignmentpost')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="role_id" value="<?php echo $_GET['role_id']?>">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">角色</label>
                                <div class="col-sm-10">
                                    <h4><?php echo e($role->display_name); ?></h4>(<?php echo e($role->name); ?>)
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">权限列表</label>
                                <div class="col-sm-10">
                                    <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <label class="checkbox-inline">
                                            <input value="<?php echo e($v->id); ?>" <?php if(in_array($v->id,$p_id)): ?> checked
                                                   <?php endif; ?> id="inlineCheckbox1" name="<?php echo e($v->name); ?>"
                                                   type="checkbox">
                                            <strong> <?php echo e($v->display_name); ?></strong>(<?php echo e($v->name); ?>)
                                        </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </div>
                            </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-3">
                                        <button class="btn btn-primary" type="submit">提交</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>