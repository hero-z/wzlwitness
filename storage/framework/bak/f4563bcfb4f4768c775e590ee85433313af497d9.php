
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">

    <script src="<?php echo e(asset('/amazeui/assets/js/jquery.min.js')); ?>"></script>
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <script src="<?php echo e(asset('/amazeui/assets/js/echarts.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.datatables.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/app.css')); ?>">
    <script src="<?php echo e(asset('/amazeui/assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/theme.js')); ?>"></script>


    <script src="<?php echo e(asset('/amazeui/assets/js/locales/amazeui.datetimepicker.zh-CN.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.datetimepicker.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/amazeui.datetimepicker.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('/amazeui/assets/css/app.css')); ?>">
    

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title','账单流水信息'); ?>

<?php $__env->startSection('content'); ?>

    
        
        <!-- 内容区域 -->

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form method='post' class="am-form tpl-form-line-form" action="<?php echo e(route('orderlistssearch')); ?>">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-2" style="float: right">
                        <a href="<?php echo e(route('neworderlists')); ?>">
                            <button type='button'  class="am-btn am-btn-primary tpl-btn-bg-color-success " style="float: right;background:green">切换至新订单</button>
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
                        <select data-am-selected="{btnSize: 'sm',searchBox: 1,maxHeight: 200}" id="shop_branch" name="shop_branch"  style="display: none;" onchange="change()">
                            <option value="0" >店铺</option>
                            <?php if($shoplistmain): ?>
                                <?php $__currentLoopData = $shoplistmain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($v->store_id); ?>" <?php if($shop_branch&&$shop_branch==$v->store_id): ?> selected <?php endif; ?>><?php echo e(('[总店]').$v->store_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                            <?php if($shoplists): ?>
                                <?php $__currentLoopData = $shoplists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($v->store_id); ?>" <?php if($shop_branch&&$shop_branch==$v->store_id): ?> selected <?php endif; ?>><?php echo e(('[分店]').$v->store_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <select data-am-selected="{btnSize: 'sm',searchBox: 1,maxHeight: 200 }"  id="shop_cashier" name="shop_cashier"  style="display: none;" >
                            <option value="0" >收银员</option>
                            <?php if($userlists): ?>
                                <?php $__currentLoopData = $userlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($v->id); ?>" <?php if($shop_cashier&&$shop_cashier==$v->id): ?> selected <?php endif; ?>><?php echo e($v->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <select data-am-selected="{btnSize: 'sm'}" name="time"  style="display: none;">
                            <option value="0"  >快速选择日期</option>
                            <option value="1" <?php if($time&&$time=='1'): ?> selected <?php endif; ?> >今日(至当前时间)</option>
                            <option value="2" <?php if($time&&$time=='2'): ?> selected <?php endif; ?> >昨日</option>
                            <option value="3" <?php if($time&&$time=='3'): ?> selected <?php endif; ?> >当月(至当前时间)</option>
                            <option value="4" <?php if($time&&$time=='4'): ?> selected <?php endif; ?> >上月</option>
                        </select>

                    </div>
                    <div class="am-input-group am-u-sm-12 am-u-md-12 am-u-lg-12">
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
                        <select data-am-selected="{btnSize: 'sm'}" name="status"  style="display: none;">
                            <option value="0"  >成功订单</option>
                            <option value="1" <?php if($status&&$status=='1'): ?> selected <?php endif; ?> >失败订单</option>
                            <option value="2" <?php if($status&&$status=='2'): ?> selected <?php endif; ?> >全部订单</option>
                        </select>


                        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">搜索</button>
                        <button type='button' onclick="exportdata()" class="am-btn am-btn-primary tpl-btn-bg-color-success " style="background:gray">导出数据</button>
                    </div>

                    <button type="button" class="page-header-button">
                        <span class="am-icon-paint-brush"></span> 总金额：￥<?php echo e($totalje); ?>

                    </button>



                    <?php echo e(csrf_field()); ?>

                </form>
            </div>
        </div>
        <div class="row">

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
                                        <th class="am-u-sm-3">金额</th>
                                        <th class="am-u-sm-2">支付方式</th>
                                        <th class="am-u-sm-2">状态</th>
                                        <th class="am-u-sm-2">更新时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($datapage): ?>
                                        <?php $__currentLoopData = $datapage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <tr class="gradeX">
                                                <td class="am-u-sm-3"><?php echo e($v->out_trade_no); ?></td>
                                                
                                                <td class="am-u-sm-3"><?php echo e($v->total_fee); ?></td>
                                                <td class="am-u-sm-2">
                                                <?php if($v->type=='oalipay'): ?>
                                                    当面付
                                                <?php elseif($v->type=='salipay'): ?>
                                                    口碑
                                                <?php elseif($v->type=='weixin'): ?>
                                                    微信
                                                <?php elseif($v->type=='alipay'): ?>
                                                    支付宝
                                                <?php elseif($v->type=='jd'): ?>
                                                    京东
                                                <?php elseif($v->type=='bestpay'): ?>
                                                    翼支付
                                                <?php elseif($v->type=='moalipay'||$v->type=='mpalipay'): ?>
                                                    支付宝机具
                                                <?php elseif($v->type=='mweixin'||$v->type=='mpweixin'): ?>
                                                    微信机具
                                                <?php elseif($v->type=='money'): ?>
                                                    现金
                                                <?php endif; ?>
                                                </td>
                                                <?php if($v->status=='SUCCESS'||$v->status=='TRADE_SUCCESS'||$v->status=='JD_SUCCESS'): ?>
                                                    <td class="am-u-sm-2"><button type="button" class="am-btn-success">支付成功</button></td>
                                                <?php else: ?>
                                                    <td class="am-u-sm-2"><button type="button" class="am-btn-danger">支付失败</button></td>
                                                <?php endif; ?>
                                                <td class="am-u-sm-2"><?php echo e($v->updated_at); ?></td>
                                            </tr>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php endif; ?>
                                    <!-- more data -->
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-2">共计:<?php echo e($counts); ?>条</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                             id="DataTables_Table_0_paginate">
                                            <?php if($paginator): ?>
                                                <?php echo e($paginator->appends(['shop_branch'=>$shop_branch,'shop_cashier'=>$shop_cashier,'status'=>$status,'pay_source'=>$pay_source,'store_type'=>$store_type,'time'=>$time,'time_start'=>$time_start,'time_end'=>$time_end])->render()); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
    <script type="text/javascript">
        function change(){

            $.post("<?php echo e(route('getpostdatamerchantCashier')); ?>", {id:$('#shop_branch').val(),_token: "<?php echo e(csrf_token()); ?>"},
                    function (data) {
                        var str="";
                        for(var i=0;i<data.length;i++){
                            str+="<option value='"+data[i].id+"'>"+data[i].name+"</option>"
                        }
                        $('#shop_cashier option').remove();
                        $("#shop_cashier").append('<option value="0">收银员</option>'+str);
                    }, 'json');

        }
        function changeSelect(){

            $.post("<?php echo e(route('getpostdatamerchantPaylist')); ?>", {id:$('#pay_source').val(),_token: "<?php echo e(csrf_token()); ?>"},
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
            window.location.href="<?php echo e(route('expexceldata')); ?>";
        }
    </script>
        <script>

            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?b424d39312c46404f15e22574a531fbb";
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hm);
            })();

            (function(w, d, s) {
                function gs(){
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(w , d, s ,'//www.google-analytics.com/analytics.js','ga');
                    ga('create', 'UA-34196034-8', 'amazeui.org');
                    ga('send', 'pageview');
                }
                if (w.addEventListener) { w.addEventListener('load', gs, false); }
                else if (w.attachEvent) { w.attachEvent('onload',gs); }
            }(window, document, 'script'));
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>