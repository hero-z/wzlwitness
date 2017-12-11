
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>网站配置</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>软件授权app_id</label>
                                <input placeholder="请联系有梦想科技获得您的app_id" value="<?php echo e($app->app_id); ?>" class="form-control"
                                       id="app_id" name="app_id"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <label>软件授权邮箱</label>
                                <input  placeholder="请输入授权邮箱" value="<?php echo e($app->token); ?>"
                                       class="form-control" id="token"
                                       name="token"
                                       type="email">
                            </div>
                            <div>
                                <button onclick="addpost()" class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="button">
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
            $.post("<?php echo e(route('setAppPost')); ?>",
                    {
                        _token: '<?php echo e(csrf_token()); ?>',
                        app_id: $("#app_id").val(),
                        token: $("#token").val(),
                        app_version: $("#app_version").val(),
                        msg: $("#msg").val(),
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