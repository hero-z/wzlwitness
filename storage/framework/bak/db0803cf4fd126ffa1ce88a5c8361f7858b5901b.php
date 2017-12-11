
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>短信验证配置</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>app_key</label>
                                <input placeholder="请联系有梦想科技获得您的app_key" value="<?php echo e($list->app_key); ?>" class="form-control"
                                       id="app_key" name="app_key"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <label>app_secret</label>
                                <input  placeholder="请输入密钥" value="<?php echo e($list->app_secret); ?>"
                                        class="form-control" id="app_secret"
                                        name="app_secret"
                                        type="email">
                            </div>
                            <div class="form-group">
                                <label>短信签名</label>
                                <input  placeholder="请输入短信签名" value="<?php echo e($list->SignName); ?>"
                                        class="form-control" id="SignName"
                                        name="SignName">
                            </div>
                            <div class="form-group">
                                <label>短信模板</label>
                                <input  placeholder="请输入短信模板" value="<?php echo e($list->TemplateCode); ?>"
                                        class="form-control" id="TemplateCode"
                                        name="TemplateCode">
                            </div>
                            <div>
                                <button onclick="addpost()" class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="button">
                                    <strong>保存</strong>
                                </button>
                            </div>
                            <input name="id" id="id" type="hidden" value="<?php echo e($list->id); ?>">
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
            $.post("<?php echo e(route('updateSms')); ?>",
                    {
                        _token: '<?php echo e(csrf_token()); ?>',
                        app_key: $("#app_key").val(),
                        app_secret: $("#app_secret").val(),
                        SignName: $("#SignName").val(),
                        TemplateCode: $("#TemplateCode").val(),
                        id:$("#id").val()
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