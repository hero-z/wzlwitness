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
    <?php echo $__env->yieldContent('css'); ?>
    <script src="<?php echo e(asset('/js/jquery.min.js?v=2.1.4')); ?>" type="text/javascript"></script>
    <link rel="stylesheet" href="https://wx.gtimg.com/res/css/wepayui/0.0.1/wepayui.min.css">
</head>
<body>
<?php echo $__env->yieldContent('content'); ?>
<!-- 全局js -->

<?php echo $__env->yieldContent('js'); ?>
</body>

</html>
