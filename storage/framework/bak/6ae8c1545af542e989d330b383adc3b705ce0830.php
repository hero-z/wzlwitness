
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('restore'); ?>
    <div class="ibox-content">
        <div class="row">
          <form action="<?php echo e(route('restoreSearch')); ?>" method="post">
            <div class="col-sm-3">
                <div class="input-group">
                    <input placeholder="请输入店铺名称" class="input-sm form-control" type="text" name="shopname"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                </div>
            </div>
              <?php echo e(csrf_field()); ?>

          </form>
        </div>
        <form action="<?php echo e(route("restore")); ?>" method="post">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>店铺id</th>
                    <th>店铺名称</th>
                    <th>联系电话</th>
                    <th>授权时间</th>
                    <th>更新时间</th>
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
                    <td><?php echo e($v->store_id); ?></td>
                    <td><?php echo e($v->auth_shop_name); ?></td>
                    <td><?php echo e($v->auth_phone); ?></td>
                    <td><?php echo e($v->created_at); ?></td>
                    <td><?php echo e($v->updated_at); ?></td>
                    <td><?php echo e($v->name); ?></td>
                    <td><a href="<?php echo e(url('/admin/alipayopen/restoree?id='.$v->id)); ?>"> <button class="btn btn-primary" type="button">还原</button></a>
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