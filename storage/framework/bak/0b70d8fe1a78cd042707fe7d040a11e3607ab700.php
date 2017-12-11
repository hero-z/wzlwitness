
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>收银提醒(微信公众号)配置信息</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" id="type" value="<?php echo $_GET['type']?>">
                            <div class="form-group">
                                <label>微信通知模板ID</label>
                                <input id="string1" value="<?php echo e($WxPayNotify['string1']); ?>"
                                       placeholder="请填写微信通知模板ID,在公众号后台模板消息可以看到模板id" class="form-control" name="string1"
                                       type="text">
                            </div>
                            
                            <div>
                                <button onclick="addpost()" class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="button">
                                    <strong>保存</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>微信模板消息说明</h5>
                            </div>
                            <div class="ibox-content">
                                <h2>微信公众号后台的模板消息添加如下格式就行</h2>
                                <br>
                               标题收款成功通知  <br>
                                <br>
                                您好,您有一笔订单收款成功  <br>
                                到账金额：￥20.00  <br>
                                支付方式：微信支付  <br>
                                支付时间：2017-01-01 12:12:12  <br>
                                订单编号：12345678900<br>
                                详情请前往门店账户余额查看.

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="con"></div>
<?php $__env->startSection('js'); ?>
    <script>

        function addpost() {
            $.post("<?php echo e(route('setPagePost')); ?>",
                    {
                        _token: '<?php echo e(csrf_token()); ?>',
                        type: $("#type").val(),
                        string1: $("#string1").val(),
                        string2: $("#string2").val(),
                        string3: $("#string3").val()
                        ,
                        text2: $("#text2").val()
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