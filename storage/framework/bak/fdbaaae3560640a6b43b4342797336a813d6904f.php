<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">欢迎登陆系统</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">账号</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <?php if( $errors->first('email')=="These credentials do not match our records."): ?>
                                        <span class="help-block">
                                        <strong>账号和密码不匹配,请输入正确的账号密码</strong>
                                            </span>
                                    <?php else: ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value="" class="form-control"
                                       name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <?php if( $errors->first('password')=="These credentials do not match our records."): ?>
                                        <span class="help-block">
                                        <strong>账号和密码不匹配,请输入正确的账号密码</strong>
                                            </span>
                                    <?php else: ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登陆后台
                                </button>

                                <a class="btn btn-link" href="<?php echo e(url('/password/reset')); ?>">
                                    忘记密码?
                                </a>
                                <a class="btn btn-link" href="<?php echo e(url('/merchant/login')); ?>">
                                        商户后台
                                    </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>