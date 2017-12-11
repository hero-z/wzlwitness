
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>商户第三方门店授权</h5>
                    </div>
                    <form action="<?php echo e(route("oauthSearch")); ?>" method="post">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input placeholder="请输入店铺名称" class="input-sm form-control" type="text" name="shopname"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                        </div>
                    </div>
                        <?php echo e(csrf_field()); ?>

                        </form>
                    <div class="col-sm-3">
                        <a href="<?php echo e(route("oauthRestore")); ?>"  class="btn btn-sm btn-primary style="color:white;">还原</a>
                        </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
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
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->store_id); ?></td>
                                            <td><?php echo e($v->auth_shop_name); ?></td>
                                            <td><span class="pie"><?php echo e($v->auth_phone); ?></span></td>
                                            <td><?php echo e($v->created_at); ?></td>
                                            <td><?php echo e($v->updated_at); ?></td>
                                            <td><?php echo e($v->name); ?></td>
                                            <td>
                                                <a href="<?php echo e(url('/admin/alipayopen/store/create?app_auth_token='.$v->app_auth_token.'&promoter_id='.$v->promoter_id)); ?>">
                                                    <button type="button" class="btn  btn-success">口碑开店</button>
                                                </a>
                                                <a href="<?php echo e(url('/admin/alipayopen/onlyskm?store_id='.$v->store_id)); ?>">
                                                    <button type="button" class="btn  btn-success">收款码</button>
                                                </a>
                                                <?php if($v->pid==0): ?>
                                                <a href="<?php echo e(url('/admin/alipayopen/AlipayBranchIndex?pid='.$v->id)); ?>">
                                                    <button type="button" class="btn  btn-success">分店管理</button>
                                                </a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(url('admin/alipayopen/CashierIndex?store_id='.$v->store_id.'&store_name='.$v->auth_shop_name)); ?>">
                                                    <button type="button" class="btn  btn-success">收银员管理</button>
                                                </a>
                                                <a href="<?php echo e(url('/admin/alipayopen/updateOauthUser?id='.$v->id)); ?>">
                                                <button type="button" class="btn btn-outline btn-info">修改</button>
                                                 </a>
                                                <a href="<?php echo e(url('/admin/alipayopen/changeStatus?id='.$v->id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-info">删除</button>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>