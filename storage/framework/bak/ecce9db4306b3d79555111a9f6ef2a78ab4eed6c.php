
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('restore'); ?>
    <div class="ibox-content">
        <div class="row">
            <form action="<?php echo e(route('pinganRestoreSearch')); ?>" method="post">
                <div class="col-sm-3">
                    <div class="input-group">
                        <input placeholder="请输入商户简称" class="input-sm form-control" type="text" name="shopname"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                    </div>
                </div>
                <?php echo e(csrf_field()); ?>

            </form>
        </div>
        <form action="<?php echo e(route("pinganRestoree")); ?>" method="post">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>商户id</th>
                        <th>商户简称</th>
                        <th>联系人名称</th>
                        <th>联系人手机号</th>
                        <th>状态</th>
                        <th>归属员工</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td>
                                <div class="icheckbox_square-green"><input type="checkbox"  name="data[]" value="<?php echo e($v->id); ?>"></div>
                            </td>
                            <td><?php echo e($v['external_id']); ?></td>
                            
                            <td><span class="pie"><?php echo e($v['alias_name']); ?></span></td>
                            <td><?php echo e($v['contact_name']); ?></td>
                            <td><span class="pie"><?php echo e($v['contact_mobile']); ?></span></td>
                            <td><span class="pie"><?php echo e($v['status']); ?></span></td>
                            <td><span class="pie"><?php echo e($v['user_name']); ?></span></td>
                            <td><a href="<?php echo e(url('/admin/pingan/pinganRestoreee?id='.$v->id)); ?>"> <button class="btn btn-primary" type="button">还原</button></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit">还原选中</button>
                <ul class="am-pagination pull-right" style="margin-top:-20px;">
                    <?php echo e($data->links()); ?>

                </ul>
            </div>
            <?php echo e(csrf_field()); ?>

        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>