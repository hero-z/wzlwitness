
<?php $__env->startSection('content'); ?>
    <div class="col-sm-12">
        <a  href="<?php echo e(url('/register')); ?>">
            <button type="button" class="btn btn-w-m btn-success">添加员工</button>
        </a>
        <a href="<?php echo e(route("changeShopOwner")); ?>">
            <button type="button" class="btn btn-primary  btn-w-m">员工店铺转移</button>
        </a>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>员工列表</h5>
            </div>
            <div class="ibox-content">

                <table class="table" style="Word-break: break-all;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>用户</th>
                        <th>电话</th>
                        <th>邮箱</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td><?php echo e($v['id']); ?></td>
                            <td><?php echo e($v['name']); ?></td>
                            <td><?php echo e($v['phone']); ?></td>
                            <td><?php echo e($v['email']); ?></td>
                            <td><?php echo e($v['created_at']); ?></td>
                            <td>
                                <button onclick="updateu('<?php echo e($v['id']); ?>')" type="button"
                                        class="btn btn-primary btn-rounded">修改
                                </button>
                                <a class="btn btn-info btn-rounded"
                                   href="<?php echo e(url('admin/alipayopen/setRole?user_id='.$v['id'])); ?>">角色</a>
                                <?php if (\Entrust::hasRole('user')) : ?>
                                    <button type="button" onclick="deleteu('<?php echo e($v['id']); ?>')"
                                            class="btn btn-danger btn-rounded">删除
                                    </button>
                                <?php endif; // Entrust::hasRole ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="dataTables_paginate paging_simple_numbers"
                     id="DataTables_Table_0_paginate">
                    <?php echo e($paginator->render()); ?>

                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function updateu(id) {
            window.location.href = "/admin/alipayopen/updateu?id=" + id;
        }

        function deleteu(id) {
            layer.confirm('数据价值很重要！确定要删除用户信息？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post("<?php echo e(route('deleteu')); ?>", {id: id, _token: "<?php echo e(csrf_token()); ?>"}, function (result) {
                    window.location.href = "<?php echo e(route('users')); ?>";
                });
            }, function () {

            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>