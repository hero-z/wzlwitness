
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
                    <form action="<?php echo e(route("storeSearch")); ?>" method="post">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input placeholder="请输入门店名称" class="input-sm form-control" type="text" name="shopname"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </form>
                        <a href="<?php echo e(route("restoreIndex")); ?>"  class="btn btn-sm btn-primary" style="color:white;">还原</a>
                        <a href="<?php echo e(route("addOldShop")); ?>"  class="btn btn-sm btn-primary" style="color:white;">添加已开口碑店铺</a>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>商户id</th>
                                    <th>企业名称</th>
                                    <th>门店名称</th>
                                    <th>地址</th>
                                    <th>联系方式</th>
                                    <th>归属员工</th>
                                    <th>状态</th>
                                    <th>操作</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->store_id); ?></td>
                                            <td><span class="pie"><?php echo e($v->licence_name); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->main_shop_name); ?></span></td>
                                            <td><?php echo e($v->address); ?></td>
                                            <td><span class="pie"><?php echo e($v->contact_number); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->name); ?></span></td>
                                            <?php if($v->apply_id==""): ?>
                                                <td>
                                                    <button type="button" class="btn btn-outline btn-warning">未提交到口碑
                                                    </button>
                                                </td>
                                            <?php endif; ?>
                                            <?php if($v->apply_id&&$v->audit_status==""): ?>
                                                <td>
                                                    <button type="button" class="btn btn-outline btn-warning">审核中
                                                    </button>
                                                </td>
                                            <?php endif; ?>
                                            <?php if($v->audit_status=='AUDITING'): ?>
                                                <td>
                                                    <button type="button" class="btn btn-outline btn-warning">审核中
                                                    </button>
                                                </td>
                                            <?php endif; ?>
                                            <?php if($v->audit_status=='AUDIT_FAILED'): ?>
                                                <td>
                                                    <button type="button" onclick="info('<?php echo e($v->store_id); ?>')"
                                                            class="btn btn-outline btn-danger">审核驳回
                                                    </button>
                                                </td>
                                            <?php endif; ?>

                                            <?php if($v->audit_status=='AUDIT_SUCCESS'): ?>
                                                <td>
                                                    <button type="button" class="btn btn-outline btn-success">开店成功
                                                    </button>
                                                </td>
                                            <?php endif; ?>
                                            <?php if($v->audit_status=='AUDIT_FAILED'||$v->apply_id==""): ?>
                                                <th>
                                                    <a href="<?php echo e('/admin/alipayopen/store/'.$v->id.'/edit'); ?>">
                                                        <button type="button" class="btn btn-info">重新提交</button>
                                                    </a>
                                                    
                                                    <a href="<?php echo e(url('/admin/alipayopen/storeChangeStatus?id='.$v->id)); ?>">
                                                        <button type="button" class="btn btn-info">删除</button>
                                                    </a>
                                                    <a href="<?php echo e(url('admin/alipayopen/editshoplists?id='.$v->id)); ?>">
                                                        <button type="button" class="btn">修改店铺名称</button>
                                                    </a>
                                                </th>
                                            <?php elseif($v->shop_id): ?>
                                                <th>
                                                    <a href="<?php echo e(url('admin/alipayopen/skm?id='.$v->id)); ?>">
                                                        <button type="button" class="btn btn-info">店铺收款码</button>
                                                    </a>
                                                    <a href="<?php echo e(url('/admin/alipayopen/storeChangeStatus?id='.$v->id)); ?>">
                                                        <button type="button" class="btn btn-info">删除</button>
                                                    </a>
                                                </th>
                                            <?php endif; ?>


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
        function info(store_id) {
            $.post("<?php echo e(route('shopNotify')); ?>", {store_id: store_id, _token: "<?php echo e(csrf_token()); ?>"},
                    function (data) {
                        alert(data.result_desc)
                    }, "json");
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>