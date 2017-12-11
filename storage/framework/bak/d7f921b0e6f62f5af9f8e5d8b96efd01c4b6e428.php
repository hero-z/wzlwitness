
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>修改信息</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="post">
                            <input type="hidden" id="id" value="<?php echo $_GET['id']?>">
                            <div class="form-group">
                                <label>店铺名称</label>
                                <input value="<?php echo e($store['auth_shop_name']); ?>" id="auth_shop_name" class="form-control"
                                       name="receiver" type="text">
                            </div>
                            <div class="form-group">
                                <label>手机号码</label>
                                <input value="<?php echo e($store['auth_phone']); ?>" id="auth_phone" class="form-control"
                                       name="receiver" type="text" required="required" maxlength="11" minlength="11">
                            </div>
                            <div class="hr-line-dashed"></div>
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
    <div id="con"></div>
<?php $__env->startSection('js'); ?>
    <script>

        function addpost() {
            $.post("<?php echo e(route('updateOauthUserPost')); ?>",
                    {
                        _token: '<?php echo e(csrf_token()); ?>',
                        auth_phone: $("#auth_phone").val(),
                        auth_shop_name: $("#auth_shop_name").val(),
                        id: $("#id").val()
                    },
                    function (result) {
                        if (result.status == 1) {
                            layer.alert('保存成功', {icon: 6});

                        } else {
                            layer.alert('保存失败', {icon: 5});

                        }
                    }, "json")
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>