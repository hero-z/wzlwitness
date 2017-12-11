
<?php $__env->startSection('title','设置通道'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">绑定店铺</div>
                </div>
                <div class="widget-body am-fr">
                    <form class="am-form tpl-form-line-form" action="<?php echo e(route('mmpostdata')); ?>" onsubmit="return fun()" method="post">
                        <div class="am-form-group ">
                            <label for="user-phone" class="am-u-sm-6 am-form-label">
                                <?php if(session('error')): ?>
                                    <span style="color:red;"><?php echo e(session('error')); ?></span>
                                <?php elseif(session('success')): ?>
                                    <span style="color:green;"><?php echo e(session('success')); ?></span>
                                <?php endif; ?>
                            </label>

                        </div>

                        <div class="am-form-group ">
                            <label for="user-phone" class="am-u-sm-5 am-form-label">商户名:</label>
                            <label for="user-phone" class="am-form-label"><?php echo e($name); ?></label>

                        </div>
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-5 am-form-label">选择店铺</label>
                            <div class="am-u-sm-7">
                                <select  name="store_id" data-am-selected="{searchBox: 2,maxHeight: 200,maxWidth:100,btnWidth: '200', btnSize: 'sm', btnStyle: 'secondary'}" id="weixin" style="display: none;" onchange="change()" name="weixin">
                                    <option value=" " >--请选择--</option>
                                    <?php if(!empty($first)): ?>
                                        <?php $__currentLoopData = $first; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($v->store_id); ?>**<?php echo e($v->store_type); ?>" ><?php echo e($v->store_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if(!empty($second)): ?>
                                        <?php $__currentLoopData = $second; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($v->store_id); ?>**<?php echo e($v->store_type); ?>" ><?php echo e($v->store_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if(!empty($third)): ?>
                                        <?php $__currentLoopData = $third; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($v->store_id); ?>**<?php echo e($v->store_type); ?>" ><?php echo e($v->store_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if(!empty($four)): ?>
                                        <?php $__currentLoopData = $four; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($v->store_id); ?>**<?php echo e($v->store_type); ?>" ><?php echo e($v->store_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if(!empty($five)): ?>
                                        <?php $__currentLoopData = $five; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($v['store_id']); ?>**<?php echo e($v['store_type']); ?>" ><?php echo e($v['store_name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if(!empty($six)): ?>
                                        <?php $__currentLoopData = $six; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($v['store_id']); ?>**<?php echo e($v['store_type']); ?>" ><?php echo e($v['store_name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="merchant_id" value="<?php echo e($id); ?>">
                        <input type="hidden" name="store_name" value="<?php echo e($name); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-5">
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">确认绑定
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">

        ck=false;
        function change(){
            if($('select').val()!=''){
                ck=true;
            }else{
                ck=false;
            }
        }

        function  fun() {
            return ck;
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>