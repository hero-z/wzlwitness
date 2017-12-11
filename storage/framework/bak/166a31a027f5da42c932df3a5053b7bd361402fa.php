
<?php $__env->startSection('content'); ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>交易流水
                <small>所有微信支付订单的查询，商户可以通过该接口主动查询订单状态</small>
            </h5>
        </div>
        <div class="ibox-content">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline" role="grid">
                <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
                       id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 189px;" aria-label="渲染引擎：激活排序列升序" aria-sort="ascending">商户订单号
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 308px;" aria-label="平台：激活排序列升序">店铺ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 308px;" aria-label="平台：激活排序列升序">店铺名称
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
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">订单来源
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">交易状态
                        </th>
                    </tr>
                    </thead>
                    <tbody id="appends">
                    <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr class='gradeA odd'>
                            <td class=''><?php echo e($v->out_trade_no); ?></td>
                            <td class=''><?php echo e($v->store_id); ?></td>
                            <td class=''><?php echo e($v->store_name); ?></td>
                            <td class=''><?php echo e($v->created_at); ?></td>
                            <td class=''><?php echo e($v->updated_at); ?></td>
                            <td class=''><?php echo e($v->total_amount); ?></td>
                            <?php if($v->type==1): ?>
                                <td class=''>支付宝</td>
                            <?php endif; ?>

                            <?php if($v->type==2): ?>
                                <td class=''>微信</td>
                            <?php endif; ?>
                            <?php if($v->status=="1"): ?>
                                <td style="color: green">
                                    <button type="button" class="btn btn-outline btn-success">等待付款</button>
                                </td>
                            <?php endif; ?>
                            <?php if($v->status=="2"): ?>
                                <td style="color: green">
                                    <button type="button" class="btn btn-outline btn-success">付款成功</button>
                                </td>
                            <?php endif; ?>
                            <?php if($v->status=="3"): ?>
                                <td style="color: green">
                                    <button type="button" class="btn btn-outline btn-success">付款失败</button>
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
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>