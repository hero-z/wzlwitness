
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js/vendor/jquery.ui.widget.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js//jquery.iframe-transport.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js/jquery.fileupload.js')); ?>" type="text/javascript"></script>
    <style type="text/css">
        /* 图片展示样式 */
        .images_zone {
            position: relative;
            width: 120px;
            height: 120px;
            overflow: hidden;
            float: left;
            margin: 3px 5px 3px 0;
            background: #f0f0f0;
            border: 5px solid #f0f0f0;
        }

        .images_zone span {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            overflow: hidden;
            width: 120px;
            height: 120px;
        }

        .images_zone span img {
            width: 120px;
            vertical-align: middle;
        }

        .images_zone a {
            text-align: center;
            position: absolute;
            bottom: 0px;
            left: 0px;
            background: rgba(255, 255, 255, 0.5);
            display: block;
            width: 100%;
            height: 20px;
            line-height: 20px;
            display: none;
            font-size: 12px;
        }

        /* 进度条样式 */
        .up_progress, .up_progress1, .up_progress2, .up_progress3, .up_progress4, .up_progress5, .up_progress6, .up_progress7, .up_progress8 {
            width: 300px;
            height: 13px;
            font-size: 10px;
            line-height: 14px;
            overflow: hidden;
            background: #e6e6e6;
            margin: 5px 0;
            display: none;
        }

        .up_progress .progress-bar, .up_progress1 .progress-bar1, .up_progress2 .progress-bar2, .up_progress3 .progress-bar3, .up_progress4 .progress-bar4, .up_progress5 .progress-bar5, .up_progress6 .progress-bar6, .up_progress7 .progress-bar7, .up_progress8 .progress-bar8 {
            height: 13px;
            background: #11ae6f;
            float: left;
            color: #fff;
            text-align: center;
            width: 0%;
        }
    </style>
    <div class="col-sm-6">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>浦发银行通道配置信息</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="post">
                            <?php echo e(csrf_field()); ?>



                            <div class="form-group">
                                <label>浦发渠道号：</label>
                                <input value="<?php echo e($data->partner); ?>" id="partner" placeholder="请填写支付宝开放平台应用的app_id"
                                       class="form-control" name="partner" type="text">
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label>浦发渠道秘钥：</label>
                                <textarea id="security_key" style="min-height: 300px" placeholder="请填写软件生成的应用私钥"
                                          class="form-control" name="security_key"><?php echo e($data->security_key); ?></textarea>
                            </div>
                            <div class="hr-line-dashed"></div>



                            <div class="form-group">
                                <label>进件提交地址：</label>
                                <input value="<?php echo e($data->infourl); ?>" id="infourl" placeholder="请填写支付宝开放平台应用的app_id"
                                       class="form-control" name="infourl" type="text">
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label>支付提交地址：</label>
                                <input value="<?php echo e($data->payurl); ?>" id="payurl" placeholder="请填写支付宝开放平台应用的app_id"
                                       class="form-control" name="payurl" type="text">
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
            $.post("<?php echo e(route('pufaConfig')); ?>",
                    {
                        _token: '<?php echo e(csrf_token()); ?>',security_key:$("#security_key").val(),infourl:$("#infourl").val(),payurl:$("#payurl").val(),partner: $("#partner").val()
                    },
                    function (result) {
                        if (result.status == 1) {
                            layer.alert(result.message, {icon: 6});
                        }
                            layer.alert(result.message, {icon: 6});
                    }, "json")
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>