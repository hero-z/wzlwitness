
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(asset('js/check.js')); ?>" type="text/javascript"></script>

    <div class="row">

            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">添加收银员</div>
                        <div class="widget-function am-fr">
                            <a href="javascript:;" class="am-icon-cog"></a>
                        </div>
                    </div>
                    <div class="widget-body  widget-body-lg am-fr">
                        <form class="am-form tpl-form-line-form">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">收银员 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input class="tpl-form-input" id="name" placeholder="请输入收银员名称" type="text">
                                    
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-email" class="am-u-sm-3 am-form-label">手机号 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input class="tpl-form-input" id="phone" placeholder="请输入收银员登录手机号" type="text">
                                    
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">密码 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input placeholder="请输入初始密码" id="password" type="password">
                                </div>
                            </div>
                            <input type="hidden" id="pid" value="<?php echo e($m_id); ?>">
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success " onclick="post()">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="application/javascript">
                function post() {
                    if(!$('#name').val()){
                        alert('收银员名称不能为空');
                        $('#name').focus();
                    }else if(!$('#phone').val()||!IsTel($("#phone").val().trim())){
                        alert('收银员手机号不能为空且格式必须正确');
                        $('#phone').focus();
                    }else if(!$('#password').val()||$('#password').val().length<6){
                        alert('收银员密码不能为空且必须6位以上');
                        $('#password').focus();
                    }else{
                        $.post("<?php echo e(route('cashierdoadd')); ?>", {
                            _token: "<?php echo e(csrf_token()); ?>",
                            name: $("#name").val().trim(),
                            phone: $("#phone").val().trim(),
                            password: $("#password").val().trim(),
                            pid: $("#pid").val().trim()

                        },
                                function (data) {
                                    if (data.status=='1') {
                                        window.location.href = "<?php echo e(route('cashierindex')); ?>";
                                    } else {
                                        alert(data.msg);
                                    }
                                },'json');
                    }
                }

            </script>



        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>