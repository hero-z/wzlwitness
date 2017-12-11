
<?php $__env->startSection('title','设置通道'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <?php if (app('Illuminate\Contracts\Auth\Access\Gate')->check("changeShopOwner")): ?>
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">店铺归属转移</div>
                </div>
                <?php endif; ?>
                <span style="color:red"><?php echo e(session("warnning")); ?></span>
                <div class="widget-body am-fr">
                    <form class="am-form tpl-form-line-form" action="<?php echo e(route('changeOwner')); ?>" method="post">
                                <label for="user-phone" class=" am-form-label">转出方</label>
                                <select data-am-selected="{searchBox: 1,maxHeight: 100,maxWidth:100,btnWidth: '200', btnSize: 'sm', btnStyle: 'secondary'}" id="from" style="display: none;" name="from" onchange="change()">
                                    <option class="am-u-sm-2" value="" ></option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option class="am-u-sm-2" value="<?php echo e($v->id); ?>" ><?php echo e($v->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                                <label for="user-phone" class="am-form-label">转入方</label>
                                <select data-am-selected="{searchBox: 1,maxHeight: 100,maxWidth:100,btnWidth: '200', btnSize: 'sm', btnStyle: 'secondary'}" id="to" style="display: none;" name="to">
                                    <option class="am-u-sm-2" value="" ></option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option class="am-u-sm-2" value="<?php echo e($v->id); ?>" ><?php echo e($v->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">确认转移
                                </button>
                        <?php echo e(csrf_field()); ?>


                        <table class="am-table am-table-bordered " id="table">

                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <script type="text/JavaScript">
                function change(){
                    $('#table tr').remove();
                    $.post("<?php echo e(route('changeTo')); ?>", {id:$("#from").val(),_token: "<?php echo e(csrf_token()); ?>"},
                            function (data) {
                               //alert(data[1].name);
                                var str="<tr><th></th> <th>店铺名称</th> <th>店铺id</th> </tr>";
                                for(var i=0;i<data.length;i++){
                                    $('#table tr').remove();
                                    str+="<tr><td><label class='am-checkbox am-success'><input value='"+data[i].external_id+"' data-am-ucheck='' class='am-ucheck-checkbox' type='checkbox' name='su[]'><span class='am-ucheck-icons'><i class='am-icon-unchecked'></i><i class='am-icon-checked'></i></span></label> </td><td>"+data[i].name+"</td><td>"+data[i].external_id+"</td></tr>"
                                }
                                $("#table").append(str);
              //  $("#twoId").html(str);
                            }, 'json');
                }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>