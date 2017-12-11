
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>门店列表</h5>
                    </div>
                    <form action="" method="">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input placeholder="请输入商户简称" class="input-sm form-control" type="text" name="store_name"
                                       value="<?php if (isset($where['store_name'])) echo $where['store_name']; ?>"> <span
                                        class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </form>
                <!--         <a href="<?php echo e(route('PingAnStoreAdd')); ?>">
            <button class="btn btn-success " type="button"><span class="bold">添加商户</span></button>
        </a>
        <a href="<?php echo e(route("pinganRestore")); ?>">
            <button type="button" class="btn btn-outline btn-default">还原商户</button>
        </a> -->
                    <?php if (\Entrust::can("pufaCode")) : ?>
                    <a class="J_menuItem" href="<?php echo e(route('PFQrLists')); ?>"><button type="button" class="btn btn-outline btn-default">我的商户码</button></a>
                    <?php endif; // Entrust::can ?>
                    <a class="J_menuItem" href="<?php echo e(route('storelist')); ?>"><button type="button" class="btn btn-outline btn-default">商户列表</button></a>
                    <a class="J_menuItem" href="<?php echo e(route('orderList')); ?>"><button type="button" class="btn btn-outline btn-default">商户流水</button></a>
                    <?php if (\Entrust::can("pufaConfig")) : ?>
                    <a class="J_menuItem" href="<?php echo e(route('pufaConfig')); ?>"><button type="button" class="btn btn-outline btn-default">浦发银行通道配置</button></a>
                    <?php endif; // Entrust::can ?>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>商户id</th>
                                    <th>浦发商户号</th>
                                     <th>商户全称</th> 
                                     <th>商户简称</th> 
                                    <th>联系人名称</th>
                                    <th>联系人手机号</th>
                                    <!-- <th>费率</th> -->
                                    <th>推广员</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->store_id); ?></td>
                                            <td><?php echo e($v->merchant_id); ?></td>
                                            <td><span class="pie"><?php echo e($v->store_name); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->merchant_short_name); ?></span></td>
                                            <td><?php echo e($v->shop_user); ?></td>
                                            <td><span class="pie"><?php echo e($v->tel); ?></span></td>
                                            <!-- <td><span class="pie"><?php echo e($v->address); ?></span></td> -->
                                            <td><span class="pie">
                                                <?php if(isset($allrecommender[$v->user_id])) echo $allrecommender[$v->user_id]; else echo '无'; ?>
                                            </span></td>
                                            <td>
                                                <?php if (\Entrust::can("pufaStoreInfo")) : ?>
                                                <a href="<?php echo e(url('admin/pufa/storeEdit?store_id='.$v->store_id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-success">店铺信息
                                                    </button>
                                                </a>
                                                <?php endif; // Entrust::can ?>
                                                <?php if (\Entrust::can("pufaBranch")) : ?>
                                                <a href="<?php echo e(url('admin/pufa/branchStore?pid='.$v->id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-success">分店管理
                                                    </button>
                                                </a>
                                                <?php endif; // Entrust::can ?>
                                                <?php if (\Entrust::can("pufaCashier")) : ?>
                                                <a href="<?php echo e(url('admin/alipayopen/CashierIndex?store_id='.$v->store_id.'&store_name='.$v->store_name)); ?>">
                                                    <button type="button" class="btn btn-outline btn-success">收银员管理
                                                    </button>
                                                </a>
                                                <?php endif; // Entrust::can ?>
                                            <!--                                                 <button onclick='del("<?php echo e($v->id); ?>")' type="button"
                                                        class="btn btn-outline btn-warning">删除
                                                </button> -->
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
                $.post("<?php echo e(route('storeDel')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                    function (data) {
                        if (data.success) {
                            window.location.href = "<?php echo e(route('PingAnStoreIndex')); ?>";
                        } else {
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