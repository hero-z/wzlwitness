
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="" method="">
            <div class="col-sm-3">
                <div class="input-group">
                    <input placeholder="请输入商户简称" class="input-sm form-control" type="text" name="store_short_name"
                           value="<?php if (isset($where['store_short_name'])) echo $where['store_short_name']; ?>"> <span
                            class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                </div>
            </div>
            <?php echo e(csrf_field()); ?>

        </form>
<?php echo $__env->make('minsheng.common.comlabel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>门店列表</h5>
<?php if(isset($_GET['pid'])&&$_GET['pid']!='0'): ?>
        <a href="<?php echo e(url('/admin/minsheng/BranchAdd?pid='.$_GET['pid'])); ?>">
            <button class="btn btn-success " type="button"><span class="bold">添加分店</span></button>
        </a>
<?php endif; ?>

                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>商户id</th>
                                    <th>商户简称</th>
                                    <th>清算方式</th>
                                    <th>店铺状态</th>
                                    <th>推广员</th>
                                    <th>支付通道</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($store_data): ?>
                                    <?php $__currentLoopData = $store_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($v->store_id); ?></td>
                                            <td><span class="pie"><?php echo e($v->store_short_name); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->cooperator); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->status); ?></span></td>
                                            <td><span class="pie"><?php echo e($v->name); ?></span></td>
                                            <td><span class="pie">
                                                <?php if(!$pay_ways->isEmpty()): ?>
                                                    <?php foreach($pay_ways as $pay_way): ?>
                                                        <?php if($pay_way->store_id==$v->store_id): ?>
                                                            <?php 
                                                                switch($pay_way->pay_way)
                                                                {
                                                                    case 'ZFBZF':
                                                                        switch($pay_way->status)
                                                                        {
                                                                            case 1:
                                                                                echo '<a href="javasecript:;" class="btn btn-outline btn-warning " disabled="disabled" role="button">支付宝审核中</a>';
                                                                                break;
                                                                            case 2:
                                                                                echo '<a href="'.route('ms_store_edit').'?pay_way=WXZF&pay_way_id='.$pay_way->id.'" class="btn btn-outline btn-success" role="button">支付宝</a>';
                                                                                break;
                                                                            case 3:
                                                                                echo '<a href="'.route('ms_saveStoreAdd').'?pay_way=ZFBZF&pay_way_id='.$pay_way->id.'" class="btn btn-outline btn-danger" role="button">支付宝失败：'.$pay_way->remark.'</a>';
                                                                                break;
                                                                        }
                                                                        break;

                                                                    case 'WXZF':
                                                                        switch($pay_way->status)
                                                                        {
                                                                            case 1:
                                                                                echo '<a href="javasecript:;" class="btn btn-outline btn-warning " disabled="disabled"  role="button">微信审核中</a>';
                                                                                break;
                                                                            case 2:
                                                                                echo '<a href="'.route('ms_store_edit').'?pay_way=WXZF&pay_way_id='.$pay_way->id.'" class="btn btn-outline btn-success" role="button">微信</a>';
                                                                                break;
                                                                            case 3:
                                                                                echo '<a href="'.route('ms_saveStoreAdd').'?pay_way=WXZF&pay_way_id='.$pay_way->id.'" class="btn btn-outline btn-danger" role="button">微信进件失败：'.$pay_way->remark.'</a>';
                                                                                break;
                                                                        }
                                                                        break;
                                                                }
                                                             ?>
 
                                                         <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                使用主店的支付通道
                                                <?php endif; ?>
                                            </span></td>
                                            <td>
                                                <a href="<?php echo e(url('admin/minsheng/normalEdit?store_id='.$v->store_id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-success">店铺信息
                                                    </button>
                                                </a>

                                                <?php if($v->pid=='0'): ?>
                                                <a href="<?php echo e(url('admin/minsheng/saveRate?store_id='.$v->store_id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-success">费率修改
                                                    </button>
                                                </a>
                                                <a href="<?php echo e(url('admin/minsheng/storeList?pid='.$v->store_id)); ?>">
                                                    <button type="button" class="btn btn-outline btn-success">分店管理
                                                    </button>
                                                </a>
                                                <a href="javascript:;" onclick="set('<?php echo e($v->store_id); ?>')">
                                                    <button type="button" class="btn btn-outline btn-success">同步授权
                                                    </button>
                                                </a>
                                            <?php endif; ?>
                                                <a href="<?php echo e(url('admin/alipayopen/CashierIndex?store_id='.$v->store_id.'&store_name='.$v->store_short_name)); ?>">
                                                    <button type="button" class="btn btn-outline btn-success">收银员管理
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                <?php else: ?>
                                    <h1>还没有商户入驻</h1>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers"
                                 id="DataTables_Table_0_paginate">
                                <?php echo e($store_data->links()); ?>

                                <!-- $paginator->render()}} -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>


        function set($store_id) {
            $.post(
                "<?php echo e(route('setwxsubappid')); ?>",
                {
                    // 推荐人
                    _token: '<?php echo e(csrf_token()); ?>',
                    store_id: $store_id,


                },
                function (result) {
                    layer.alert(result.a+'<br>'+result.b, {icon: 5});
                }, "json");
        }
    </script>

<?php $__env->stopSection(); ?>








<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>