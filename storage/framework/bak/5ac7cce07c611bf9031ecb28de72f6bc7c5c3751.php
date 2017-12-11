
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <?php if (\Entrust::can("addRole")) : ?>
                <a href="<?php echo e(url('/admin/alipayopen/role/create')); ?>">
                    <button type="button" class="btn btn-primary" id="showtoast">添加角色</button>
                </a>
                <?php endif; // Entrust::can ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>角色列表</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped" style="Word-break: break-all;">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>角色名称</th>
                                    <th>角色说明</th>
                                    <th>角色描述</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><?php echo e($v->id); ?></td>
                                        <td><span class="pie"><?php echo e($v->name); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->display_name); ?></span></td>
                                        <td><?php echo e($v->description); ?></td>
                                        <td><span class="pie"><?php echo e($v->created_at); ?></span></td>
                                        <td>
                                            <a href="<?php echo e(url('admin/alipayopen/assignment?role_id='.$v->id)); ?>">
                                                <button type="button" class="btn btn-outline btn-info">权限分配</button>
                                            </a>
                                            <?php if($v->name!="admin"): ?>
                                                <?php if (\Entrust::can("deleteRole")) : ?>
                                                <button type="button" onclick='del("<?php echo e($v->id); ?>")'
                                                        class="btn btn-outline btn-danger">删除
                                                </button>
                                                <?php endif; // Entrust::can ?>
                                            <?php endif; ?>
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
                                <?php echo e($data->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function del(id) {
            //询问框
            layer.confirm('你真的要删除这个重要的数据？', {
                btn: ['删除', '不删除'] //按钮
            }, function () {
                $.post("<?php echo e(route('delRole')); ?>", {role_id: id, _token: "<?php echo e(csrf_token()); ?>"}, function (result) {
                    if (result.status == 1) {
                        layer.msg('删除成功', {icon: 6});
                    } else {
                        layer.msg('删除失败,请检查权限', {icon: 5});
                    }
                    window.location.href = "<?php echo e(url('/admin/alipayopen/role')); ?>";

                }, 'json');
            }, function () {

            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>