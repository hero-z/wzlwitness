
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <a href="<?php echo e(url('admin/alipayopen/merchantshopbind?id='.$id)); ?>"><button class="btn btn-success " type="button"><span class="bold">绑定店铺</span></button></a>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>用户店铺</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>店铺ID</th>
                                    <th>店铺名</th>
                                    <th>备注</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($data): ?>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr id="<?php echo e($v['store_id']); ?>">
                                            <td><?php echo e($v['store_id']); ?></td>
                                            <td><?php echo e($v['store_name']); ?></td>
                                            <td><?php echo e($v['desc_pay']); ?></td>
                                            <td><button class="btn btn-danger " onclick="fun('<?php echo e($v['store_id']); ?>')" type="button"><span class="bold">解除绑定</span></button></td>
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
        <script type="text/javascript">
            function fun($id) {
                //询问框
                layer.confirm('确定要解绑吗?解绑后商铺无法完成支付', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post("<?php echo e(route('mmshopdelpost')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id:$id},
                            function (data) {
                                if(data!=1){
                                    alert(data);
                                }else{
                                    $('#'+$id).remove();
                                }
                                window.location.href = "<?php echo e(url('admin/alipayopen/merchantshoplist?id=').$id); ?>";
                            }, "json");
                }, function () {

                });
            }

        </script>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>