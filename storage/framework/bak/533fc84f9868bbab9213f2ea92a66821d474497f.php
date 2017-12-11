
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>门店列表</h5>
                    </div>
                    <form action="<?php echo e(route("webankindex")); ?>" method="post">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input placeholder="请输入商户简称" <?php if(isset($alias_name)): ?>value="<?php echo e($alias_name); ?>" <?php endif; ?> class="input-sm form-control" type="text" name="alias_name"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </form>

                    <?php if (\Entrust::can("webankRestore")) : ?>
                    <a href="<?php echo e(route("webankRestore")); ?>"> <button type="button" class="btn btn-outline btn-default">还原商户</button></a>
                    <?php endif; // Entrust::can ?>
                    <a class="J_menuItem" href="<?php echo e(route('webankqrlist')); ?>"> <button type="button" class="btn btn-outline btn-default">我的商户码</button></a>
                    <a class="J_menuItem" href="<?php echo e(route('webankorderlist')); ?>"> <button type="button" class="btn btn-outline btn-default">商户流水</button></a>
                    
                    <?php if (\Entrust::can('webankconfig')) : ?>
                    <a class="J_menuItem" href="<?php echo e(route('webankconfig')); ?>"> <button type="button" class="btn btn-outline btn-default">银行通道配置</button></a>
                    
                    <?php endif; // Entrust::can ?>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>商户id</th>
                                    <th>商户简称</th>
                                    <th>联系人名称</th>
                                    <th>联系人手机号</th>
                                    <th>归属员工</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($datapage): ?>
                                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->store_id); ?></td>
                                            <td><span class="pie"><?php echo e($v->alias_name); ?></span></td>
                                            <td><?php echo e($v->contact_name); ?></td>
                                            <td><span class="pie"><?php echo e($v->contact_phone_no); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->name); ?></span></td>
                                            <td>
                                                <?php if (\Entrust::can("webankStoreInfo")) : ?>
                                                <a href="<?php echo e(route('webankeditcode',['store_id'=>$v->store_id])); ?>">
                                                    <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                                </a>
                                                <?php endif; // Entrust::can ?>
                                                
                                                    
                                                
                                                <a href="<?php echo e(route('webankmerchantfile',['id'=>$v->store_id])); ?>">
                                                    <button type="button" class="btn btn-outline btn-info">商户资料</button>
                                                </a>
                                                <?php if (\Entrust::can("webankEditStore")) : ?>
                                                <a href="<?php echo e(route('webankeditmerchantfile',['store_id'=>$v->store_id])); ?>">
                                                    <button type="button" class="btn btn-outline btn-primary">修改店铺信息
                                                    </button>
                                                </a>
                                                <?php endif; // Entrust::can ?>
                                                <?php if($v->pid==0): ?>
                                                    <?php if (\Entrust::can("webankBranch")) : ?>
                                                    <a href="<?php echo e(route('webankbranchlist',['pid'=>$v->id])); ?>">
                                                        <button type="button" class="btn btn-outline btn-primary">分店管理
                                                        </button>
                                                    </a>
                                                    <?php endif; // Entrust::can ?>
                                                <?php endif; ?>
                                                <?php if (\Entrust::can("webankCashier")) : ?>
                                                <a href="<?php echo e(route('webankcashierlist',['store_id'=>$v->store_id,'store_name'=>$v->alias_name])); ?>">
                                                    <button type="button" class="btn btn-outline btn-primary">收银员管理
                                                    </button>
                                                </a>
                                                <?php endif; // Entrust::can ?>
                                                <?php if (\Entrust::can("webankpayStatus")) : ?>
                                                <?php if($v->pay_status==1): ?>
                                                    <button id="cpay" onclick='co("<?php echo e($v->store_id); ?>",0)' type="button"
                                                            class="btn btn-outline btn-warning">关闭收款
                                                    </button>
                                                <?php endif; ?>
                                                <?php if($v->pay_status==0): ?>
                                                    <button id="opay" onclick='co("<?php echo e($v->store_id); ?>",1)' type="button"
                                                            class="btn btn-outline btn-warning">开启收款
                                                    </button>
                                                <?php endif; ?>
                                                <?php endif; // Entrust::can ?>
                                                <?php if (\Entrust::can("Delwebank")) : ?>
                                                <button onclick='del("<?php echo e($v->store_id); ?>")' type="button"
                                                        class="btn btn-outline btn-warning">删除
                                                </button>
                                                <?php endif; // Entrust::can ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers"
                                 id="DataTables_Table_0_paginate">
                                <?php if($paginator): ?>
                                <?php echo e($paginator->appends(['alias_name'=>$alias_name])->render()); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        没有任何记录
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function del(id) {
            //询问框
            layer.confirm('确定要删除', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post("<?php echo e(route('DelWebankstore')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                        function (data) {
                            if(data.success){
                                window.location.href = "<?php echo e(route('webankindex')); ?>";
                            }else{
                                layer.msg(data.erro_message)
                            }
                        }, "json");
            }, function () {

            });
        }


        function co(id, type) {
            if (type == 0) {
                //询问框
                layer.confirm('确定要关闭此商户的收款功能', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post("<?php echo e(route('Webankpaystatus')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id, type: type},
                            function (data) {
                                window.location.href = "<?php echo e(route('webankindex')); ?>";
                            }, "json");
                }, function () {

                });
            } else {
                //询问框
                layer.confirm('确定要开启此商户的收款功能', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post("<?php echo e(route('Webankpaystatus')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id, type: type},
                            function (data) {
                                window.location.href = "<?php echo e(route('webankindex')); ?>";
                            }, "json");
                }, function () {

                });
            }

        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>