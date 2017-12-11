
<?php $__env->startSection('title','扫码枪收款'); ?>
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/zeroModal/zeroModal.css')); ?>">
    <script src="<?php echo e(asset('/zeroModal/zeroModal.js')); ?>"></script>
    <div class="row">

        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <?php if(!$MerchantPayWay): ?>
                <div class="am-alert am-alert-warning" data-am-alert="">
                    <button type="button" class="am-close">×</button>
                    <p>你还没有配置收银通道请点击这里(<a href="<?php echo e(route('setWays')); ?>">点我</a>)设置通道</p></div>
            <?php endif; ?>
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">扫码收款</div>
                    <div class="widget-function am-fr">
                        <a href="javascript:;" class="am-icon-cog"></a>
                    </div>
                </div>
                <div class="widget-body am-fr">

                    <form class="am-form tpl-form-line-form" role="form" onsubmit="return typeDate()"
                          action="" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">收款信息</label>
                            <div class="am-u-sm-9">
                                <input class="tpl-form-input" value="<?php echo e($store_name); ?>收款" id="desc" name="desc"
                                       placeholder="请输入商品信息,默认可不填写"
                                       type="text">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">收款金额</label>
                            <div class="am-u-sm-9">
                                <input placeholder="收款金额" id="price" name="price" type="text">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">收款授权码</label>
                            <div class="am-u-sm-9">
                                <input name="code" id="code" placeholder="收款授权码,请连接扫码枪" type="text">
                                <div>

                                </div>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" data-am-modal="{target: '#my-alert'}"
                                        class="am-btn am-btn-primary tpl-btn-bg-color-success ">确认收款
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-fl">最新收款列表</div>
                    <div class="widget-function am-fr">
                        <a href="javascript:;" class="am-icon-cog"></a>
                    </div>
                </div>
                <div class="widget-body  widget-body-lg am-fr">

                    <table class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r"
                           width="100%">
                        <thead>
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
                                <?php if($v->type=="mpingan"): ?>
                                    <td>平安(扫码枪)</td>
                                <?php endif; ?>
                                <?php if($v->status=="SUCCESS"||$v->status=="TRADE_SUCCESS"): ?>
                                    <td><button type="button" class="am-btn am-btn-success">支付成功</button></td>
                                <?php else: ?>
                                    <td><button type="button" class="am-btn am-btn-danger">支付失败</button></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <!-- more data -->
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script>

        $("form").submit(function (e) {
            tmpStr = $.trim($("#price").val());
            code = $.trim($("#code").val());
            tmpStr = parseFloat(tmpStr);
            if (!(tmpStr >= 0.01)) {
                alert("支付金额必须填写一个大于0.01的数");
                $("#price").focus();
                return false;
            }
            if (!code) {
                alert("支付授权码为空,请填写或扫码获取");
                $("#code").focus();//鼠标焦点
                return false;
            }
            $.post("<?php echo e(route('TradePayCodeType')); ?>", {
                    _token: "<?php echo e(csrf_token()); ?>",
                    desc: $("#desc").val(),
                    code: $("#code").val(),
                    price: $("#price").val(),
                },
                function (data) {
                    if (data.status == 1) {
                        zeroModal.success('支付成功!');
                        $("#code").empty();
                        // window.location = "<?php echo e(route('AlipayTradePayCreate')); ?>";
                        return false;
                    } else {
                        zeroModal.error(data.msg);
                        $("#code").empty();
                    }
                }, "json");
            return false;
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amaze', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>