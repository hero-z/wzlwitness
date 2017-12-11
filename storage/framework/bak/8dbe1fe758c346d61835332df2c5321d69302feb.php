
<?php $__env->startSection('content'); ?>
    <div class="col-sm-12">
        <button type="button" onclick="qr()" class="btn btn-w-m btn-success">生成空码</button>
        <a href="<?php echo e(route('PingAnStoreAdd')); ?>"><button class="btn btn-success " type="button"><span class="bold">添加商户</span></button></a>
        <a href="<?php echo e(route("pinganRestore")); ?>"> <button type="button" class="btn btn-outline btn-default">还原商户</button></a>
        <a class="J_menuItem" href="<?php echo e(route('PingAnOrderQuery')); ?>"> <button type="button" class="btn btn-outline btn-default">商户流水</button></a>
        <?php if (\Entrust::can('pinganconfig')) : ?>
        <a class="J_menuItem" href="<?php echo e(route('pinganconfig')); ?>"> <button type="button" class="btn btn-outline btn-default">银行通道配置</button></a>
        <?php endif; // Entrust::can ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>平安二维码列表</h5>
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td><?php echo e($v->id); ?></td>
                            <td><?php echo e($v->user_name); ?></td>
                            <td><?php echo e($v->from_info); ?></td>
                            <td><?php echo e($v->num); ?></td>
                          
                            <td><?php echo e($v->created_at); ?></td>
                            <td>
                                <a href="<?php echo e(url('/admin/pingan/DownloadQr?cno='.$v->cno)); ?>" target="_self">
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
                    $.post("<?php echo e(route('createQr')); ?>", {_token: "<?php echo e(csrf_token()); ?>"},
                            function (data) {
                                if (data.status == 1) {
                                    layer.confirm('生成二维码成功！', {
                                        btn: ['确定'] //按钮
                                    }, function () {
                                        window.location.href = "<?php echo e(route('QrLists')); ?>"
                                    });
                                } else {
                                    layer.msg(data.msg, {icon: 5});
                                }
                            }, "json");
                }
            </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>