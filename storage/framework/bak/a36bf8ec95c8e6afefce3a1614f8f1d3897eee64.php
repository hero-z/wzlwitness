
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- 内容区域 -->
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl">支付宝当面付账单信息</div>
                <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                </div>
            </div>
            <div class="widget-head am-cf">
                <div class="widget-title am-fl">
                    <form action="<?php echo e(route('scanLs')); ?>" method="get">
                        <select data-am-selected name="status">
                            <option value="1">支付成功</option>
                            <option value="2" >支付失败</option>
                        </select>
                        <button type="submit" class="am-btn am-btn-secondary">筛选</button>
                    </form>
                </div>
            </div>
            <div class="widget-body  widget-body-lg am-fr">

                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black "
                       id="example-r">
                    <thead>
                    <?php if($list['0']==null): ?>
                        <tr><h3>亲,您的账单信息暂时为空哦</h3></tr>
                    <?php else: ?>
                        <tr>
                            <th>时间</th>
                            <th>金额</th>
                            <th>方式</th>
                            <th>状态</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr class="gradeX">
                            <td><?php echo e($v->updated_at); ?></td>
                            <td><?php echo e($v->total_amount); ?></td>
                            <?php if($v->type=="moalipay"||$v->type=="msalipay"): ?>
                                <td>支付宝(扫码枪)</td>
                            <?php endif; ?>
                            <?php if($v->type=="mweixin"): ?>
                                <td>微信(扫码枪)</td>
                            <?php endif; ?>
                            <?php if($v->type=="mpalipay"): ?>
                                <td>平安支付宝(扫码枪)</td>
                            <?php endif; ?>
                            <?php if($v->type=="money"): ?>
                                <td>现金支付</td>
                            <?php endif; ?>
                            <?php if($v->type=="mpweixin"): ?>
                                <td>平安微信(扫码枪)</td>
                            <?php endif; ?>
                            <?php if($v->status=="SUCCESS"||$v->status=="TRADE_SUCCESS"): ?>
                                <td><button type="button" class="am-btn-success">支付成功</button></td>
                            <?php else: ?>
                                <td><button type="button" class="am-btn-danger">支付失败</button></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                    <!-- more data -->
                    </tbody>
                </table>

                <ul class="am-pagination">
                    <?php echo e($list->links()); ?>

                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>