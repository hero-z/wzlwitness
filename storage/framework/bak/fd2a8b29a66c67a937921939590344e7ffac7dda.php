
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>极光配置</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>开发者标识</label>
                                <input placeholder="请联系有梦想科技获得您的开发者标识" value="<?php echo e($list->DevKey); ?>" class="form-control"
                                       id="app_id" name="app_id"
                                       type="text" required>
                            </div>
                            <div class="form-group">
                                <label>密钥</label>
                                <input  placeholder="请输入授权密钥" value="<?php echo e($list->API_DevSecre); ?>"
                                        class="form-control" id="token"
                                        name="token"
                                        type="text" required>
                            </div>
                            <input type="hidden" value="<?php echo e($list->id); ?>" id="id">
                            <div>
                                <button onclick="addpost()" class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="button" >
                                    <strong>保存</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>

        function addpost() {
            $.post("<?php echo e(route("updateJpushConfigs")); ?>",
                    {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id:$("#id").val(),
                        DevKey: $("#app_id").val(),
                        API_DevSecre: $("#token").val(),
                    },
                    function (result) {
                        if (result.status == 1) {
                            layer.alert('保存成功', {icon: 6});
                        }
                    }, "json")
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>