
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('restore'); ?>
    <div class="ibox-content">
        <form action="<?php echo e(route("wxRestoree")); ?>" method="post">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>店铺ID</th>
                        <th>店铺名称</th>
                        <th>商户号</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td>
                                <div class="icheckbox_square-green"><input type="checkbox"  name="data[]" value="<?php echo e($v->id); ?>"></div>
                            </td>
                            <td><?php echo e($v->store_id); ?></td>
                            <td><?php echo e($v->store_name); ?></td>
                            <td><?php echo e($v->mch_id); ?></td>
                            <td><?php echo e($v->created_at); ?></td>
                            <td>
                                <a href="<?php echo e(url('/admin/weixin/wxRestoreee?id='.$v->id)); ?>"> <button class="btn btn-primary" type="button">还原</button></a>
                                <button onclick='del("<?php echo e($v->id); ?>")' class="btn btn-danger" type="button">彻底删除</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit">还原选中</button>
                <ul class="am-pagination pull-right" style="margin-top:-20px;">
                    <?php echo e($data->links()); ?>

                </ul>
            </div>
            <?php echo e(csrf_field()); ?>

        </form>
    </div>
    <script type="text/javascript">
        function del(id) {
            //询问框
            // alert(id);
            layer.confirm('确定要彻底删除', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.get("<?php echo e(route('deleteWx')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                        function (data) {
                            if(data.success){
                                window.location.href = "<?php echo e(Route('wxRestore')); ?>";
                            }else{
                                layer.msg("删除失败")
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