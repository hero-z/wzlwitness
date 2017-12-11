
<?php $__env->startSection('title','设置通道'); ?>
<?php $__env->startSection('content'); ?>
            <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">添加设备</div>
                        <span style="color:green"><?php echo e(session("warnning")); ?></span>
                    </div>
                    <form class="am-form tpl-form-line-form" action="<?php echo e(route('insertMerchine')); ?>" method="post">
                        <label for="user-phone" class="">绑定店铺</label>
                        <div class="doc-example">
                            <select data-am-selected="{searchBox: 1,maxHeight: 200}" style="display: none;" name="merchine">
                                <option value=""></option>
                                <?php $__currentLoopData = $oali; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($v->name): ?>
                                        <option value="<?php echo e($v->store_id); ?>*<?php echo e($v->name); ?>"><?php echo e($v->name); ?>(支付宝当面付)</option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                <?php $__currentLoopData = $sali; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($v->name): ?>
                                        <option value="<?php echo e($v->store_id); ?>*<?php echo e($v->name); ?>"><?php echo e($v->name); ?>(支付宝口碑)</option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                <?php $__currentLoopData = $weixin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($v->name): ?>
                                        <option value="<?php echo e($v->store_id); ?>*<?php echo e($v->name); ?>"><?php echo e($v->name); ?>(微信)</option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                <?php $__currentLoopData = $pingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($v->name): ?>
                                        <option value="<?php echo e($v->store_id); ?>*<?php echo e($v->name); ?>"><?php echo e($v->name); ?>(平安银行)</option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                        </div>
                            <label for="user-phone" class="">设备名</label>

                            <input class="am-form-field" placeholder="请输入设备名" type="text" name="mname">

                            <label for="user-phone" class="">设备密钥</label>

                            <input class="am-form-field" placeholder="请输入设备密钥" type="text" name="msign">
                            <label for="user-phone" class="">设备号</label>
                            <input class="am-form-field" placeholder="请输入设备号" type="text" name="merchine_code">

                        <div class="hr-line-dashed"></div>
                        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">确认保存
                        </button>
                        </div>
                        <?php echo e(csrf_field()); ?>


                    </form>
                </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>