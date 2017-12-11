
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-6">
        <input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo e($store->name); ?>-商户设置</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" id="id" value="<?php echo e($store->id); ?>">
                            <div class="form-group">
                                <label>银行卡卡号</label>
                                <input required placeholder="银行卡卡号" class="form-control" value="<?php echo e($store->bank_card_no); ?>" name="bank_card_no" id="bank_card_no"
                                       type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>银行卡的开户人姓名</label>
                                <input required="required" placeholder="银行卡的开户人姓名" value="<?php echo e($store->card_holder); ?>"  class="form-control"
                                       name="card_holder" id="card_holder"
                                       type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>该银行卡是否为对公账户</label>
                                <input required="required" placeholder="该银行卡是否为对公账户，0为否（默认），1为是" class="form-control"
                                       name="is_public_account" id="is_public_account" value="<?php echo e($store->is_public_account); ?>" type="text">
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label>对公账户的开户行</label>
                                <input required="required" placeholder="对公账户的开户行，当is_public_account为1是必传"
                                       class="form-control" value="<?php echo e($store->open_bank); ?>" name="open_bank"
                                       id="open_bank"
                                       type="text">
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="button" onclick="addpost()">
                                    <strong>保存</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="con"></div>
<?php $__env->startSection('js'); ?>
    <script>
        function addpost() {
            $.post("<?php echo e(route("SetStorePost")); ?>",
                    {
                        _token: '<?php echo e(csrf_token()); ?>',
                        bank_card_no: $("#bank_card_no").val()
                        ,
                        card_holder: $("#card_holder").val(),
                        is_public_account: $("#is_public_account").val(),
                        open_bank: $("#open_bank").val(),
                        id:$("#id").val()
                    },
                    function (result) {
                        if (result.success) {
                            //询问框
                            layer.confirm('保存成功', {
                                btn: ['确定'] //按钮
                            }, function () {
                                window.location.href = "<?php echo e(route('PingAnStoreIndex')); ?>";
                            });
                        } else {
                            layer.msg(result.error_message);
                        }
                    }, "json")
        }

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.publicStyle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>