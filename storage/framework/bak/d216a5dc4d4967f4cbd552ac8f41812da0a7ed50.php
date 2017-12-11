<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
     <?php echo $__env->yieldContent('meta'); ?>
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>">
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico"> <link href="<?php echo e(asset('/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/css/style.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('/js/jquery.min.js?v=2.1.4')); ?>" type="text/javascript"></script>
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" >
<?php echo $__env->yieldContent('content'); ?>

<!-- 全局js -->
<script src="<?php echo e(asset('/js/bootstrap.min.js?v=3.3.6')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/plugins/metisMenu/jquery.metisMenu.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/plugins/slimscroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/plugins/layer/layer.min.js')); ?>" type="text/javascript"></script>
<!-- 自定义js -->
<script src="<?php echo e(asset('js/hAdmin.js?v=4.1.0')); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo e(asset('js/index.js')); ?>" type="text/javascript"></script>

<?php echo $__env->yieldContent('js'); ?>
</body>

</html>
