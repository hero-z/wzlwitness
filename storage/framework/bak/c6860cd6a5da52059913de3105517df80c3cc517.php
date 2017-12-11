
<?php $__env->startSection('title','设置通道'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">支付宝微信二码合一</div>
                </div>
                <div class="widget-body am-fr">
                    <form class="am-form tpl-form-line-form" action="<?php echo e(route('updateAddTwo')); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo e($id); ?>">
                        <div class="am-form-group ">
                            <span style="color:red"><?php echo e(session("warnning")); ?></span>
                            <label for="user-phone" class="am-u-sm-5 am-form-label">支付宝通道</label>
                            <div class="am-u-sm-7">
                                <select data-am-selected="{searchBox: 1,maxHeight: 200,maxWidth:100,btnWidth: '200', btnSize: 'sm', btnStyle: 'secondary'}" id="ali" style="display: none;" name="ali" onchange="change()">
                                    <?php if($oali): ?>
                                        <?php $__currentLoopData = $oali; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php if($v->auth_shop_name): ?>
                                                <option class="am-u-sm-3" value="store_id_a*<?php echo e($v->store_id); ?>*alipay_ways*oalipay*" <?php if($list->store_id_a==$v->store_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->auth_shop_name); ?>(当面付)</option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($sali): ?>
                                        <?php $__currentLoopData = $sali; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php if($v->main_shop_name): ?>
                                                <option class="am-u-sm-3" value="store_id_a*<?php echo e($v->store_id); ?>*alipay_ways*salipay" <?php if($list->store_id_a==$v->store_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->main_shop_name); ?>(口碑)</option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($pingan): ?>
                                        <?php $__currentLoopData = $pingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php if($v->alias_name): ?>
                                                <option class="am-u-sm-3" value="store_id_a*<?php echo e($v->external_id); ?>*alipay_ways*palipay" <?php if($list->store_id_a==$v->external_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->alias_name); ?>(平安)</option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($pufa): ?>
                                            <?php $__currentLoopData = $pufa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <option class="am-u-sm-3" value="store_id_a*<?php echo e($v->store_id); ?>*alipay_ways*pfalipay" <?php if($list->store_id_a==$v->store_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->merchant_short_name); ?>(浦发)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-5 am-form-label">微信支付通道</label>
                            <div class="am-u-sm-7">
                                <select data-am-selected="{searchBox: 2,maxHeight: 200,maxWidth:100,btnWidth: '200', btnSize: 'sm', btnStyle: 'secondary'}" id="weixin" style="display: none;" name="weixin">
                                    <?php if($weixin): ?>
                                        <?php $__currentLoopData = $weixin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php if($v->store_name): ?>
                                                <option value="store_id_w*<?php echo e($v->store_id); ?>*weixin_ways*weixin" <?php if($list->store_id_w==$v->store_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->store_name); ?>(微信官方)</option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($pingan): ?>
                                        <?php $__currentLoopData = $pingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php if($v->alias_name): ?>
                                                <option value="store_id_w*<?php echo e($v->external_id); ?>*weixin_ways*pweixin" <?php if($list->store_id_w==$v->external_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->alias_name); ?>(平安微信)</option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                        <?php if($pufa): ?>
                                            <?php $__currentLoopData = $pufa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <option class="am-u-sm-3" value="store_id_w*<?php echo e($v->store_id); ?>*weixin_ways*pfweixin" <?php if($list->store_id_w==$v->store_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->merchant_short_name); ?>(浦发)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-5 am-form-label">京东支付通道</label>
                            <div class="am-u-sm-7" >
                                <select data-am-selected="{searchBox: 2,maxHeight: 200,maxWidth:100,btnWidth: '200', btnSize: 'sm', btnStyle: 'secondary'}" id="jd" style="display: none;" name="jd" onchange="changeb()">
                                    <option value="" ></option>
                                    <?php if($pingan): ?>
                                        <?php $__currentLoopData = $pingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php if($v->alias_name): ?>
                                                <option value="store_id_j*<?php echo e($v->external_id); ?>*jd_ways*pjd" <?php if($list->store_id_j==$v->external_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->alias_name); ?>(平安京东)</option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-5 am-form-label">翼支付通道</label>
                            <div class="am-u-sm-7">
                                <select data-am-selected="{searchBox: 2,maxHeight: 200,maxWidth:100,btnWidth: '200', btnSize: 'sm', btnStyle: 'secondary'}" id="bestpay" style="display: none;" name="bestpay" onchange="changec()">
                                    <option value="" ></option>
                                    <?php if($pingan): ?>
                                        <?php $__currentLoopData = $pingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <?php if($v->alias_name): ?>
                                                <option value="store_id_b*<?php echo e($v->external_id); ?>*bestpay_ways*pbestpay" <?php if($list->store_id_b==$v->external_id): ?>selected="selected"<?php endif; ?>><?php echo e($v->alias_name); ?>(平安翼支付)</option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-5 am-form-label">开启或关闭支付</label>
                            <div class="am-u-sm-7">
                                <select data-am-selected="{searchBox: 3,maxHeight: 200,maxWidth:100,btnWidth: '200', btnSize: 'sm', btnStyle: 'secondary'}" id="open" style="display: none;" name="open">
                                    <option value="1" <?php if($list->status=="1"): ?>selected="selected"<?php endif; ?>>开启</option>
                                    <option value="0" <?php if($list->status=="0"): ?>selected="selected"<?php endif; ?>>关闭</option>


                                </select>
                            </div>
                        </div>

                        <?php echo e(csrf_field()); ?>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-5">
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">确认修改
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/JavaScript">
        function change(){
            // a= $("#ali").val();
            //  alert(a);
            $('#weixin option').remove();
            $.post("<?php echo e(route('xuanzhong')); ?>", {id:$("#ali").val(),_token: "<?php echo e(csrf_token()); ?>"},
                    function (data) {
                        //alert(data[1].value);
                        var str="";
                        for(var i=0;i<data.length;i++){
                            $('#weixin option').remove();
                            str+="<option value='"+data[i].value+"'>"+data[i].name+"</option>"
                        }
                        $("#weixin").append(str);
//                $("#twoId").html(str);
                    }, 'json');
        }
    </script>
    
    
    
    
    
    
    
    
    
    
    
    
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>