<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 项目</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo e(asset('css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/font-awesome.css?v=4.4.0')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css?v=4.1.0')); ?>" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>所有问题</h5>
                    <div class="ibox-tools">
                    <?php if (\Entrust::can('createQuestions')) : ?><a href="<?php echo e(route('addQuestions')); ?>" class="btn btn-primary btn-xs">创建问题帮助</a><?php endif; // Entrust::can ?>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr>
                                <td class="project-title">
                                    <a href="project_detail.html"><?php echo e($v->title); ?></a>
                                    <br/>
                                    <small>创建于 <?php echo e($v->created_at); ?></small>
                                </td>
                                <td class="project-completion">
                                    <small>问题简述： </small>
                                    <div class="project-title">
                                        <?php echo e($v->summary); ?>

                                    </div>
                                </td>
                                <td class="project-actions">
                                    <a href="<?php echo e(url('admin/questions/questionsDesc?id='.$v->id)); ?>" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看问题详情 </a>
                                   <?php if (\Entrust::can("editQuestions")) : ?> <a href="<?php echo e(url('admin/questions/editQuestions?id='.$v->id)); ?>" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a><?php endif; // Entrust::can ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_simple_numbers"
                             id="DataTables_Table_0_paginate">
                            <?php echo e($list->links()); ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="<?php echo e(asset('js/jquery.min.js?v=2.1.4')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js?v=3.3.6')); ?>"></script>


<!-- 自定义js -->
<script src="<?php echo e(asset('js/content.js?v=1.0.0')); ?>"></script>


<script>
    $(document).ready(function(){

        $('#loading-example-btn').click(function () {
            btn = $(this);
            simpleLoad(btn, true)

            // Ajax example
//                $.ajax().always(function () {
//                    simpleLoad($(this), false)
//                });

            simpleLoad(btn, false)
        });
    });

    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Refresh");
            }, 2000);
        }
    }
</script>



</body>
</html>
