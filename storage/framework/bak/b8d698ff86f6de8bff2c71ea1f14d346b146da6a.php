
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo e($store_name); ?>_收银提醒配置信息</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" id="store_id" value="<?php echo e($store_id); ?>">
                            <input type="hidden" id="set_type" value="<?php echo e($set_type); ?>">
                            <div class="form-group">
                                <label>店铺名称</label>
                                <input value="<?php echo e($store_name); ?>"   id="store_name"  class="form-control" name="receiver"  type="text">
                            </div>
                            <div class="form-group">
                                <label>收银员设置</label>
                                <input value="<?php echo e($WxPayNotify['receiver']); ?>" disabled   id="receiver" placeholder="请填写收银员微信号多个以 ',' 隔开" class="form-control" name="receiver"  type="hidden">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>微信通知模板ID</label>
                                <input  id="template_id"  value="<?php echo e($WxPayNotify['template_id']); ?>" placeholder="请填写微信通知模板ID,在公众号后台模板消息可以看到模板id" class="form-control" name="template_id"  type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>设置模板头部颜色</label>
                                <input  id="topColor" value="<?php echo e($WxPayNotify['topColor']); ?>" placeholder="请设置模板头部颜色" class="form-control" name="topColor"  type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>设置详情链接</label>
                                <input  id="linkTo" value="<?php echo e($WxPayNotify['linkTo']); ?>" placeholder="设置详情链接" class="form-control" name="linkTo"  type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label>设置模板数据</label>
                                    <textarea style="min-height: 100px"  id="data" value="" placeholder="设置模板数据" class="form-control" name="data"  type="text"><?php echo e($WxPayNotify['data']); ?></textarea>
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
           $.post("<?php echo e(route('setWxNotifyPost')); ?>",
                   {_token: '<?php echo e(csrf_token()); ?>',receiver:$("#receiver").val(),template_id:$("#template_id").val(),topColor:$("#topColor").val(),linkTo:$("#linkTo").val()
                       ,data:$("#data").val(),store_id:$("#store_id").val(),store_type:$("#set_type").val(),store_name:$("#store_name").val()},
                   function (result) {
                       if(result.status==1){
                           layer.alert('保存成功', {icon: 6});

                       }else {
                           layer.alert('保存失败', {icon: 5});

                       }
                   }, "json")
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>