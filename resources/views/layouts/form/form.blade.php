<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 高级表单</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico"> <link href="{{asset('/css/bootstrap.min.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('/css/font-awesome.css?v=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/chosen/chosen.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/switchery/switchery.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
    <link href="{{asset('/css/plugins/clockpicker/clockpicker.css')}}" rel="stylesheet">
    <link href="{{asset('/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style.css?v=4.1.0')}}" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-5">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>旋钮输入 <small>http://anthonyterrien.com/knob/</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h3>
                        旋钮输入
                    </h3>
                    <p>
                        轻松创建旋钮输入
                    </p>
                    <div class="text-center">
                        <small>简单示例</small>
                        <br/>
                        <br/>
                        <div class="m-r-md inline">
                            <input type="text" value="75" class="dial m-r-sm" data-fgColor="#1AB394" data-width="85" data-height="85" />
                        </div>
                        <div class="m-r-md inline">
                            <input type="text" value="25" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85" />
                        </div>
                        <div class="m-r-md inline">
                            <input type="text" value="50" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85" />
                        </div>
                    </div>
                    <div class="text-center">
                        <small>动态旋钮输入示例</small>
                        <br/>
                        <br/>
                        <div class="m-r-md inline">
                            <input type="text" value="75" class="dial m-r-sm" data-fgColor="#ED5565" data-width="85" data-height="85" data-cursor=true data-thickness=.3/>
                        </div>
                        <div class="m-r-md inline">
                            <input type="text" value="25" class="dial m-r" data-fgColor="#ED5565" data-width="85" data-height="85" data-step="1000" data-min="-15000" data-max="15000" data-displayPrevious=true/>
                        </div>
                        <div class="m-r-md inline">
                            <input type="text" value="60" class="dial m-r" data-fgColor="#ED5565" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 />
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>范围滑块 <small>http://refreshless.com/nouislider/</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h3>
                        范围滑块
                    </h3>
                    <p>
                        简单干净的范围选择滑块
                    </p>
                    <div class="row m-b-lg">
                        <div class="col-sm-12">
                            <div id="drag-fixed" class="slider_red"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="font-bold">简单示例</p>
                            <div id="basic_slider"></div>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-bold">在指定范围内进行选择示例</p>
                            <div id="range_slider"></div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <div class="col-sm-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>范围滑块 <small>https://github.com/IonDen/ion.rangeSlider</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h3>
                        滑块
                    </h3>
                    <p>
                        在指定范围内选择
                    </p>
                    <div class="m-b-sm">
                        <small><strong>示例：</strong> 设置值为0-5000，后缀“+”来表示最大值，人民币符号作为前缀，使用刻度</small>
                    </div>
                    <div id="ionrange_1"></div>

                    <div class="m-b-sm m-t">
                        <small><strong>示例：</strong> 设置值为0-10，步长：0.1，使用刻度  </small>
                    </div>
                    <div id="ionrange_2"></div>

                    <div class="m-b-sm m-t">
                        <small><strong>示例：</strong> 设置值微从-50~+50，默认为0， 并使用摄氏度符号作为后缀，使用刻度  </small>
                    </div>
                    <div id="ionrange_3"></div>

                    <div class="m-b-sm m-t">
                        <small><strong>示例:</strong>使用数组设置滑块值为月数，数组可以使任意长度，滑块将自动适应 </small>
                    </div>
                    <div id="ionrange_4"></div>

                    <div>
                        <a class="btn btn-white pull-right btn-sm" href="https://github.com/IonDen/ion.rangeSlider" target="_blank">API文档</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>日期选择器 <small>https://github.com/eternicode/bootstrap-datepicker</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h3>
                        日期选择器
                    </h3>
                    <p>
                        简单好用的日期选择器
                    </p>

                    <div class="form-group" id="data_1">
                        <label class="font-noraml">简单示例</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" value="2014-11-11">
                        </div>
                    </div>

                    <div class="form-group" id="data_2">
                        <label class="font-noraml">年视图</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" value="2014-11-11">
                        </div>
                    </div>

                    <div class="form-group" id="data_3">
                        <label class="font-noraml">10年视图</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" value="2014-11-11">
                        </div>
                    </div>

                    <div class="form-group" id="data_4">
                        <label class="font-noraml">选择月份</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" value="2014-11-11">
                        </div>
                    </div>

                    <div class="form-group" id="data_5">
                        <label class="font-noraml">范围选择</label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="start" value="2014-11-11" />
                            <span class="input-group-addon">到</span>
                            <input type="text" class="input-sm form-control" name="end" value="2014-11-17" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-title">
                    <h5>时间选择 <small>http://weareoutman.github.io/clockpicker/</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">选项 01</a>
                            </li>
                            <li><a href="#">选项 02</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h3>
                        时间选择
                    </h3>

                    <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" class="form-control" value="09:30">
                        <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                            </span>
                    </div>
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>下拉列表 <small>http://harvesthq.github.io/chosen/</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h3>
                        下拉选择
                    </h3>
                    <p>
                        这个比较有名气啦，不多说
                    </p>
                    <div class="form-group">
                        <label class="font-noraml">基本示例</label>
                        <div class="input-group">
                            <select data-placeholder="选择省份..." class="chosen-select" style="width:350px;" tabindex="2">
                                <option value="">请选择省份</option>
                                <option value="110000" hassubinfo="true">北京</option>
                                <option value="120000" hassubinfo="true">天津</option>
                                <option value="130000" hassubinfo="true">河北省</option>
                                <option value="140000" hassubinfo="true">山西省</option>
                                <option value="150000" hassubinfo="true">内蒙古自治区</option>
                                <option value="210000" hassubinfo="true">辽宁省</option>
                                <option value="220000" hassubinfo="true">吉林省</option>
                                <option value="230000" hassubinfo="true">黑龙江省</option>
                                <option value="310000" hassubinfo="true">上海</option>
                                <option value="320000" hassubinfo="true">江苏省</option>
                                <option value="330000" hassubinfo="true">浙江省</option>
                                <option value="340000" hassubinfo="true">安徽省</option>
                                <option value="350000" hassubinfo="true">福建省</option>
                                <option value="360000" hassubinfo="true">江西省</option>
                                <option value="370000" hassubinfo="true">山东省</option>
                                <option value="410000" hassubinfo="true">河南省</option>
                                <option value="420000" hassubinfo="true">湖北省</option>
                                <option value="430000" hassubinfo="true">湖南省</option>
                                <option value="440000" hassubinfo="true">广东省</option>
                                <option value="450000" hassubinfo="true">广西壮族自治区</option>
                                <option value="460000" hassubinfo="true">海南省</option>
                                <option value="500000" hassubinfo="true">重庆</option>
                                <option value="510000" hassubinfo="true">四川省</option>
                                <option value="520000" hassubinfo="true">贵州省</option>
                                <option value="530000" hassubinfo="true">云南省</option>
                                <option value="540000" hassubinfo="true">西藏自治区</option>
                                <option value="610000" hassubinfo="true">陕西省</option>
                                <option value="620000" hassubinfo="true">甘肃省</option>
                                <option value="630000" hassubinfo="true">青海省</option>
                                <option value="640000" hassubinfo="true">宁夏回族自治区</option>
                                <option value="650000" hassubinfo="true">新疆维吾尔自治区</option>
                                <option value="710000" hassubinfo="true">台湾省</option>
                                <option value="810000" hassubinfo="true">香港特别行政区</option>
                                <option value="820000" hassubinfo="true">澳门特别行政区</option>
                                <option value="990000" hassubinfo="true">海外</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-noraml">多选</label>
                        <div class="input-group">
                            <select data-placeholder="选择省份" class="chosen-select" multiple style="width:350px;" tabindex="4">
                                <option value="">请选择省份</option>
                                <option value="110000" hassubinfo="true">北京</option>
                                <option value="120000" hassubinfo="true">天津</option>
                                <option value="130000" hassubinfo="true">河北省</option>
                                <option value="140000" hassubinfo="true">山西省</option>
                                <option value="150000" hassubinfo="true">内蒙古自治区</option>
                                <option value="210000" hassubinfo="true">辽宁省</option>
                                <option value="220000" hassubinfo="true">吉林省</option>
                                <option value="230000" hassubinfo="true">黑龙江省</option>
                                <option value="310000" hassubinfo="true">上海</option>
                                <option value="320000" hassubinfo="true">江苏省</option>
                                <option value="330000" hassubinfo="true">浙江省</option>
                                <option value="340000" hassubinfo="true">安徽省</option>
                                <option value="350000" hassubinfo="true">福建省</option>
                                <option value="360000" hassubinfo="true">江西省</option>
                                <option value="370000" hassubinfo="true">山东省</option>
                                <option value="410000" hassubinfo="true">河南省</option>
                                <option value="420000" hassubinfo="true">湖北省</option>
                                <option value="430000" hassubinfo="true">湖南省</option>
                                <option value="440000" hassubinfo="true">广东省</option>
                                <option value="450000" hassubinfo="true">广西壮族自治区</option>
                                <option value="460000" hassubinfo="true">海南省</option>
                                <option value="500000" hassubinfo="true">重庆</option>
                                <option value="510000" hassubinfo="true">四川省</option>
                                <option value="520000" hassubinfo="true">贵州省</option>
                                <option value="530000" hassubinfo="true">云南省</option>
                                <option value="540000" hassubinfo="true">西藏自治区</option>
                                <option value="610000" hassubinfo="true">陕西省</option>
                                <option value="620000" hassubinfo="true">甘肃省</option>
                                <option value="630000" hassubinfo="true">青海省</option>
                                <option value="640000" hassubinfo="true">宁夏回族自治区</option>
                                <option value="650000" hassubinfo="true">新疆维吾尔自治区</option>
                                <option value="710000" hassubinfo="true">台湾省</option>
                                <option value="810000" hassubinfo="true">香港特别行政区</option>
                                <option value="820000" hassubinfo="true">澳门特别行政区</option>
                                <option value="990000" hassubinfo="true">海外</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>文件上传 <small>https://github.com/episage/bootstrap-3-pretty-file-upload</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="file-pretty">
                        <div class="form-group">
                            <label class="font-noraml">文件选择（单选）</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="font-noraml">文件选择（多选）</label>
                            <input type="file" multiple="multiple" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>固定格式文本 <small>http://jasny.github.io/bootstrap/</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h3>
                        固定格式文本
                    </h3>
                    <p>
                        可以按指定格式格式化输入的文本内容。
                    </p>
                    <form class="form-horizontal m-t-md" action="form_advanced.html#">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">ISBN 1</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" data-mask="999-99-999-9999-9" placeholder="">
                                <span class="help-block">999-99-999-9999-9</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ISBN 2</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" data-mask="999 99 999 9999 9" placeholder="">
                                <span class="help-block">999 99 999 9999 9</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ISBN 3</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" data-mask="999/99/999/9999/9" placeholder="">
                                <span class="help-block">999/99/999/9999/9</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">IPV4</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" data-mask="999.999.999.9999" placeholder="">
                                <span class="help-block">192.168.100.200</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">税务代码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" data-mask="99-9999999" placeholder="">
                                <span class="help-block">99-9999999</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">电话</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" data-mask="9999-9999999" placeholder="">
                                <span class="help-block">(999) 999-9999</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">货币</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" data-mask="&yen; 999,999,999.99" placeholder="">
                                <span class="help-block">&yen; 999,999,999.99</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">日期</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" data-mask="9999-99-99" placeholder="">
                                <span class="help-block">yyyy-mm-dd</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>切换开关 <small>http://abpetkov.github.io/switchery/</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <h3>
                        切换按钮01
                    </h3>
                    <p>
                        给复选按钮加上IOS7风格
                    </p>
                    <input type="checkbox" class="js-switch" checked />
                    <input type="checkbox" class="js-switch_2" checked />
                    <br/>
                    <br/>
                    <input type="checkbox" class="js-switch_3" />
                    <br/>
                    <br/>
                    <h4>
                        切换按钮02
                    </h4>
                    <p>
                        使用css3实现的切换按钮
                    </p>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" checked class="onoffswitch-checkbox" id="example1">
                            <label class="onoffswitch-label" for="example1">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>

                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" class="onoffswitch-checkbox" id="example2">
                            <label class="onoffswitch-label" for="example2">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title  back-change">
                    <h5>单选复选框</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">选项 01</a>
                            </li>
                            <li><a href="#">选项 02</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-md-4">
                            <fieldset>
                                <h3>基本</h3>
                                <p>
                                    支持使用Bootstrap内置颜色，如：<code>.checkbox-primary</code>, <code>.checkbox-info</code>等。
                                </p>
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">
                                        Default
                                    </label>
                                </div>
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox2" type="checkbox" checked="">
                                    <label for="checkbox2">
                                        Primary
                                    </label>
                                </div>
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox3" type="checkbox">
                                    <label for="checkbox3">
                                        Success
                                    </label>
                                </div>
                                <div class="checkbox checkbox-info">
                                    <input id="checkbox4" type="checkbox">
                                    <label for="checkbox4">
                                        Info
                                    </label>
                                </div>
                                <div class="checkbox checkbox-warning">
                                    <input id="checkbox5" type="checkbox" checked="">
                                    <label for="checkbox5">
                                        Warning
                                    </label>
                                </div>
                                <div class="checkbox checkbox-danger">
                                    <input id="checkbox6" type="checkbox" checked="">
                                    <label for="checkbox6">
                                        Danger
                                    </label>
                                </div>
                                <p>无文本</p>
                                <div class="checkbox">
                                    <input type="checkbox" id="singleCheckbox1" value="option1" aria-label="Single checkbox One">
                                    <label></label>
                                </div>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" id="singleCheckbox2" value="option2" checked="" aria-label="Single checkbox Two">
                                    <label></label>
                                </div>
                                <p>行级显示</p>
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label for="inlineCheckbox1"> 选项01 </label>
                                </div>
                                <div class="checkbox checkbox-success checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="option1" checked="">
                                    <label for="inlineCheckbox2"> 选项02 </label>
                                </div>
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox3" value="option1">
                                    <label for="inlineCheckbox3"> 选项03 </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <h3>
                                    圆形显示
                                </h3>
                                <p>
                                    <code>.checkbox-circle</code> 可实现圆形显示
                                </p>
                                <div class="checkbox checkbox-circle">
                                    <input id="checkbox7" type="checkbox">
                                    <label for="checkbox7">
                                        示例 01
                                    </label>
                                </div>
                                <div class="checkbox checkbox-info checkbox-circle">
                                    <input id="checkbox8" type="checkbox" checked="">
                                    <label for="checkbox8">
                                        示例 02
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <h3>
                                    单选框
                                </h3>
                                <p>
                                    支持使用Bootstrap内置颜色，如：<code>.radio-primary</code>, <code>.radio-danger</code> 等。
                                </p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <input type="radio" name="radio1" id="radio1" value="option1" checked="">
                                            <label for="radio1">
                                                文本 01
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="radio1" id="radio2" value="option2">
                                            <label for="radio2">
                                                文本 02
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="radio radio-danger">
                                            <input type="radio" name="radio2" id="radio3" value="option1">
                                            <label for="radio3">
                                                文本 03
                                            </label>
                                        </div>
                                        <div class="radio radio-danger">
                                            <input type="radio" name="radio2" id="radio4" value="option2" checked="">
                                            <label for="radio4">
                                                文本 04
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <p>无文本</p>
                                <div class="radio">
                                    <input type="radio" id="singleRadio1" value="option1" name="radioSingle1" aria-label="Single radio One">
                                    <label></label>
                                </div>
                                <div class="radio radio-success">
                                    <input type="radio" id="singleRadio2" value="option2" name="radioSingle1" checked="" aria-label="Single radio Two">
                                    <label></label>
                                </div>
                                <p>行级显示</p>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                    <label for="inlineRadio1"> 选项 01 </label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                    <label for="inlineRadio2"> 选项 02 </label>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>拾色器 <small>http://mjolnic.github.io/bootstrap-colorpicker/</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_advanced.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_advanced.html#">选项1</a>
                            </li>
                            <li><a href="form_advanced.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row m-t">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label class="font-noraml">普通的16进制颜色</label>
                                <div class="input-group">
                                    <input type="text" class="form-control colorpicker-demo1" value="#5367ce" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">作为部件使用</label>
                                <div class="input-group colorpicker-demo2">
                                    <input type="text" value="" class="form-control" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">事件</label>
                                <div class="well">
                                    <a href="#" class="btn small demo colorpicker-element" id="demo_apidemo" data-color="rgb(255, 255, 255)">改变背景颜色</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">RGBA颜色</label>
                                <div class="input-group colorpicker-demo3">
                                    <input type="text" value="" class="form-control" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">内联模式</label>
                                <div class="well">
                                    <div id="demo_cont" class="demo demo-auto inl-bl inline" data-container="#demo_cont" data-color="rgba(150,216,62,0.55)" data-inline="true"></div>
                                    <div class="demo demo-auto inl-bl inline" data-container="true" data-color="rgb(50,216,62)" data-inline="true"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">禁用 / 启用</label>
                                <div class="well">
                                    <div id="demo_endis" class="input-group demo demo-auto colorpicker-component">
                                        <input disabled type="text" value="" class="form-control" />
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                    <br>
                                    <a class="btn btn-sm btn-default enable-button" href="#">启用</a>
                                    <a class="btn btn-sm btn-default disable-button" href="#">禁用</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-noraml">Bootstrap弹层</label>
                                <div class="well">
                                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">显示</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-white demo-destroy btn-block" href="#"><i class="glyphicon glyphicon-remove"></i> 销毁插件</a>
                            <a class="btn btn-white demo-create btn-block" href="#"><i class="glyphicon glyphicon-plus"></i> 重新创建</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title  back-change">
                    <h5>图片裁剪 <small>http://fengyuanchen.github.io/cropper/</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">选项 01</a>
                            </li>
                            <li><a href="#">选项 02</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <p>
                        一款简单的jQuery图片裁剪插件
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image-crop">
                                <img src="img/a3.jpg">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>图片预览：</h4>
                            <div class="img-preview img-preview-sm"></div>
                            <h4>说明：</h4>
                            <p>
                                你可以选择新图片上传，然后下载裁剪后的图片
                            </p>
                            <div class="btn-group">
                                <label title="上传图片" for="inputImage" class="btn btn-primary">
                                    <input type="file" accept="image/*" name="file" id="inputImage" class="hide"> 上传新图片
                                </label>
                                <label title="下载图片" id="download" class="btn btn-primary">下载</label>
                            </div>
                            <h4>其他说明：</h4>
                            <p>
                                你可以使用<code>$({image}).cropper(options)</code>来配置插件
                            </p>
                            <div class="btn-group">
                                <button class="btn btn-white" id="zoomIn" type="button">放大</button>
                                <button class="btn btn-white" id="zoomOut" type="button">缩小</button>
                                <button class="btn btn-white" id="rotateLeft" type="button">左旋转</button>
                                <button class="btn btn-white" id="rotateRight" type="button">右旋转</button>
                                <button class="btn btn-warning" id="setDrag" type="button">裁剪</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">颜色选择</h4>
            </div>
            <div class="modal-body">
                <div class="input-group colorpicker-component demo demo-auto">
                    <input type="text" value="" class="form-control" />
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
<script src="{{asset('js/bootstrap.min.js?v=3.3.6')}}"></script>

<!-- 自定义js -->
<script src="{{asset('js/content.js?v=1.0.0')}}"></script>

<!-- Chosen -->
<script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>

<!-- JSKnob -->
<script src="{{asset('js/plugins/jsKnob/jquery.knob.js')}}"></script>

<!-- Input Mask-->
<script src="{{asset('js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>

<!-- Data picker -->
<script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

<!-- Prettyfile -->
<script src="{{asset('js/plugins/prettyfile/bootstrap-prettyfile.js')}}"></script>

<!-- NouSlider -->
<script src="{{asset('js/plugins/nouslider/jquery.nouislider.min.js')}}"></script>

<!-- Switchery -->
<script src="{{asset('js/plugins/switchery/switchery.js')}}"></script>

<!-- IonRangeSlider -->
<script src="{{asset('js/plugins/ionRangeSlider/ion.rangeSlider.min.js')}}"></script>

<!-- iCheck -->
<script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>

<!-- MENU -->
<script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

<!-- Color picker -->
<script src="{{asset('js/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>

<!-- Clock picker -->
<script src="{{asset('js/plugins/clockpicker/clockpicker.js')}}"></script>

<!-- Image cropper -->
<script src="{{asset('js/plugins/cropper/cropper.min.js')}}"></script>

<script src="{{asset('js/demo/form-advanced-demo.js')}}"></script>





</body>

</html>
