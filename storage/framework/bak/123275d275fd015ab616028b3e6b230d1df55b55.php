
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="<?php echo e(route("pinganSearch")); ?>" method="post">
            <div class="col-sm-3">
                <div class="input-group">
                    <input placeholder="请输入商户简称" class="input-sm form-control" type="text" name="shopname"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                </div>
            </div>
            <?php echo e(csrf_field()); ?>

        </form>
        <a href="<?php echo e(route('PingAnStoreAdd')); ?>">
            <button class="btn btn-success " type="button"><span class="bold">添加商户</span></button>
        </a>
        <a href="<?php echo e(route("pinganRestore")); ?>"> <button type="button" class="btn btn-outline btn-default">还原商户</button></a>

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>门店列表</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>商户id</th>
                                  
                                    <th>商户简称</th>
                                    <th>联系人名称</th>
                                    <th>联系人手机号</th>
                                    <th>费率</th>
                                    <th>归属员工</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->external_id); ?></td>
                                            <td><span class="pie"><?php echo e($v->alias_name); ?></span></td>
                                            <td><?php echo e($v->contact_name); ?></td>
                                            <td><span class="pie"><?php echo e($v->contact_mobile); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->merchant_rate); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->name); ?></span></td>
                                            <td>
                                                <a href="<?php echo e(url('admin/pingan/editPingan?id='.$v->id)); ?>">
                                                    <button  type="button" class="btn btn-outline btn-success">店铺信息</button>
                                                </a>
                                                <a href="<?php echo e(url('admin/pingan/setMerchantRate?id='.$v->id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-info">费率调整</button>
                                                </a>
                                                <a href="<?php echo e(url('admin/pingan/MerchantFile?id='.$v->external_id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-info">商户资料</button>
                                                </a>
                                                <a href="<?php echo e(url('admin/pingan/SetStore?id='.$v->id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-primary">收款设置
                                                    </button>
                                                </a>
                                                <?php if($v->pid==0): ?>
                                                <a href="<?php echo e(url('admin/pingan/BranchIndex?pid='.$v->id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-primary">分店管理
                                                    </button>
                                                </a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(url('admin/alipayopen/CashierIndex?store_id='.$v->external_id.'&store_name='.$v->alias_name)); ?>">
                                                    <button type="button" class="btn btn-outline btn-primary">收银员管理
                                                    </button>
                                                </a>
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
                                                <button onclick='del("<?php echo e($v->id); ?>")' type="button"
                                                        class="btn btn-outline btn-warning">删除
                                                </button>
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
                $.post("<?php echo e(route('DelPinanStore')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                        function (data) {
                            if(data.success){
                                window.location.href = "<?php echo e(route('PingAnStoreIndex')); ?>";
                            }else{
                                layer.msg("请先解除店铺绑定!")
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
                    $.post("<?php echo e(route('PayStatus')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id, type: type},
                            function (data) {
                                window.location.href = "<?php echo e(route('PingAnStoreIndex')); ?>";
                            }, "json");
                }, function () {

                });
            } else {
                //询问框
                layer.confirm('确定要开启此商户的收款功能', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post("<?php echo e(route('PayStatus')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id, type: type},
                            function (data) {
                                window.location.href = "<?php echo e(route('PingAnStoreIndex')); ?>";
                            }, "json");
                }, function () {

                });
            }

        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>