
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js/vendor/jquery.ui.widget.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js//jquery.iframe-transport.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('/jQuery-File-Upload/js/jquery.fileupload.js')); ?>" type="text/javascript"></script>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.datetimepicker.css')); ?>"/>
    <script src="<?php echo e(asset('/amazeui/assets/js/locales/amazeui.datetimepicker.zh-CN.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.datetimepicker.min.js')); ?>"></script>
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
                <h5>添加广告</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo e(route('insertAd')); ?>" method="post">
                            <input type="hidden" value="<?php echo e($list->id); ?>" id="id" name="id">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>广告分类</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b"  id="type" name="type" required="required">
                                        <option value="alipay" <?php if($list->type=="alipay"): ?> selected="selected" <?php endif; ?>>支付宝</option>
                                        <option value="weixin" <?php if($list->type=="weixin"): ?> selected="selected" <?php endif; ?>>微信</option>
                                        <option value="jd" <?php if($list->type=="jd"): ?> selected="selected" <?php endif; ?>>京东钱包</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>广告位置</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b"  id="position" name="position" required="required">
                                        <option value="1" <?php if($list->position==1): ?> selected="selected" <?php endif; ?>>支付成功页</option>
                                        <option value="0" <?php if($list->position==0): ?> selected="selected" <?php endif; ?>>支付失败页</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>广告启用或下线</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" id="status" name="status" required="required">
                                        <option value="1" <?php if($list->status==1): ?> selected="selected" <?php endif; ?>>启用</option>
                                        <option value="0" <?php if($list->status==0): ?> selected="selected" <?php endif; ?>>下线</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label>开始时间</label>
                                <div class="col-sm-10">
                                    <input size="16" type="text" id="time_start" name="time_start" value="<?php if(!empty($list->time_start)): ?><?php echo e($list->time_start); ?><?php else: ?><?php echo e(date('Y-m-d').' 00:00'); ?><?php endif; ?>"  class="form-datetime-lang am-form-field" required="required">

                                    <script>
                                        (function($){
                                            // 也可以在页面中引入 amazeui.datetimepicker.zh-CN.js
                                            $.fn.datetimepicker.dates['zh-CN'] = {
                                                days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
                                                daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
                                                daysMin:  ["日", "一", "二", "三", "四", "五", "六", "日"],
                                                months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                                                monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                                                today: "今日",
                                                suffix: [],
                                                meridiem: ["上午", "下午"]
                                            };

                                            $('.form-datetime-lang').datetimepicker({
                                                language:  'zh-CN',
                                                format: 'yyyy-mm-dd hh:ii'
                                            });
                                        }(jQuery));
                                    </script>



                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>结束时间</label>
                                <div class="col-sm-10">
                                    <input size="16" type="text" id="time_end" name="time_end" value="<?php if(!empty($list->time_end)): ?><?php echo e($list->time_end); ?><?php else: ?><?php echo e(date('Y-m-d').' 23:59'); ?><?php endif; ?>"  class="form-datetime-lang am-form-field" required="required">

                                    <script>
                                        (function($){
                                            // 也可以在页面中引入 amazeui.datetimepicker.zh-CN.js
                                            $.fn.datetimepicker.dates['zh-CN'] = {
                                                days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
                                                daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
                                                daysMin:  ["日", "一", "二", "三", "四", "五", "六", "日"],
                                                months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                                                monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                                                today: "今日",
                                                suffix: [],
                                                meridiem: ["上午", "下午"]
                                            };

                                            $('.form-datetime-lang').datetimepicker({
                                                language:  'zh-CN',
                                                format: 'yyyy-mm-dd hh:ii'
                                            });
                                        }(jQuery));
                                    </script>



                                </div>


                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>广告描述</label>
                                <input msg="广告描述" placeholder="给广告一个描述,方便自己查看" class="form-control"
                                       name="content" id="content" type="text" value="<?php echo e($list->content); ?>">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <script src="<?php echo e(asset('uploadify/jquery.uploadify.min.js')); ?>"
                                        type="text/javascript"></script>
                                <link rel="stylesheet" type="text/css" href="<?php echo e(asset('uploadify/uploadify.css')); ?>">
                                <label>广告图片(最佳分辨率520*303)</label>
                                <input type="hidden" required="required" size="50" value="" name="brand_logo" id="brand_logo">
                                <input type="hidden" required="required" size="50" value="<?php echo e($list->pic); ?>" name="oldpic" id="oldpic">
                                <!-- 图片上传按钮 -->
                                <input id="fileupload" type="file" name="image" data-url="<?php echo e(route('uploads')); ?>"
                                       data-form-data='{"_token": "<?php echo e(csrf_token()); ?>"}' multiple="true" >
                                <!-- 图片展示模块 -->
                                <div class="files" ><img class="images_zone" id="oldimg" width="30px" src="<?php echo e(url($list->pic)); ?>"></div>
                                <div style="clear:both;"></div>
                                <!-- 图片上传进度条模块 -->
                                <div class="up_progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <div style="clear:both;"></div>

                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>广告链接</label>
                                <input msg="广告链接" required="required" placeholder="比如：https://isv.umxnt.com"
                                       class="form-control" name="url" id="url"
                                       type="text" value="<?php echo e($list->url); ?>">
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="button" onclick="addpost()">
                                    <strong>确认修改</strong>
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
            $.post("<?php echo e(route('updateAd')); ?>",
                    {
                        _token: '<?php echo e(csrf_token()); ?>',
                        type: $("#type").val(),
                        position:$("#position").val(),
                        status: $("#status").val(),
                        time_start: $("#time_start").val(),
                        time_end: $("#time_end").val(),
                        content: $("#content").val(),
                        pic:$("#brand_logo").val(),
                        url:$("#url").val(),
                        id:$("#id").val(),
                        oldpic:$("#oldpic").val()
                    },
                    function (result) {
                        if (result.success==1) {
                            //询问框
                            layer.confirm('修改成功', {
                                btn: ['列表页', '当前页'] //按钮
                            }, function () {
                                window.location.href = "<?php echo e(route('adIndex')); ?>";
                            }, function () {
                                layer.msg('正在浏览提交的广告详情');
                            });
                        } else {
                            layer.msg(result.sub_msg);
                        }
                    }, "json")

        }

    </script>

    <script type="text/javascript">
        publicfileupload("#fileupload", ".files", "#brand_logo", ".up_progress .progress-bar", ".up_progress");
        function publicfileupload(fileid, imgid, postimgid, class1, class2) {
            //图片上传
            $(fileid).fileupload({
                dataType: 'json',
                add: function (e, data) {
                    var numItems = $('.files .images_zone').length;
                    if (numItems >= 10) {
                        alert('提交照片不能超过3张');
                        return false;
                    }
                    $(class1).css('width', '0px');
                    $(class2).show();
                    $(class1).html('上传中...');
                    data.submit();
                },
                done: function (e, data) {
                    $(class2).hide();
                    $('.upl').remove();
                    var d = data.result;
                    if (d.status == 0) {
                        alert("上传失败");
                    } else {
                        $("#oldimg").remove();
                        var imgshow = '<div class="images_zone"><input type="hidden" name="imgs[]" value="' + d.image_url + '" /><span><img src="' + d.image_url + '"  /></span><a href="javascript:;">删除</a></div>';
                        jQuery(imgid).append(imgshow);
                        jQuery(postimgid).val(d.image_url);
                    }
                },
                progressall: function (e, data) {
                    console.log(data);
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $(class1).css('width', progress + '%');
                }
            });

            //图片删除
            $(imgid).on({
                mouseenter: function () {
                    $(this).find('a').show();
                },
                mouseleave: function () {
                    $(this).find('a').hide();
                },
            }, '.images_zone');
            $(imgid).on('click', '.images_zone a', function () {
                $(this).parent().remove();
            });
        }
    </script>


<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>