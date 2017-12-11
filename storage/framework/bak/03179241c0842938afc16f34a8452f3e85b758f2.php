
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js/vendor/jquery.ui.widget.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js//jquery.iframe-transport.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js/jquery.fileupload.js')); ?>" type="text/javascript"></script>
    <style type="text/css">
        /* 图片展示样式 */
        .images_zone{position:relative; width:120px;height:120px; overflow:hidden; float:left; margin:3px 5px 3px 0; background:#f0f0f0;border:5px solid #f0f0f0; }
        .images_zone span{display:table-cell;text-align: center;vertical-align: middle;overflow: hidden;width: 120px;height: 120px;}
        .images_zone span img{width:120px; vertical-align: middle;}
        .images_zone a{text-align:center; position:absolute;bottom:0px;left:0px;background:rgba(255,255,255,0.5); display:block;width:100%; height:20px;line-height:20px; display:none; font-size:12px;}
        /* 进度条样式 */
        .up_progress,.up_progress1,.up_progress2, .up_progress3,.up_progress4,.up_progress5,.up_progress6,.up_progress7,.up_progress8 {width: 300px;height: 13px;font-size: 10px;line-height: 14px;overflow: hidden;background: #e6e6e6;margin: 5px 0;display:none;}
        .up_progress .progress-bar,.up_progress1 .progress-bar1,.up_progress2 .progress-bar2,.up_progress3 .progress-bar3,.up_progress4 .progress-bar4,.up_progress5 .progress-bar5,.up_progress6 .progress-bar6,.up_progress7 .progress-bar7,.up_progress8 .progress-bar8{height: 13px;background: #11ae6f;float: left;color: #fff;text-align: center;width:0%;}
    </style>
    <div class="col-sm-6">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>配置信息</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo e(url('admin/alipayopen/store')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>APP_ID</label>
                                <input value="<?php echo e($c['app_id']); ?>"  id="app_id" placeholder="请填写支付宝开放平台应用的app_id" class="form-control" name="app_id"  type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>PID</label>
                                <input  id="pid"  value="<?php echo e($c['pid']); ?>" placeholder="请填写支付宝开放平台的返佣id" class="form-control" name="pid"  type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>应用网关</label>
                                <input  id="notify" value="<?php echo e($c['notify']); ?>" placeholder="请填写支付宝开放平台的notify" class="form-control" name="notify"  type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>授权回调地址</label>
                                <input  id="callback" value="<?php echo e($c['callback']); ?>" placeholder="请填写支付宝开放平台的授权回调地址" class="form-control" name="callback"  type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label>请填写店铺通知url</label>
                                    <input  id="operate_notify_url" value="<?php echo e($c['operate_notify_url']); ?>" placeholder="请填写店铺通知url" class="form-control" name="operate_notify_url"  type="text">
                                </div>
                                <div class="hr-line-dashed"></div>
                            </div>
                       <div class="form-group">
                                <label>软件生成的应用私钥</label>
                                <textarea  id="rsaPrivateKey"  style="min-height: 300px" placeholder="请填写软件生成的应用私钥" class="form-control" name="rsaPrivateKey"><?php echo e($c['rsaPrivateKey']); ?></textarea>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>软件生成的应用私钥文件</label>
                                <input type="text" size="50" name="rsaPrivateKeyFilePath" value="<?php echo e($c['rsaPrivateKeyFilePath']); ?>" id="rsaPrivateKeyFilePath">
                                <!-- 图片上传按钮 -->
                                <input id="fileupload" type="file" name="file" data-url="<?php echo e(route('uploadfile')); ?>" data-form-data='{"_token": "<?php echo e(csrf_token()); ?>"}' multiple="true">
                                <!-- 图片展示模块 -->
                                <div class="files"></div><div style="clear:both;"></div>
                                <!-- 图片上传进度条模块 -->
                                <div class="up_progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <div style="clear:both;"></div>

                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>开发平台后台的支付宝rsa公钥</label>
                                <textarea  id="alipayrsaPublicKey" style="min-height: 100px"  placeholder="请填写软件生成的应用私钥" class="form-control" name="alipayrsaPublicKey"  type="text"><?php echo e($c['alipayrsaPublicKey']); ?></textarea>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>软件生成的公钥文件</label>
                                <input type="text" size="50" name="rsaPublicKeyFilePath" value="<?php echo e($c['rsaPublicKeyFilePath']); ?>" id="rsaPublicKeyFilePath">
                                <!-- 图片上传按钮 -->
                                <input id="fileupload1" type="file"  name="file" data-url="<?php echo e(route('uploadfile')); ?>" data-form-data='{"_token": "<?php echo e(csrf_token()); ?>"}' multiple="true">
                                <!-- 图片展示模块 -->
                                <div class="files1"></div><div style="clear:both;"></div>
                                <!-- 图片上传进度条模块 -->
                                <div class="up_progress1">
                                    <div class="progress-bar1"></div>
                                </div>
                                <div style="clear:both;"></div>

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
           $.post("<?php echo e(route('saveconfig')); ?>",
                   {_token: '<?php echo e(csrf_token()); ?>',app_id:$("#app_id").val(),pid:$("#pid").val(),notify:$("#notify").val(),callback:$("#callback").val()
                       ,rsaPrivateKey:$("#rsaPrivateKey").val(),operate_notify_url:$("#operate_notify_url").val(),rsaPrivateKeyFilePath:$("#rsaPrivateKeyFilePath").val(),alipayrsaPublicKey:$("#alipayrsaPublicKey").val(),rsaPublicKeyFilePath:$("#rsaPublicKeyFilePath").val()},
                   function (result) {
                       if(result.status==1){
                           layer.alert('保存成功', {icon: 6});
                       }
                   }, "json")
        }
    </script>
    <script type="text/javascript">
        publicfileupload("#fileupload",".files","#rsaPrivateKeyFilePath",".up_progress .progress-bar",".up_progress");
        publicfileupload("#fileupload1",".files1","#rsaPublicKeyFilePath",'.up_progress1 .progress-bar1',".up_progress1");
        function publicfileupload(fileid,imgid,postimgid,class1,class2) {
            //图片上传
            $(fileid).fileupload({
                dataType: 'json',
                add: function (e, data) {
                    var numItems = $('.files .images_zone').length;
                    if(numItems>=10){
                        alert('提交照片不能超过3张');
                        return false;
                    }
                    $(class1).css('width','0px');
                    $(class2).show();
                    $(class1).html('上传中...');
                    data.submit();
                },
                done: function (e, data) {
                    $(class2).hide();
                    $('.upl').remove();
                    var d = data.result;
                    if(d.status==0){
                        alert("上传失败");
                    }else{
                        jQuery(postimgid).val(d.path);
                    }
                },
                progressall: function (e, data) {
                    console.log(data);
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $(class1).css('width',progress + '%');
                }
            });
        }
    </script>


<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>