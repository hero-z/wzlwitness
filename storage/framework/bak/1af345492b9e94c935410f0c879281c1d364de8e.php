<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>账单管理</title>
    <meta name="description" content="<?php echo $__env->yieldContent('keywords'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('description'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <script src="<?php echo e(asset('/amazeui/assets/js/echarts.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.datatables.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/app.css')); ?>">
    <script src="<?php echo e(asset('/amazeui/assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/theme.js')); ?>"></script>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body data-type="widgets" class="theme-white">


    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <form method='post' class="am-form tpl-form-line-form" action="<?php echo e(route('datalist')); ?>">
                <div class="am-input-group am-datepicker-date am-u-sm-12 am-u-md-12 am-u-lg-6"
                     data-am-datepicker="{format: 'yyyy-mm-dd', viewMode: 'years'}">
                    <input type="text" class="am-form-field" name="time_start" value="<?php echo e(isset($time_start) ? $time_start : ''); ?>" placeholder="开始日期" >
                    <span class="am-input-group-btn am-datepicker-add-on">
                        <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
                    </span>
                </div>

                <div class="am-input-group  am-datepicker-date am-u-sm-12 am-u-md-12 am-u-lg-6"
                     data-am-datepicker="{format: 'yyyy-mm-dd', viewMode: 'years'}">
                    <input type="text" class="am-form-field" name="time_end" value="<?php echo e(isset($time_end) ? $time_end : ''); ?>"  placeholder="结束日期" >
                    <span class="am-input-group-btn am-datepicker-add-on">
                        <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
                    </span>
                </div>
                <select data-am-selected="{btnSize: 'sm',searchBox: 1,maxHeight: 200}" id="users" name="users" style="display: none;" onchange="change()">
                    <option value="0" >员工归属</option>
                    <?php if($userlists): ?>
                        <?php $__currentLoopData = $userlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                             <option value="<?php echo e($v->id); ?>" <?php if($users&&$users==$v->id): ?> selected <?php endif; ?>><?php echo e($v->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                </select>
                <select data-am-selected="{btnSize: 'sm',searchBox: 1,maxHeight: 200}" id="shop" name="shop" style="display: none;" >
                    <option value="0" >店铺</option>
                    <?php if($shoplists): ?>
                        <?php $__currentLoopData = $shoplists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($v->store_id); ?>" <?php if($shop&&$shop==$v->store_id): ?> selected <?php endif; ?>><?php echo e($v->store_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <?php endif; ?>
                </select>
                <select data-am-selected="{btnSize: 'sm'}" name="store_type" style="display: none;">
                    <option value="0" >支付方式</option>
                    <option value="1" <?php if($store_type&&$store_type=='1'): ?> selected <?php endif; ?> >支付宝</option>
                    <option value="2" <?php if($store_type&&$store_type=='2'): ?> selected <?php endif; ?>>微信</option>
                    <option value="3" <?php if($store_type&&$store_type=='3'): ?> selected <?php endif; ?>>平安银行</option>
                </select>
                <select data-am-selected="{btnSize: 'sm'}" name="status" style="display: none;">
                    <option value="0" >支付状态</option>
                    <option value="1" <?php if($status&&$status=='1'): ?> selected <?php endif; ?>>成功</option>
                    <option value="2" <?php if($status&&$status=='2'): ?> selected <?php endif; ?>>失败</option>
                </select>


                <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">搜索</button>
                <button type="" class="am-btn am-btn-primary tpl-btn-bg-color-success " style="background:gray">导出数据</button>
                <button type="button" class="page-header-button">
                    <span class="am-icon-paint-brush"></span> 总金额：￥<?php echo e($totalje); ?>

                </button>
                <?php echo e(csrf_field()); ?>

            </form>


        </div>
    </div>


    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">账单信息</div>
                    <div class="widget-function am-fr">
                        <a href="javascript:;" class="am-icon-cog"></a>
                    </div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">

                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                        <thead>
                        <tr>
                            <th class="am-u-sm-3">订单号</th>
                            <th class="am-u-sm-3">店名</th>
                            <th class="am-u-sm-2">金额</th>
                            <th class="am-u-sm-2">状态</th>
                            <th class="am-u-sm-2">更新时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($datapage): ?>
                            <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr class="gradeX">
                                    <td class="am-u-sm-3"><?php echo e($v->out_trade_no); ?></td>
                                    <td class="am-u-sm-3"><?php echo e($v->store_name); ?></td>
                                    <td class="am-u-sm-2"><?php echo e($v->total_fee); ?></td>
                                    <?php if($v->status=='SUCCESS'||$v->status=='TRADE_SUCCESS'||$v->status=='JD_SUCCESS'): ?>
                                        <td class="am-u-sm-2"><button type="button" class="am-btn am-btn-success">支付成功</button></td>
                                    <?php else: ?>
                                        <td class="am-u-sm-2"><button type="button" class="am-btn am-btn-danger">支付失败</button></td>
                                    <?php endif; ?>
                                    <td class="am-u-sm-2"><?php echo e($v->updated_at); ?></td>
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
                                <?php if($pagetype==0): ?>
                                    <?php echo e($paginator->appends(['users'=>$users,'shop'=>$shop,'status'=>$status,'store_type'=>$store_type,'time_start'=>$time_start,'time_end'=>$time_end])->render()); ?>

                                <?php elseif($pagetype==1): ?>
                                    <?php echo e($datapage->appends(['users'=>$users,'shop'=>$shop,'status'=>$status,'store_type'=>$store_type,'time_start'=>$time_start,'time_end'=>$time_end])->links()); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>







    <!-- 全局js -->
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/app.js')); ?>"></script>
<script type="text/javascript">
    function change(){

        $('#shop').removeAttr('disabled');
        $.post("<?php echo e(route('getpostdatadp')); ?>", {id:$('#users').val(),_token: "<?php echo e(csrf_token()); ?>"},
                function (data) {
//                    alert(data.list);
                    var str="";
                    for(var i=0;i<data.length;i++){
                        str+="<option value='"+data[i].store_id+"'>"+data[i].store_name+"</option>"
                    }
                    $('#shop option').remove();
                    $("#shop").append('<option value="0">店铺</option>'+str);
//                $("#twoId").html(str);
                }, 'json');

    }

</script>
</body>
</html>