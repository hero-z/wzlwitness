
<?php $__env->startSection('title','绑定银行账号'); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <script src="<?php echo e(asset('/js/check.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript">
        /*document.body.onpaste=function(){return false}*/
    </script>
    <div class="col-sm-6">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>绑定结算银行账号</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="post">
                            
                            <input type="hidden" id="id_type" value="<?php echo e($id_type); ?>">
                            <input type="hidden" id="id_no" value="<?php echo e($id_no); ?>">
                            <input type="hidden" id="merchant_name" value="<?php echo e($merchant_name); ?>">
                            <input type="hidden" id="merchant_type_code" value="<?php echo e($merchant_type_code); ?>">
                            <input type="hidden" id="licence_no" value="<?php echo e($licence_no); ?>">
                            <input type="hidden" id="category_id" value="<?php echo e($category_id); ?>">
                            <input type="hidden" id="alias_name" value="<?php echo e($alias_name); ?>">
                            <input type="hidden" id="address" value="<?php echo e($address); ?>">
                            <input type="hidden" id="contact_name" value="<?php echo e($contact_name); ?>">
                            <input type="hidden" id="contact_phone" value="<?php echo e($contact_phone); ?>">
                            <input type="hidden" id="service_phone" value="<?php echo e($service_phone); ?>">
                            <input type="hidden" id="user_id" value="<?php echo e($user_id); ?>">
                            <input type="hidden" id="province_code" value="<?php echo e($province_code); ?>">
                            <input type="hidden" id="city_code" value="<?php echo e($city_code); ?>">
                            <input type="hidden" id="district_code" value="<?php echo e($district_code); ?>">
                            <input type="hidden" id="district" value="<?php echo e($district); ?>">
                            <input type="hidden" id="code_number" value="<?php echo e($code_number); ?>">
                            <input type="hidden" id="store_id" value="<?php echo e($store_id); ?>">
                            <input type="hidden" id="code_from" value="<?php echo e($code_from); ?>">
                            <div class="form-group">
                                <label>请输入银行卡卡号</label>
                                <input required placeholder="银行卡卡号" class="form-control" value="" name="account_no"
                                       id="account_no"
                                       type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>请重新输入银行卡卡号</label>
                                <input required placeholder="重新输入银行卡卡号" onpaste="return false"  class="form-control" value="" id="card_repeat"
                                       type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>账户开户行:</label>
                                <div class="row">
                                    <select class="form-control m-b" value=""  name="account_info" id="account_info">
                                        <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($v->bank_no.'**'.$v->bank_name); ?>"><?php echo e($v->bank_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <label>请输入开户户名</label>
                                <input required="required" placeholder="开户户名" value="" class="form-control"
                                       name="account_name" id="account_name"
                                       type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <label>该银行卡是否为对公账户</label>
                                <div class="radio">
                                    <label>
                                        <input onclick="Switch()" checked="checked" value="02" id=""
                                               name="acct_type" type="radio">否</label>
                                    <label>
                                        <input onclick="Switch()" value="01" id=""
                                               name="acct_type" type="radio">是</label>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>支付类型</label>
                                <div class="radio">
                                    <label>
                                        <input onclick="Switch()" value="1" id=""
                                               name="payment_type" type="radio">线上</label>
                                    <label>
                                        <input onclick="Switch()" checked="checked" value="2" id=""
                                               name="payment_type" type="radio">线下</label>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            
                        </form>
                    </div>
                </div>
                <a href="javascript:void(0)" onclick="addpost()">
                    <button style="width: 100%;height: 40px;font-size: 18px;" type="button" class="btn btn-primary">
                        下一步上传资料
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div id="con"></div>
<?php $__env->startSection('js'); ?>
    <script>
        function addpost() {
            if (!$("#account_no").val()) {
                layer.msg('请输入银行卡号');
                $("#account_no").focus();
            }else if (!CheckBankNo($("#account_no"))) {
                layer.msg('请检查银行卡号');
                $("#account_no").focus();
                return false;
            }else if ($("#account_no").val() != $("#card_repeat").val()) {
                layer.msg('银行卡号两次输如不一致！');
                $("#card_repeat").focus();
                return false;
            }/*else if (!$("#account_opbank_no").val()) {
                layer.msg('请输入账户开户行号！');
                $("#account_opbank_no").focus();
                return false;
            }*/else if (!$("#account_name").val()) {
                layer.msg('请输入账户开户户名！');
                $("#account_name").focus();
                return false;
            }/*else if (!$("#account_opbank").val()) {
                layer.msg('请输入账户开户行名！');
                $("#account_opbank").focus();
                return false;
            }*/else{
                $.post("<?php echo e(route("merchantregister")); ?>",
                        {
                            _token: '<?php echo e(csrf_token()); ?>',
//                            product_type: $("#product_type").val(),
                            id_type: $("#id_type").val(),
                            id_no: $("#id_no").val(),
                            merchant_name: $("#merchant_name").val(),
                            merchant_type_code: $("#merchant_type_code").val(),
                            licence_no: $("#licence_no").val(),
                            category_id: $("#category_id").val(),
                            alias_name: $("#alias_name").val(),
                            address: $("#address").val(),
                            contact_name: $("#contact_name").val(),
                            contact_phone: $("#contact_phone").val(),
                            service_phone: $("#service_phone").val(),
                            user_id: $("#user_id").val(),
                            province_code: $("#province_code").val(),
                            city_code: $("#city_code").val(),
                            district_code: $("#district_code").val(),
                            district: $("#district").val(),
                            store_id: $("#store_id").val(),
                            code_number: $("#code_number").val(),
                            account_no: $("#account_no").val(),
//                            account_opbank_no: $("#account_opbank_no").val(),
                            account_info: $("#account_info").val(),
                            account_name: $("#account_name").val(),
//                            account_opbank: $("#account_opbank").val(),
                            acct_type: $("input[name='acct_type']:checked").val(),
                            payment_type: $("input[name='payment_type']:checked").val()
                        },
                        function (result) {
                            if (result.code==1) {
                                
                                store_id=result.store_id;
                                code_number=result.code_number;
                                window.location.href = "<?php echo e(url('admin/webank/uploadfile?store_id=')); ?>" + store_id+"&code_number="+code_number+"&code_from="+$("#code_from").val() ;
                            } else {
                                layer.msg(result.msg);
                            }
                        }, "json")
            }
        }
        function Switch() {
            if ($('input:radio:checked').val() == 1) {
                $("#ob").css("display", "block");
            } else {
                $("#ob").css("display", "none");
            }
        }
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>