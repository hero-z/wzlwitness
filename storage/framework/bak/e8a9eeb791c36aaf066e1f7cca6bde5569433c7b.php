
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo e($store_name); ?>分店列表</h5>
                    </div>
                    <a href="<?php echo e(url('/admin/weixin/BwRestore?pid='.$_GET['pid'])); ?>"  class="btn btn-sm btn-danger" style="color:white;">还原</a>
                    <a href="<?php echo e(url('/admin/weixin/BranchAdd?pid='.$_GET['pid'])); ?>">
                        <button class="btn btn-success " type="button"><span class="bold">添加分店</span></button>
                    </a>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>店铺ID</th>
                                    <th>店铺名称</th>
                                    <th>商户号</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v['store_id']); ?></td>
                                            <td><?php echo e($v['store_name']); ?></td>
                                            <td><?php echo e($v['mch_id']); ?></td>
                                            <td><?php echo e($v['created_at']); ?></td>
                                            <td>
                                                <a href="<?php echo e(url('/admin/weixin/WxEditShop?id='.$v['id'])); ?>">
                                                    <button class="btn btn-info " type="button"><i
                                                                class="fa fa-paste"></i>编辑
                                                    </button>
                                                </a>
                                                <a class="btn btn-success"
                                                   href="<?php echo e(url('admin/weixin/WxPayQr?store_id='.$v['store_id'])); ?>">
                                                    <i class="fa fa-weixin"> </i> 收款码
                                                </a>
                                                <a href="<?php echo e(url("/admin/weixin/wxChangeStatus?id=".$v['id'])); ?>"><button class="btn btn-success" type="button">删除</button></a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>