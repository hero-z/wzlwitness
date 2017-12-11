
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('restore'); ?>
    <div class="ibox-content">
        <div class="row">
            <form action="<?php echo e(route('webankRestore')); ?>" method="post">
                <div class="col-sm-3">
                    <div class="input-group">
                        <input placeholder="请输入商户简称" <?php if(isset($alias_name)): ?>value="<?php echo e($alias_name); ?>"<?php endif; ?> class="input-sm form-control" type="text" name="alias_name"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                    </div>
                </div>
                <?php echo e(csrf_field()); ?>

            </form>
            
            <a class="J_menuItem" href="<?php echo e(route('QrLists')); ?>"> <button type="button" class="btn btn-outline btn-default">我的商户码</button></a>
            <a class="J_menuItem" href="<?php echo e(route('webankindex')); ?>"> <button type="button" class="btn btn-outline btn-default">商户流水</button></a>
            <?php if (\Entrust::can('webankconfig')) : ?>
            <a class="J_menuItem" href="<?php echo e(route('webankconfig')); ?>"> <button type="button" class="btn btn-outline btn-default">银行通道配置</button></a>
            <?php endif; // Entrust::can ?>
        </div>
        <form action="<?php echo e(route("webankallstoreback")); ?>" method="post">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>商户id</th>
                        <th>商户简称</th>
                        <th>联系人名称</th>
                        <th>联系人手机号</th>
                        
                        <th>归属员工</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($data): ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td>
                                <div class="icheckbox_square-green"><input type="checkbox"  name="data[]" value="<?php echo e($v->id); ?>"></div>
                            </td>
                            <td><?php echo e($v['store_id']); ?></td>
                            
                            <td><span class="pie"><?php echo e($v['alias_name']); ?></span></td>
                            <td><?php echo e($v['contact_name']); ?></td>
                            <td><span class="pie"><?php echo e($v['contact_phone_no']); ?></span></td>
                            
                            <td><span class="pie"><?php if($users&&$users[$v->user_id]): ?><?php echo e($users[$v->user_id]); ?><?php endif; ?></span></td>
                            <td>
                                <?php if (\Entrust::can("webankRestore")) : ?>
                                <a href="<?php echo e(route('webankstoreback',['id'=>$v->store_id])); ?>"> <button class="btn btn-primary" type="button">还原</button></a>
                                <?php endif; // Entrust::can ?>
                                <?php if (\Entrust::can("dropwebankstore")) : ?>
                                <button onclick='del("<?php echo e($v['id']); ?>")' class="btn btn-danger" type="button">彻底删除</button>
                                <?php endif; // Entrust::can ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit">还原选中</button>
                <ul class="am-pagination pull-right" style="margin-top:-20px;">
                    <?php if($data): ?>
                        <?php echo e($data->appends(['alias_name'=>$alias_name])->links()); ?>

                    <?php endif; ?>
                </ul>
            </div>
            <?php echo e(csrf_field()); ?>

        </form>
    </div>
    <script type="text/javascript">
        function del(id) {
            //询问框
            // alert(id);
            layer.confirm('确定要彻底删除', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post("<?php echo e(route('pinganDelete')); ?>", {_token: "<?php echo e(csrf_token()); ?>", id: id},
                        function (data) {
                            if(data.success){
                                window.location.href = "<?php echo e(route('pinganRestore')); ?>";
                            }else{
                                layer.msg("删除失败,请检查是否有权限")
                            }

                        }, "json");
            }, function () {

            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>