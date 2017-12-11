
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(isset($info)&&$info): ?>
        <?php echo e($info); ?>

    <?php endif; ?>
    <?php if(isset($list)): ?>
        <div class="row">

            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">收银员信息</div>
                        <div class="widget-function am-fr">
                            <a href="javascript:;" class="am-icon-cog"></a>
                        </div>
                    </div>
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">
                            <div class="am-btn-group am-btn-group-xs">
                                <button type="button" onclick="add()" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增收银员</button>
                                <button type="button" onclick="update()" style="margin-left: 5px" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span>更新收银通道</button>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="widget-body  widget-body-lg am-fr">

                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                            <thead>
                            <tr>
                                <th class="am-u-sm-4">收银员</th>
                                
                                <th class="am-u-sm-4">手机号</th>
                                <th class="am-u-sm-4">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($list): ?>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr class="gradeX">
                                        <td class="am-u-sm-4"><?php echo e($v->name); ?></td>
                                        
                                        <td class="am-u-sm-4"><?php echo e($v->phone); ?></td>
                                        <td class="am-u-sm-4">
                                            <div class="tpl-table-black-operation">
                                                
                                                    
                                                
                                                <a href="javascript:;" onclick="del(<?php echo e($v->id); ?>)" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                            <!-- more data -->
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers"
                                     id="DataTables_Table_0_paginate">
                                    <?php if($list): ?>   <?php echo e($list->links()); ?><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="application/javascript">
                function add() {
                    window.location.href = "<?php echo e(route('cashieradd')); ?>";
                }
                function update() {
                    $.post("<?php echo e(route('cashierupdate')); ?>", {_token: "<?php echo e(csrf_token()); ?>" },
                            function (data) {

                                alert(data.msg);

                            },'json');
                }
                function del(id) {
                    var r=confirm('确定删除', {
                                btn: ['确定', '取消'] //按钮
                            });
                    if(r==true){
                        $.post("<?php echo e(route('cashierdel')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id },
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
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>