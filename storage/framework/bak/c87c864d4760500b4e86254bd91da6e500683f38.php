
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>广告列表</h5>
                    </div>

                    <div class="col-sm-3">
                        <a href="<?php echo e(route('addAd')); ?>"  class="btn btn-sm btn-success" style="color:white;">添加广告</a>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>图片</th>
                                    <th>类型</th>
                                    <th>描述</th>
                                    <th>位置</th>
                                    <th>广告链接</th>
                                    <th>状态</th>
                                    <th>开始时间</th>
                                    <th>结束时间</th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr>
                                        <td><span class="pie"><?php echo e($v->id); ?></span></td>
                                        <td><span class="pie"><img src="<?php echo e(url($v->pic)); ?>" style="width:100px; height:100px"></span></td>
                                        <td><span class="pie"><?php echo e($v->type); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->content); ?></span></td>
                                        <?php if($v->position==1): ?>
                                        <td><span class="pie">支付成功页</span></td>
                                        <?php endif; ?>
                                        <?php if($v->position==0): ?>
                                            <td><span class="pie">支付失败页</span></td>
                                        <?php endif; ?>
                                        <td><span class="pie"><?php echo e($v->url); ?></span></td>
                                        <?php if($v->status==1): ?>
                                        <td><span class="pie">启用中</span></td>
                                        <?php endif; ?>
                                        <?php if($v->status==0): ?>
                                            <td><span class="pie">下线中</span></td>
                                        <?php endif; ?>
                                        <td><span class="pie"><?php echo e($v->time_start); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->time_end); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->created_at); ?></span></td>
                                        <td><span class="pie"><?php echo e($v->updated_at); ?></span></td>
                                        <th>
                                            <button type="button" class="btn btn-info" type="del" onclick="del(<?php echo e($v->id); ?>)">删除</button>
                                            <a href="<?php echo e(url('/admin/ad/editAd?id='.$v->id)); ?>">
                                                <button type="button" class="btn">修改</button>
                                            </a>
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
                $.get("<?php echo e(route('deleteAd')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                        function (data) {
                            if(data.success){
                                window.location.href = "<?php echo e(Route('adIndex')); ?>";
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