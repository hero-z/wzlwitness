
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <a href="<?php echo e(route('WechatMenuAdd')); ?>">
            <button class="btn btn-success " type="button"><span class="bold">添加菜单</span></button>
        </a>
        <a href="javascript:" onclick="postcreate()">
            <button class="btn btn-warning " type="button"><span class="bold">生成菜单</span></button>
        </a>
        <a href="<?php echo e(route('WechatMenuSet')); ?>">
            <button class="btn btn-primary " type="button"><span class="bold">微信菜单配置</span></button>
        </a>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>一级菜单</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>名称</th>
                                    <th>菜单类型</th>
                                    <th>链接</th>
                                    <th>状态</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->name); ?></td>
                                            <td><?php echo e($v->type); ?></td>
                                            <td><?php echo e($v->url); ?></td>
                                            <?php if($v->status==1): ?>
                                                <td>
                                                    <button type="button" class="btn  btn-success">启用中</button>
                                                </td>
                                            <?php endif; ?>
                                            <?php if($v->status==2): ?>
                                                <td>
                                                    <button type="button" class="btn  btn-danger">已禁用</button>
                                                </td>
                                            <?php endif; ?>
                                            <td><?php echo e($v->updated_at); ?></td>
                                            <td>
                                                <button type="button" onclick='del("<?php echo e($v->id); ?>")'
                                                        class="btn btn-outline btn-danger">删除
                                                </button>
                                                <a href="<?php echo e(route("WechatMenuEdit",['id'=>$v->id])); ?>">
                                                <button type="button" class="btn btn-primary">修改</button>
                                                 </a>
                                                <a href="<?php echo e(route("WxAppMenuSubList",['id'=>$v->id])); ?>">
                                                    <button type="button" class="btn btn-success">管理子菜单</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers"
                                     id="DataTables_Table_0_paginate">
                                    <?php echo e($datapage->links()); ?>

                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                            没有记录

                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function del(id) {
            layer.confirm('确定删除', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post("<?php echo e(route('WechatMenuDel')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id ,type:1},
                        function (data) {
                            if (data.success==1) {
                                window.location.href = "<?php echo e(route('WxAppMenuList')); ?>";
                            } else {
                                layer.msg(data.errmsg);
                            }
                        }, 'json');
            }, function () {

            });
        }
        function postcreate() {
            layer.confirm('请确认配置后再生成菜单!操作后之前菜单失效', {
                btn: ['确认', '取消'] //按钮
            }, function () {
                $.post("<?php echo e(route('WxAppMenu')); ?>", {_token: "<?php echo e(csrf_token()); ?>"},
                        function (data) {
                            if (data.success==1) {
                                window.location.href = "<?php echo e(route('WxAppMenuList')); ?>";
                            } else {
                                layer.msg(data.errmsg);
                            }
                        }, 'json');
            }, function () {

            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>