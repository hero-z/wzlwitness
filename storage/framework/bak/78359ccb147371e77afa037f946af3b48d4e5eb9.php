
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <?php if (\Entrust::can("addAlipayWeixin")) : ?>
        <a href="<?php echo e(route('addAliPayWeixinStore')); ?>">
            <button class="btn btn-success " type="button"><span class="bold">添加合成二维码</span></button>
        </a>
        <?php endif; // Entrust::can ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>多码合一商户</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>店铺名称</th>
                                    <th>支付宝店铺ID</th>
                                    <th>微信店铺ID</th>
                                    <th>京东店铺ID</th>
                                    <th>翼支付店铺ID</th>
                                    <th>支付宝通道</th>
                                    <th>微信通道</th>
                                    <th>京东通道</th>
                                    <th>翼支付</th>
                                    <th>合成时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->id); ?></td>
                                            <td><?php echo e($v->store_name); ?></td>
                                            <td><?php echo e($v->store_id_a); ?></td>
                                            <td><?php echo e($v->store_id_w); ?></td>
                                            <td><?php echo e($v->store_id_j); ?></td>
                                            <td><?php echo e($v->store_id_b); ?></td>
                                            <td>
                                            <?php if($v->alipay_ways=="oalipay"): ?>
                                            支付宝当面付
                                            <?php endif; ?>
                                            <?php if($v->alipay_ways=="salipay"): ?>
                                                支付宝口碑
                                            <?php endif; ?>
                                            <?php if($v->alipay_ways=="palipay"): ?>
                                                平安银行支付宝
                                            <?php endif; ?>
                                                <?php if($v->alipay_ways=="pfalipay"): ?>
                                               浦发银行支付宝
                                             <?php endif; ?>
                                            </td>
                                            <td>
                                            <?php if($v->weixin_ways=="weixin"): ?>
                                                微信官方
                                            <?php endif; ?>
                                            <?php if($v->weixin_ways=="pweixin"): ?>
                                                平安银行微信
                                                <?php endif; ?>
                                                <?php if($v->weixin_ways=="pfweixin"): ?>
                                                浦发银行微信
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($v->jd_ways=="pjd"): ?>
                                                    平安京东
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($v->bestpay_ways=="pbestpay"): ?>
                                                    平安翼支付
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($v->created_at); ?></td>
                                            <td>
                                                <a href="<?php echo e(url('/admin/alipayweixin/qrCode?id='.$v->id)); ?>">
                                                    <button type="button" class="btn  btn-success">收款码</button>
                                                </a>
                                                <?php if (\Entrust::can("alipayWeixinDelete")) : ?>
                                                <button type="button" onclick='del("<?php echo e($v->id); ?>")'
                                                        class="btn btn-outline btn-danger">删除
                                                </button>
                                                <?php endif; // Entrust::can ?>
                                                <?php if (\Entrust::can("alipayweixinEdit")) : ?>
                                                <a href="<?php echo e(url("/admin/alipayweixin/editAddTwo?id=".$v->id)); ?>">
                                                <button type="button" class="btn am-btn-secondary">修改</button>
                                                 </a>
                                                <?php endif; // Entrust::can ?>
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
                                    <?php echo e($paginator->render()); ?>

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
                $.post("<?php echo e(route('delAlipayWexin')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                        function (data) {
                            window.location.href = "<?php echo e(route('AlipayWexinLists')); ?>";
                        }, 'json');
            }, function () {

            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>