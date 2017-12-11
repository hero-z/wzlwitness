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


    <script src="<?php echo e(asset('/amazeui/assets/js/locales/amazeui.datetimepicker.zh-CN.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.datetimepicker.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.datetimepicker.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/app.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body data-type="widgets" class="theme-white">


    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <form method='post' class="am-form tpl-form-line-form" action="<?php echo e(route('neworderlist')); ?>">
                <div class="am-u-sm-12 am-u-md-12 am-u-lg-2" style="float: right">
                    <a href="<?php echo e(route('datalist')); ?>">
                        <button type='button'  class="am-btn am-btn-primary tpl-btn-bg-color-success " style="float: right;background:#0a0">切换至旧订单</button>
                    </a>
                </div>
                <div class="am-input-group am-datepicker-date am-u-sm-12 am-u-md-12 am-u-lg-2 doc-example">
                    <input size="16" type="text" id="time_start" name="time_start" placeholder="开始日期" value="<?php echo e(isset($time_start) ? $time_start : ''); ?>"  class="form-datetime-lang am-form-field">
                    

                    <script>
                        (function($){
                            // 也可以在页面中引入 amazeui.datetimepicker.zh-CN.js
                            $.fn.datetimepicker.dates['zh-CN'] = {
                                days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
                                daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
                                daysMin:  ["日", "一", "二", "三", "四", "五", "六", "日"],
                                months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                                monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                                today: "今日",
                                suffix: [],
                                meridiem: ["上午", "下午"]
                            };

                            $('.form-datetime-lang').datetimepicker({
                                language:  'zh-CN',
                                format: 'yyyy-mm-dd hh:ii'
                            });
                        }(jQuery));
                    </script>



                </div>
                <div class="am-input-group am-datepicker-date am-u-sm-12 am-u-md-12 am-u-lg-2 doc-example">
                    <input size="16" type="text" id="time_end" name="time_end" placeholder="结束日期" value="<?php echo e(isset($time_end) ? $time_end : ''); ?>"  class="form-datetime-lang am-form-field">
                    

                    <script>
                        (function($){
                            // 也可以在页面中引入 amazeui.datetimepicker.zh-CN.js
                            $.fn.datetimepicker.dates['zh-CN'] = {
                                days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
                                daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
                                daysMin:  ["日", "一", "二", "三", "四", "五", "六", "日"],
                                months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                                monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                                today: "今日",
                                suffix: [],
                                meridiem: ["上午", "下午"]
                            };

                            $('.form-datetime-lang').datetimepicker({
                                language:  'zh-CN',
                                format: 'yyyy-mm-dd hh:ii'
                            });
                        }(jQuery));
                    </script>


                </div>

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
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
                    <select data-am-selected="{btnSize: 'sm'}" name="time" id="time" style="display: none;">
                        <option value="1"  >最近7天</option>
                        <option value="2" <?php if($time&&$time=='2'): ?> selected <?php endif; ?> >今日(至当前时间)</option>
                        <option value="3" <?php if($time&&$time=='3'): ?> selected <?php endif; ?> >昨日</option>
                        <option value="4" <?php if($time&&$time=='4'): ?> selected <?php endif; ?> >当月(至当前时间)</option>
                        <option value="5" <?php if($time&&$time=='5'): ?> selected <?php endif; ?> >上月</option>
                        <option value="9" <?php if($time&&$time=='9'): ?> selected <?php endif; ?> >自主选择日期</option>
                    </select>
                </div>
                <div class="am-input-group  am-datepicker-date am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <select data-am-selected="{btnSize: 'sm'}" id="pay_source" name="pay_source"  style="display: none;" onchange="changeSelect()" >
                        <option value="0" >订单来源</option>
                        <option value="1" <?php if($pay_source&&$pay_source=='1'): ?> selected <?php endif; ?>  >扫码枪</option>
                        <option value="2" <?php if($pay_source&&$pay_source=='2'): ?> selected <?php endif; ?>>二维码</option>
                    </select>
                    <select data-am-selected="{btnSize: 'sm'}" id="store_type" name="store_type" style="display: none;">
                        <option value="0">支付方式</option>
                        <?php if($paylists): ?>
                            <?php $__currentLoopData = $paylists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($k); ?>" <?php if($store_type&&$store_type==$k): ?> selected <?php endif; ?>><?php echo e($v); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <select data-am-selected="{btnSize: 'sm'}" name="status" id="status"  style="display: none;">
                        <option value="0" >成功订单</option>
                        <option value=2 <?php if($status&&$status=='2'): ?> selected <?php endif; ?> >取消支付</option>
                        <option value=3 <?php if($status&&$status=='3'): ?> selected <?php endif; ?> >等待支付</option>
                        <option value=4 <?php if($status&&$status=='4'): ?> selected <?php endif; ?> >订单关闭</option>
                        <option value=5 <?php if($status&&$status=='5'): ?> selected <?php endif; ?> >已退款</option>
                        <option value=9 <?php if($status&&$status=='9'): ?> selected <?php endif; ?> >全部订单</option>
                    </select>
                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">搜索</button>
                    <button type='button' onclick="exportdata()" class="am-btn am-btn-primary tpl-btn-bg-color-success " style="background:gray">导出数据</button>

                </div>



                <button type="button" class="page-header-button">
                    <span class="am-icon-paint-brush" id="totalje">总金额：计算中...</span>
                    
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
                            <th class="am-u-sm-2">订单号</th>
                            <th class="am-u-sm-2">店铺ID</th>
                            <th class="am-u-sm-1">店铺名</th>
                            <th class="am-u-sm-1">金额</th>
                            <th class="am-u-sm-1">状态</th>
                            <th class="am-u-sm-1">支付类型</th>
                            <th class="am-u-sm-1">员工</th>
                            <th class="am-u-sm-1">备注</th>
                            
                            <th class="am-u-sm-2">更新时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($list): ?>
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr class="gradeX">
                                    <td class="am-u-sm-2" style="word-wrap:break-word"><?php echo e($v->out_trade_no); ?></td>
                                    <td class="am-u-sm-2"><?php echo e($v->store_id); ?></td>
                                    <td class="am-u-sm-1"><?php if($allstore_names&&isset($allstore_names[$v->store_id])): ?><?php echo e($allstore_names[$v->store_id]); ?><?php endif; ?></td>
                                    <td class="am-u-sm-1"><?php echo e($v->total_amount); ?></td>
                                    <td class="am-u-sm-1">
                                        <?php if($v->pay_status==1): ?>
                                            <button type="button" class="am-btn-success">支付成功</button>
                                        <?php elseif($v->pay_status==2): ?>
                                            <button type="button" class="am-btn-danger">取消支付</button>
                                        <?php elseif($v->pay_status==3): ?>
                                            <button type="button" class="am-btn-danger">等待支付</button>
                                        <?php elseif($v->pay_status==4): ?>
                                            <button type="button" class="am-btn-danger">订单关闭</button>
                                        <?php elseif($v->pay_status==5): ?>
                                            <button type="button" class="am-btn-danger">已退款 </button>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-u-sm-1">
                                        <?php if($v->type==101): ?>
                                            支付宝当面付
                                        <?php elseif($v->type==102): ?>
                                            支付宝口碑
                                        <?php elseif($v->type==103): ?>
                                            当面付机具
                                        <?php elseif($v->type==104): ?>
                                            当面付固定码
                                        <?php elseif($v->type==105): ?>
                                            口碑机具
                                        <?php elseif($v->type==106): ?>
                                            口碑固定金额
                                        <?php elseif($v->type==201): ?>
                                            微信
                                        <?php elseif($v->type==202): ?>
                                            微信机具
                                        <?php elseif($v->type==203): ?>
                                            微信固定码
                                        <?php elseif($v->type==301): ?>
                                            平安支付宝
                                        <?php elseif($v->type==302): ?>
                                            平安微信
                                        <?php elseif($v->type==303): ?>
                                            平安京东
                                        <?php elseif($v->type==304): ?>
                                            平安翼支付
                                        <?php elseif($v->type==305): ?>
                                            平安支付宝机具
                                        <?php elseif($v->type==306): ?>
                                            平安微信机具
                                        <?php elseif($v->type==307): ?>
                                            平安京东机具
                                        <?php elseif($v->type==401): ?>
                                            银联扫码固定码
                                        <?php elseif($v->type==402): ?>
                                            银联扫码机具
                                        <?php elseif($v->type==501): ?>
                                            民生支付宝
                                        <?php elseif($v->type==502): ?>
                                            民生微信
                                        <?php elseif($v->type==503): ?>
                                            民生QQ钱包
                                        <?php elseif($v->type==601): ?>
                                            浦发支付宝
                                        <?php elseif($v->type==602): ?>
                                            浦发微信
                                        <?php elseif($v->type==603): ?>
                                            浦发支付宝机具
                                        <?php elseif($v->type==604): ?>
                                            浦发微信机具
                                        <?php elseif($v->type==701): ?>
                                            现金
                                        <?php endif; ?>

                                    </td>
                                    <td class="am-u-sm-1">
                                        <?php 

                                            if(isset($store_user[$v->store_id])&&isset($user_id[$store_user[$v->store_id]]))
                                            {
                                                echo ($user_id[$store_user[$v->store_id]]);
                                            }
                                            else
                                            {
                                                echo '店铺收款';
                                            }


                                         ?>

                                    </td>
                                    <td class="am-u-sm-1"><?php echo e($v->remark); ?></td>
                                    
                                    <td class="am-u-sm-2"><?php echo e($v->updated_at); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php endif; ?>
                        <!-- more data -->
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-2" id="counts">共计:<?php echo e($counts); ?>条</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers"
                                 id="DataTables_Table_0_paginate">
                                <?php if($list): ?>
                                    <?php echo e($list->appends(['users'=>$users,'shop'=>$shop,'status'=>$status,'pay_source'=>$pay_source,'store_type'=>$store_type,'time'=>$time,'time_start'=>$time_start,'time_end'=>$time_end])->render()); ?>

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
        $.post("<?php echo e(route('getdplist')); ?>", {id:$('#users').val(),_token: "<?php echo e(csrf_token()); ?>"},
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
    function changeSelect(){

        $.post("<?php echo e(route('getadminPaylist')); ?>", {id:$('#pay_source').val(),_token: "<?php echo e(csrf_token()); ?>"},
                function (data) {
                    var str="";
                    for(var i=0;i<data.length;i++){
                        str+="<option value='"+data[i].id+"'>"+data[i].value+"</option>"
                    }
                    $('#store_type option').remove();
                    $("#store_type").append('<option value="0">支付方式</option>'+str);
                }, 'json');

    }
    function exportdata() {
        window.location.href="<?php echo e(route('orderexportdata')); ?>"+"?users="+$('#users').val()+"&shop="+$('#shop').val()+"&time="+$('#time').val()+"&pay_source="+$('#pay_source').val()+"&status="+$('#status').val()+"&store_type="+$('#store_type').val()+"&time_end="+$('#time_end').val()+"&time_start="+$('#time_start').val();
        
                    

                    
                    
                    
                    
                    
                    
                    
                    
                
                

                

    }

</script>

    <script>
        $(function(){
            $.post("<?php echo e(route('gettotalamount')); ?>", {
                _token: "<?php echo e(csrf_token()); ?>",

                users:$('#users').val(),
                shop:$('#shop').val(),
                time:$('#time').val(),
                pay_source:$('#pay_source').val(),
                store_type:$('#store_type').val(),
                status:$('#status').val(),
                time_end:$('#time_end').val(),
                time_start:$('#time_start').val()
            },
            function (data) {
                $('#totalje').html('总金额：'+data.totalje);
            }, 'json');
        })

    </script>
</body>
</html>