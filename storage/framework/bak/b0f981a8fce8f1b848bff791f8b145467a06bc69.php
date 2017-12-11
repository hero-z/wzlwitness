
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>收银员统一管理</h5>
                    </div>
                    <form action="<?php echo e(route('mmdatalists')); ?>" method="get" >
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input placeholder="请输入收银员名称" class="input-sm form-control" name="merchant" type="text"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                        </div>
                    </div>
                    </form>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>收银员ID</th>
                                    <th>姓名</th>
                                    <th>手机号</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($data): ?>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v['id']); ?></td>
                                            <td><?php echo e($v['name']); ?></td>
                                            <td><?php echo e($v['phone']); ?></td>
                                            <td>
                                                <a href="<?php echo e(url('/admin/alipayopen/merchantshoplist?id='.$v['id'])); ?>">
                                                    <button class="btn btn-info " type="button"><i class="fa fa-paste"></i>店铺绑定</button>
                                                </a>
                                                <a href="<?php echo e(url('/admin/alipayopen/editMerchantNames?id='.$v['id'])); ?>">
                                                    <button class="btn btn-info " type="button"><i class="fa  fa-pencil-square"></i>修改</button>
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