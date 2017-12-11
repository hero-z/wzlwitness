
<?php $__env->startSection('title',"主页"); ?>
<?php $__env->startSection('content'); ?>
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <i class="fa fa-area-chart"></i>
                                        <strong class="font-bold">店铺管理系统</strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">Admin
                        </div>
                    </li>
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope">分类</span>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo e(route('home')); ?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                        </a>
                    </li>
                    <li>
                        <a href="#}">
                            <i class="fa fa-line-chart"></i>
                            <span class="nav-label">数据统计</span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo e(url('admin/alipayopen/datacount')); ?>">交易订单</a>
                            </li>
                        </ul>
                    </li>
                    <?php if (\Entrust::can('MerchantManagement ')) : ?>
                    <li>
                        <a class="J_menuItem" href="<?php echo e(route('mmdatalists')); ?>">
                            <i class="fa fa-play-circle-o"></i>
                            <span class="nav-label">收银员统一管理</span>
                        </a>
                    </li>
                    <?php endif; // Entrust::can ?>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-th"></i>
                            <span class="nav-label">支付宝口碑店铺管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo e(url('admin/alipayopen/oauth')); ?>">我的授权二维码</a>
                            </li>
                            <?php if (\Entrust::can('oauthlist')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(url('admin/alipayopen/oauthlist')); ?>">口碑开店收款</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('store')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(url('admin/alipayopen/store')); ?>">口碑门店列表</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('ApplyorderBatchquery')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('ApplyorderBatchquery')); ?>">商户操作查询</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('alipaytradelist')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('alipaytradelist')); ?>">交易流水查询</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('AlipayShopCategory')); ?>">分类更新</a>
                            </li>
                            <?php if (\Entrust::can('isvconfigs')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('isvconfig')); ?>">支付宝ISV配置</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-ok"></i>
                            <span class="nav-label">微信支付商户管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('WxShopList')); ?>">微信支付商户列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('WxOrder')); ?>">商户交易流水查询</a>
                            </li>
                            <?php if (\Entrust::can('spset')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route("spset")); ?>">微信支付服务商配置</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-qrcode"></i>
                            <span class="nav-label">多码合一合成器</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if (\Entrust::can('oauthlist')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('AlipayWexinLists')); ?>">微信支付宝二码合一</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-bank"></i>
                            <span class="nav-label">平安银行通道商户管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('QrLists')); ?>">我的商户码</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('PingAnStoreIndex')); ?>">商户列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('PingAnOrderQuery')); ?>">商户流水</a>
                            </li>

                            <?php if (\Entrust::can('pinganconfig')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('pinganconfig')); ?>">银行通道配置</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-bank"></i>
                            <span class="nav-label">浦发银行通道商户管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('PFQrLists')); ?>">我的商户码</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('storelist')); ?>">商户列表</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('orderList')); ?>">商户流水</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('pufaConfig')); ?>">浦发银行通道配置</a>
                            </li>

                        </ul>
                    </li>
                    <?php if (\Entrust::can('alipayadd')) : ?>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-send"></i>
                            <span class="nav-label">广告系统管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('adIndex')); ?>">支付广告列表</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; // Entrust::can ?>
                    <?php if (\Entrust::can('weixinAPP')) : ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-comments"></i>
                            <span class="nav-label">微信公众号管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('WxAppMenu')); ?>">菜单管理</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; // Entrust::can ?>
                    <?php if (\Entrust::can('set')) : ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-building"></i>
                            <span class="nav-label">设备管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('ticketIndex')); ?>">易联云设备列表</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; // Entrust::can ?>
                    <?php if (\Entrust::can('set')) : ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-magic"></i>
                            <span class="nav-label">系统设置管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if (\Entrust::can('users')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(url('admin/alipayopen/users')); ?>">员工管理</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('role')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(url('admin/alipayopen/role')); ?>">角色管理</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('permission')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(url('admin/alipayopen/permission')); ?>">权限管理</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('users')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('setApp')); ?>">网站设置</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(url('/admin/set?type=WxNotify')); ?>">收银提醒设置</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('users')) : ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo e(route('setSms')); ?>">短信验证设置</a>
                            </li>
                            <?php endif; // Entrust::can ?>
                        </ul>
                    </li>
                    <?php endif; // Entrust::can ?>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i
                                    class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" action="">
                            <div class="form-group">
                                <input placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search"
                                       id="top-search" type="text">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">欢迎您:<?php echo e(Auth::user()->name); ?> </li>
                        <a href="/logout">
                            <button type="button" class="btn btn-default btn-xs">退出</button>
                        </a>
                        <li class="dropdown">
                            
                                
                            
                            
                                
                                    
                                        
                                            
                                        
                                        
                                            
                                            
                                            
                                            
                                        
                                    
                                
                                
                                
                                    
                                        
                                            
                                        
                                        
                                            
                                            
                                            
                                            
                                        
                                    
                                
                                
                                
                                    
                                        
                                            
                                        
                                    
                                
                            
                        </li>
                        <li class="dropdown">
                            
                                
                            
                            
                                
                                    
                                        
                                            
                                            
                                        
                                    
                                
                                
                                
                                    
                                        
                                            
                                            
                                        
                                    
                                
                                
                                
                                    
                                        
                                            
                                            
                                        
                                    
                                
                            
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe id="J_iframe" width="100%" height="100%" src="<?php echo e(route('home')); ?>" frameborder="0"
                        data-id="index_v1.html" seamless></iframe>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>