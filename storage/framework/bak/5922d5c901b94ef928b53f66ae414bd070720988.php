
<?php $__env->startSection('content'); ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>交易流水
                <small>所有支付宝支付订单的查询，商户可以通过该接口主动查询订单状态</small>
            </h5>
        </div>
        <div class="ibox-content">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline" role="grid">
                <table style="Word-break: break-all;" class="table table-striped table-bordered table-hover dataTables-example dataTable"
                       id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr role="row">

                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 333px;" aria-label="浏览器：激活排序列升序">支付宝交易号
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 308px;" aria-label="平台：激活排序列升序">店铺ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">商户名称
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">收银员
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 142px;" aria-label="引擎版本：激活排序列升序">创建时间
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">更新时间
                        </th>

                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">总金额
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 189px;" aria-label="渲染引擎：激活排序列升序" aria-sort="ascending">订单来源
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">交易状态
                        </th>
                    </tr>
                    </thead>
                    <tbody id="appends">
                    <?php if($datapage): ?>
                        <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr class='gradeA odd'>
                                <td class=''><?php echo e($v->trade_no); ?></td>
                                <td class=''><?php echo e($v->store_id); ?></td>
                                <td class=''><?php echo e($v->main_shop_name); ?></td>
                                <td class=''><?php echo e($v->merchant_name); ?></td>
                                <td class=''><?php echo e($v->created_at); ?></td>
                                <td class=''><?php echo e($v->updated_at); ?></td>
                                <td class=''><?php echo e($v->total_amount); ?></td>
                                <?php if($v->type=="oalipay"): ?>
                                <td class=''>二维码当面付</td>
                                <?php endif; ?>
                                <?php if($v->type=="salipay"): ?>
                                    <td class=''>二维码口碑</td>
                                <?php endif; ?>
                                <?php if($v->type=="moalipay"): ?>
                                    <td class=''>扫码枪当面付</td>
                                <?php endif; ?>
                                <?php if($v->type=="money"): ?>
                                    <td class=''>现金支付</td>
                                <?php endif; ?>
                                <?php if($v->type=="msalipay"): ?>
                                    <td class=''>扫码枪口碑</td>
                                <?php endif; ?>
                                <?php if($v->status=="9000"||$v->status=='TRADE_SUCCESS'||$v->status=="SUCCESS"): ?>
                                    <td style="color: green">
                                        <button type="button" class="btn btn-outline btn-success">付款成功</button>
                                    </td>
                                <?php else: ?>
                                    <td class=''>
                                        <button type="button" class="btn btn-outline btn-danger">等待买家付款</button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <?php echo e($paginator->render()); ?>

                        </div>
                    </div>
                </div>

                <?php else: ?>
                    <div class="row">
                        没有任何交易记录
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>