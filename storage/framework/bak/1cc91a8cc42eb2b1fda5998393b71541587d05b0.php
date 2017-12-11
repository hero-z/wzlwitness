
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>门店列表</h5>
                    </div>
                    <form action="" method="post">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input placeholder="请输入商户简称" class="input-sm form-control" type="text" name="shopname"> <span
                                        class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </form>
                    <?php if (\Entrust::can("addUnionpayStore")) : ?>
                    <a href="">
                        <button class="btn btn-success " type="button"><span class="bold">添加商户</span></button>
                    </a>
                    <?php endif; // Entrust::can ?>
                    <?php if (\Entrust::can("unionpayRestore")) : ?>
                    <a href="<?php echo e(route("unionRestoreIndex")); ?>">
                        <button type="button" class="btn btn-outline btn-default">还原商户</button>
                    </a>
                    <?php endif; // Entrust::can ?>
                    <a class="J_menuItem" href="<?php echo e(route('unionPayBill')); ?>">
                        <button type="button" class="btn btn-outline btn-default">商户流水</button>
                    </a>
                    <?php if (\Entrust::can('unionpaySet')) : ?>
                    <a class="J_menuItem" href="<?php echo e(route('UnionPaySet')); ?>">
                        <button type="button" class="btn btn-outline btn-default">银行通道配置</button>
                    </a>
                    <?php endif; // Entrust::can ?>

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>门店id</th>
                                    <th>商户简称</th>
                                    <th>联系人名称</th>
                                    <th>联系人手机号</th>
                                    <th>归属员工</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($store): ?>
                                    <?php $__currentLoopData = $store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->store_id); ?></td>
                                            <td><span class="pie"><?php echo e($v->alias_name); ?></span></td>
                                            <td><?php echo e($v->manager); ?></td>
                                            <td><span class="pie"><?php echo e($v->manager_phone); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->name); ?></span></td>
                                            <td>
                                                <?php if (\Entrust::can("unionpayStoreInfo")) : ?>
                                                <a href="<?php echo e(url('/admin/UnionPay/unionpayInfo?id='.$v->id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-info">商户资料</button>
                                                </a>
                                                <?php endif; // Entrust::can ?>
                                                <?php if (\Entrust::can("setUnionpayCard")) : ?>
                                                <a href="<?php echo e(url('/admin/UnionPay/setUnionPayCard?store_id='.$v->store_id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-primary">收款设置
                                                    </button>
                                                </a>
                                                <?php endif; // Entrust::can ?>
                                                <?php if (\Entrust::can("UnionPayBranch")) : ?>
                                                    <a href="<?php echo e(url('/admin/UnionPay/BranchIndex?pid='.$v->id)); ?>">
                                                        <button type="button" class="btn btn-outline btn-primary">分店管理
                                                        </button>
                                                    </a>
                                                <?php endif; // Entrust::can ?>
                                                <a href="<?php echo e(url('admin/alipayopen/CashierIndex?store_id='.$v->store_id.'&store_name='.$v->alias_name)); ?>">
                                                    <button type="button" class="btn btn-outline btn-primary">收银员管理
                                                    </button>
                                                </a>
                                                <?php if (\Entrust::can("unionpayOpen")) : ?>
                                                <?php if($v->pay_status==1): ?>
                                                    <button id="cpay" onclick='co("<?php echo e($v->id); ?>",0)' type="button"
                                                            class="btn btn-outline btn-warning">关闭收款
                                                    </button>
                                                <?php endif; ?>

                                                <?php if($v->pay_status==0): ?>
                                                    <button id="opay" onclick='co("<?php echo e($v->id); ?>",1)' type="button"
                                                            class="btn btn-outline btn-warning">开启收款
                                                    </button>
                                                <?php endif; ?>
                                                <?php endif; // Entrust::can ?>
                                                <?php if (\Entrust::can("changeUnionpay")) : ?>
                                                <button onclick='del("<?php echo e($v->id); ?>")' type="button"
                                                        class="btn btn-outline btn-warning">删除
                                                </button>
                                                <?php endif; // Entrust::can ?>
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
                                <?php echo e($store->links()); ?>

                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        没有任何记录
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function del(id) {
            //询问框
            layer.confirm('确定要删除', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post("<?php echo e(route('unionpayChangeStatus')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                    function (data) {
                        if (data.success) {
                            window.location.href = "<?php echo e(route('UnionPayStoreIndex')); ?>";
                        } else {
                            layer.msg("删除失败")
                        }
                    }, "json");
            }, function () {

            });
        }


        function co(id, type) {
            if (type == 0) {
                //询问框
                layer.confirm('确定要关闭此商户的收款功能', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post("<?php echo e(route('unionPayStatus')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id, type: type},
                        function (data) {
                            window.location.href = "<?php echo e(route('UnionPayStoreIndex')); ?>";
                        }, "json");
                }, function () {

                });
            } else {
                //询问框
                layer.confirm('确定要开启此商户的收款功能', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post("<?php echo e(route('unionPayStatus')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id, type: type},
                        function (data) {
                            window.location.href = "<?php echo e(route('UnionPayStoreIndex')); ?>";
                        }, "json");
                }, function () {

                });
            }

        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>