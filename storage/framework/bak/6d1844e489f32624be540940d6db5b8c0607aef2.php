
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title','微众银行流水信息'); ?>
<?php $__env->startSection('content'); ?>


    <!-- 内容区域 -->

    <div class="row">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">微众账单信息</div>
                    <div class="widget-function am-fr">
                        <a href="javascript:;" class="am-icon-cog"></a>
                    </div>
                </div>
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">
                        <form action="<?php echo e(route('webankmerchantls')); ?>" method="get">
                            <select data-am-selected name="status">
                                <option value="1" <?php if($status=="1"): ?> selected <?php endif; ?>>支付成功</option>
                                <option value="2" <?php if($status=="2"): ?> selected <?php endif; ?>>取消支付</option>
                                <option value="3" <?php if($status=="3"): ?> selected <?php endif; ?>>等待支付</option>
                                <option value="4" <?php if($status=="4"): ?> selected <?php endif; ?>>订单关闭</option>
                                <option value="5" <?php if($status=="5"): ?> selected <?php endif; ?>>已退款</option>
                            </select>
                            <button type="submit" class="am-btn am-btn-secondary">筛选</button>
                        </form>
                    </div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">

                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                        <tr>
                            <th class="am-u-sm-2">订单号</th>
                            <th class="am-u-sm-2">店铺名</th>
                            <th class="am-u-sm-2">收银员</th>
                            <th class="am-u-sm-1">金额</th>
                            <th class="am-u-sm-1">来源</th>
                            <th class="am-u-sm-1">状态</th>
                            <th class="am-u-sm-2">更新时间</th>
                            <th class="am-u-sm-1">备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($list): ?>
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr class="gradeX">
                                    <td class="am-u-sm-2"><?php echo e($v->out_trade_no); ?></td>
                                    <td class="am-u-sm-2">
                                        <?php if($storenames&&isset($storenames[$v->store_id])): ?>
                                        <?php echo e($storenames[$v->store_id]); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="am-u-sm-2">
                                        <?php if($v->merchant_id&&isset($cashier[$v->merchant_id])): ?>
                                            <?php echo e($cashier[$v->merchant_id]); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="am-u-sm-1"><?php echo e($v->total_amount); ?></td>
                                    <?php if($v->type=="801"): ?>
                                        <td class="am-u-sm-1">微众支付宝二维码</td>
                                    <?php endif; ?>
                                    <?php if($v->type=="802"): ?>
                                        <td class="am-u-sm-1">微众微信二维码</td>
                                    <?php endif; ?>
                                    <?php if($v->type=="803"): ?>
                                        <td class="am-u-sm-1">微众支付宝扫码枪</td>
                                    <?php endif; ?>
                                    <?php if($v->type=="804"): ?>
                                        <td class="am-u-sm-1">微众微信扫码枪</td>
                                    <?php endif; ?>
                                    <?php if($v->pay_status=="1"): ?>
                                        <td class="am-u-sm-1 "><button type="button" class="am-btn-success">支付成功</button></td>
                                    <?php endif; ?>
                                    <?php if($v->pay_status=="2"): ?>
                                        <td class="am-u-sm-1"><button type="button" class="am-btn-danger">取消支付</button></td>
                                    <?php endif; ?>
                                    <?php if($v->pay_status=="3"): ?>
                                        <td class="am-u-sm-1"><button type="button" class="am-btn-danger">等待支付</button></td>
                                    <?php endif; ?>
                                    <?php if($v->pay_status=="4"): ?>
                                        <td class="am-u-sm-1"><button type="button" class="am-btn-danger">订单关闭</button></td>
                                    <?php endif; ?>
                                    <?php if($v->pay_status=="5"): ?>
                                        <td class="am-u-sm-1"><button type="button" class="am-btn-danger">已退款</button></td>
                                    <?php endif; ?>
                                    <?php if($v->pay_status==""): ?>
                                        <td class="am-u-sm-1"><button type="button" class="am-btn-danger">支付失败</button></td>
                                    <?php endif; ?>
                                    <td class="am-u-sm-2"><?php echo e($v->updated_at); ?></td>
                                    <td class="am-u-sm-1"><?php echo e($v->remark); ?></td>
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
                                <?php if($list): ?>   <?php echo e($list->appends(['status'=>$status])->links()); ?><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>