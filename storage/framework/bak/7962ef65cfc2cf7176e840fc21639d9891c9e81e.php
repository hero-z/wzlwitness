<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
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
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body data-type="widgets" class="theme-white">
<div class="am-g tpl-g">
    <!-- 头部 -->
    <header>
        <!-- logo -->
        <div class="am-fl tpl-header-logo">
            <a href="<?php echo e(url('/merchant/index')); ?>"><img src="<?php echo e(url($logo->logo2)); ?>" alt=""></a>
        </div>
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 侧边切换 -->
            <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span>

                </span>
            </div>
            <!-- 搜索 -->
            <div class="am-fl tpl-header-search">
                <form class="tpl-header-search-form" action="javascript:;">
                    <button class="tpl-header-search-btn am-icon-search"></button>
                    <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
                </form>
            </div>
            <!-- 其它功能-->
            <div class="am-fr tpl-header-navbar">
                <ul>
                    <!-- 欢迎语 -->
                    <li class="am-text-sm tpl-header-navbar-welcome">
                        <a href="javascript:;">欢迎你, <span><?php echo e(auth()->guard('merchant')->user()->name); ?></span> </a>
                    </li>

                    <!-- 新邮件 -->
                    <li class="am-dropdown tpl-dropdown" data-am-dropdown>
                        <a href="javascript:;" class="am-dropdown-toggle tpl-dropdown-toggle" data-am-dropdown-toggle>
                            
                            
                        </a>
                        <!-- 弹出列表 -->
                        <ul class="am-dropdown-content tpl-dropdown-content">
                            <li class="tpl-dropdown-menu-messages">
                                <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                    <div class="menu-messages-ico">
                                        <img src="<?php echo e(url('/amazeui/assets/img/user04.png')); ?>" alt="">
                                    </div>
                                    <div class="menu-messages-time">
                                        3小时前
                                    </div>
                                    <div class="menu-messages-content">
                                        <div class="menu-messages-content-title">
                                            <i class="am-icon-circle-o am-text-success"></i>
                                            <span>夕风色</span>
                                        </div>
                                        <div class="am-text-truncate"> Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI
                                            的成长，则离不开用户的支持。
                                        </div>
                                        <div class="menu-messages-content-time">2016-09-21 下午 16:40</div>
                                    </div>
                                </a>
                            </li>

                            <li class="tpl-dropdown-menu-messages">
                                <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                    <div class="menu-messages-ico">
                                        <img src="<?php echo e(url('/amazeui/assets/img/user02.png')); ?>" alt="">
                                    </div>
                                    <div class="menu-messages-time">
                                        5天前
                                    </div>
                                    <div class="menu-messages-content">
                                        <div class="menu-messages-content-title">
                                            <i class="am-icon-circle-o am-text-warning"></i>
                                            <span>禁言小张</span>
                                        </div>
                                        <div class="am-text-truncate"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。</div>
                                        <div class="menu-messages-content-time">2016-09-16 上午 09:23</div>
                                    </div>
                                </a>
                            </li>
                            <li class="tpl-dropdown-menu-messages">
                                <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                    <i class="am-icon-circle-o"></i> 进入列表…
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- 新提示 -->
                    <li class="am-dropdown" data-am-dropdown>
                        <a href="javascript:;" class="am-dropdown-toggle" data-am-dropdown-toggle>
                            
                            
                        </a>

                        <!-- 弹出列表 -->
                        <ul class="am-dropdown-content tpl-dropdown-content">
                            <li class="tpl-dropdown-menu-notifications">
                                <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                    <div class="tpl-dropdown-menu-notifications-title">
                                        <i class="am-icon-line-chart"></i>
                                        <span> 有6笔新的销售订单</span>
                                    </div>
                                    <div class="tpl-dropdown-menu-notifications-time">
                                        12分钟前
                                    </div>
                                </a>
                            </li>
                            <li class="tpl-dropdown-menu-notifications">
                                <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                    <div class="tpl-dropdown-menu-notifications-title">
                                        <i class="am-icon-star"></i>
                                        <span> 有3个来自人事部的消息</span>
                                    </div>
                                    <div class="tpl-dropdown-menu-notifications-time">
                                        30分钟前
                                    </div>
                                </a>
                            </li>
                            <li class="tpl-dropdown-menu-notifications">
                                <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                    <div class="tpl-dropdown-menu-notifications-title">
                                        <i class="am-icon-folder-o"></i>
                                        <span> 上午开会记录存档</span>
                                    </div>
                                    <div class="tpl-dropdown-menu-notifications-time">
                                        1天前
                                    </div>
                                </a>
                            </li>


                            <li class="tpl-dropdown-menu-notifications">
                                <a href="javascript:;" class="tpl-dropdown-menu-notifications-item am-cf">
                                    <i class="am-icon-bell"></i> 进入列表…
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- 退出 -->
                    <li class="am-text-sm">
                        <a href="<?php echo e(url('/merchant/logout')); ?>">
                            <span class="am-icon-sign-out"></span> 退出
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </header>
    <!-- 风格切换 -->
    <div class="tpl-skiner">
        <div class="tpl-skiner-toggle am-icon-cog">
        </div>
        <div class="tpl-skiner-content">
            <div class="tpl-skiner-content-title">
                选择主题
            </div>
            <div class="tpl-skiner-content-bar">
                <span class="skiner-color skiner-white" data-color="theme-white"></span>
                <span class="skiner-color skiner-black" data-color="theme-black"></span>
            </div>
        </div>
    </div>
    <!-- 侧边导航栏 -->
    <div class="left-sidebar">
        <!-- 用户信息 -->
        <div class="tpl-sidebar-user-panel">
            <div class="tpl-user-panel-slide-toggleable">
                <div class="tpl-user-panel-profile-picture">
                    <img src="<?php echo e(url('/amazeui/assets/img/user04.png')); ?>" alt="">
                </div>
                <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
                    <?php echo e(auth()->guard('merchant')->user()->name); ?>

          </span>
                <a href="<?php echo e(route("editMerchant")); ?>" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
            </div>
        </div>

        <!-- 菜单 -->
        <ul class="sidebar-nav">
            <li class="sidebar-nav-link">
                <a href="<?php echo e(route('AlipayTradePayCreate')); ?>">
                    <i class="am-icon-modx sidebar-nav-link-logo"></i> 扫码枪收款
                </a>
            </li>
            <li class="sidebar-nav-link">
                <a href="<?php echo e(route('scanLs')); ?>">
                    <i class="am-icon-modx sidebar-nav-link-logo"></i> 机具扫码流水
                </a>
            </li>
            <li class="sidebar-nav-link">
                <a href="javascript:;" class="sidebar-nav-sub-title">
                    <i class="am-icon-qrcode sidebar-nav-link-logo"></i> 二维码账单流水
                    <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                </a>
                <ul class="sidebar-nav sidebar-nav-sub">
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('alipayLs')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>支付宝当面付
                        </a>
                    </li>

                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('alipaysLs')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>口碑店铺流水
                        </a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('weixinLs')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>微信支付流水
                        </a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('pinganLs')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>平安银行流水
                        </a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('pufaorderlist')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>浦发银行流水
                        </a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('webankmerchantls')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>微众银行流水
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-nav-link">
                <a href="javascript:;" class="sidebar-nav-sub-title">
                    <i class="am-icon-qrcode sidebar-nav-link-logo"></i> 账单管理
                    <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                </a>
                <ul class="sidebar-nav sidebar-nav-sub">
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('neworderlists')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>账单统计
                        </a>
                    </li>

                    
                        
                            
                        
                    
                </ul>
            </li>
            <li class="sidebar-nav-link">
                <a href="javascript:;" class="sidebar-nav-sub-title">
                    <i class="am-icon-signing sidebar-nav-link-logo"></i> 店铺管理
                    <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
                </a>
                <ul class="sidebar-nav sidebar-nav-sub">
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('cashierindex')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>收银员管理
                        </a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('setWays')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>扫码枪通道设置
                        </a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="<?php echo e(route('merchineLists')); ?>">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>打印机设备列表
                        </a>
                    </li>
                    <li class="sidebar-nav-link">
                        <a href="">
                            <span class="am-icon-angle-right sidebar-nav-link-logo"></span>店铺设置
                        </a>
                    </li>
                </ul>

            </li>
        </ul>
    </div>
    <div class="tpl-content-wrapper">
        <div class="row-content am-cf">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <!-- 全局js -->
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/amazeui.datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/amazeui/assets/js/app.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
