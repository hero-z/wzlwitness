
<?php $__env->startSection('content'); ?>
    <div class="col-sm-12">
        <button type="button" onclick="qr()" class="btn btn-w-m btn-success">生成空码</button>
        
        <a href="<?php echo e(route("webankRestore")); ?>"> <button type="button" class="btn btn-outline btn-default">还原商户</button></a>
        <a class="J_menuItem" href="<?php echo e(route('webankorderlist')); ?>"> <button type="button" class="btn btn-outline btn-default">商户流水</button></a>
        <?php if (\Entrust::can('pinganconfig')) : ?>
        <a class="J_menuItem" href="<?php echo e(route('webankconfig')); ?>"> <button type="button" class="btn btn-outline btn-default">银行通道配置</button></a>
        <?php endif; // Entrust::can ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>微众二维码列表</h5>
            </div>
            <div class="ibox-content">

                <table class="table" style="Word-break: break-all;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>生成用户</th>
                        <th>收款类型</th>
                        <th>生成数量</th>
                        
                        <th>生成时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td><?php echo e($v->id); ?></td>
                            <td><?php echo e($v->name); ?></td>
                            <td>微众</td>
                            
                            <td><?php echo e($v->num); ?></td>
                            
                            <td><?php echo e($v->created_at); ?></td>
                            <td>
                                <a href="<?php echo e(route('webankdownloadqr',['cno'=>$v->cno])); ?>" target="_self">
                                    <button type="button"
                                            class="btn btn-primary btn-rounded">下载空码
                                    </button>
                                </a>

                            </td>
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
                    <?php echo e($lists->links()); ?>

                </div>
            </div>
        </div>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('js'); ?>
            <script>
                function qr() {
                    var index = layer.load(1, {
                        shade: [0.1, '#fff'] //0.1透明度的白色背景
                    });
                    $.post("<?php echo e(route('webankcreateqr')); ?>", {_token: "<?php echo e(csrf_token()); ?>"},
                            function (data) {
                                if (data.status == 1) {
                                    layer.confirm('生成二维码成功！', {
                                        btn: ['确定'] //按钮
                                    }, function () {
                                        window.location.href = "<?php echo e(route('webankqrlist')); ?>"
                                    });
                                } else {
                                    layer.msg(data.msg, {icon: 5});
                                }
                            }, "json");
                }
            </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>