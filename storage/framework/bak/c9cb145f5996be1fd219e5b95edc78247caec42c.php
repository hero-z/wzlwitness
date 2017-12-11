
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo e($store_name); ?>收银员列表</h5>
                    </div>
                    <div class="col-sm-3">
                        <a href="<?php echo e(url('/admin/alipayopen/CashierAdd?store_id='.$_GET['store_id'].'&store_name='.$_GET['store_name'])); ?>"
                           class="btn btn-sm btn-primary">添加收银员</a>
                        <a href=""
                           class="btn btn-sm btn-primary">绑定收银员</a>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>收银员名称</th>
                                    <th>手机号码</th>
                                    <th>创建时间</th>
                                    <th>类型</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->id); ?></td>
                                            <td><?php echo e($v->name); ?></td>
                                            <td><?php echo e($v->phone); ?></td>
                                            <td><span class="pie"><?php echo e($v->created_at); ?></span></td>
                                            <?php if($v->pid==0&&$v->type==0): ?>
                                                <td>管理员</td>
                                            <?php endif; ?>
                                            <?php if($v->pid!=0&&$v->type==0): ?>
                                                <td>店长</td>
                                            <?php endif; ?>
                                            <?php if($v->pid!=0&&$v->type!=0): ?>
                                                <td>收银员</td>
                                            <?php endif; ?>
                                            <td>
                                                <?php if($v->store_type=="oalipay"): ?>
                                                    <a href="<?php echo e(url('/admin/alipayopen/onlyskm?store_id='.$v->store_id.'&merchant_id='.$v->id)); ?>">
                                                        <button type="button" class="btn  btn-success">收款码</button>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if($v->store_type=="pingan"): ?>
                                                    <a href="<?php echo e(url('/admin/alipayopen/pinganCashierQr?store_id='.$v->store_id.'&merchant_id='.$v->id)); ?>">
                                                        <button type="button" class="btn  btn-success">收款码</button>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if($v->store_type=="weixin"): ?>
                                                    <a href="<?php echo e(url('/admin/weixin/WxPayQr?store_id='.$v->store_id.'&merchant_id='.$v->id)); ?>">
                                                        <button type="button" class="btn  btn-success">收款码</button>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="">
                                                    <button type="button" class="btn btn-outline btn-info">修改</button>
                                                </a>
                                                <a href="">
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