
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>U印智能云设备列表</h5>
                    </div>

                    <div class="col-sm-3">
                        <?php if (\Entrust::can("addMerchine")) : ?>
                        <a href="<?php echo e(route('addUprint')); ?>"  class="btn btn-sm btn-success" style="color:white;">添加设备</a>
                        <?php endif; // Entrust::can ?>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>设备名称</th>
                                    <th>绑定店铺id</th>
                                    <th>绑定店铺名称</th>
                                    <th>机器号</th>
                                    <th>密钥</th>
                                    <th>打印张数</th>
                                    <th>二维码链接</th>
                                    <th>手机号</th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><span class="pie"><?php echo e($v->mname); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->store_id); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->store_name); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->machine_code); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->msign); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->number); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->code); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->phone); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->created_at); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->updated_at); ?></span></td>
                                        <th>
                                            <?php if (\Entrust::can("deleteMerchine")) : ?>
                                            <button type="button" class="btn btn-info" type="del" onclick="del(<?php echo e($v->id); ?>)">删除</button>
                                            <?php endif; // Entrust::can ?>
                                            <?php if (\Entrust::can("editMerchine")) : ?>
                                            <a href="<?php echo e(url('/admin/ticket/editUprint?id='.$v->id)); ?>">
                                                <button type="button" class="btn">修改</button>
                                            </a>
                                            <?php endif; // Entrust::can ?>
                                        </th>
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


                                <?php echo e($list->links()); ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        function del(id) {
            //询问框
            // alert(id);
            layer.confirm('确定要删除吗?', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.get("<?php echo e(route('deleteUprint')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                        function (data) {
                            if(data.success){
                                window.location.href = "<?php echo e(Route('UprintIndex')); ?>";
                            }else{
                                layer.msg("删除失败，请检查是否有权限")
                            }

                        }, "json");
            }, function () {

            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>