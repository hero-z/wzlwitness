@extends('layouts.publicStyle')
@section('css')
@endsection
@section('content')
    <script src="{{asset('/jQuery-File-Upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
    <script src="{{asset('/jQuery-File-Upload/js//jquery.iframe-transport.js')}}" type="text/javascript"></script>
    <script src="{{asset('/jQuery-File-Upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
    <style type="text/css">
        /* 图片展示样式 */
        .images_zone {
            position: relative;
            width: 120px;
            height: 120px;
            overflow: hidden;
            float: left;
            margin: 3px 5px 3px 0;
            background: #f0f0f0;
            border: 5px solid #f0f0f0;
        }

        .images_zone span {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            overflow: hidden;
            width: 120px;
            height: 120px;
        }

        .images_zone span img {
            width: 120px;
            vertical-align: middle;
        }

        .images_zone a {
            text-align: center;
            position: absolute;
            bottom: 0px;
            left: 0px;
            background: rgba(255, 255, 255, 0.5);
            display: block;
            width: 100%;
            height: 20px;
            line-height: 20px;
            display: none;
            font-size: 12px;
        }

        /* 进度条样式 */
        .up_progress, .up_progress1, .up_progress2, .up_progress3, .up_progress4, .up_progress5, .up_progress6, .up_progress7, .up_progress8 {
            width: 300px;
            height: 13px;
            font-size: 10px;
            line-height: 14px;
            overflow: hidden;
            background: #e6e6e6;
            margin: 5px 0;
            display: none;
        }

        .up_progress .progress-bar, .up_progress1 .progress-bar1, .up_progress2 .progress-bar2, .up_progress3 .progress-bar3, .up_progress4 .progress-bar4, .up_progress5 .progress-bar5, .up_progress6 .progress-bar6, .up_progress7 .progress-bar7, .up_progress8 .progress-bar8 {
            height: 13px;
            background: #11ae6f;
            float: left;
            color: #fff;
            text-align: center;
            width: 0%;
        }
    </style>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>修改微众店铺信息</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>微众银行微信商户号@if($subdevconfig->code==0)<span style="color:grey">({{$subdevconfig->msg}})</span>@else<span >({{$subdevconfig->msg}})</span>@endif</label>
                                <input required readonly  value="{{$wxstore_union->wb_merchant_id}}" class="form-control" id="wx_wb_merchant_id" name="wx_wb_merchant_id"
                                       type="text">
                            </div>

                            <div class="form-group">
                                <label>子商户公众账号JSAPI支付授权目录</label>
                                <input required placeholder="请输入您的公众账号JSAPI支付授权目录" value="{{$jsapiPath}}" class="form-control" id="jsapi_path_list" name="jsapi_path_list"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <label>子商户SubAPPID</label>
                                <input required placeholder="请输入您的公众账号APPID" value="{{$sub_appid}}" class="form-control" id="sub_appid" name="sub_appid"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <label>子商户推荐关注公众账号APPID</label>
                                <input required placeholder="请输入您的公众账号APPID" value="{{$subscribe_appid}}" class="form-control" id="subscribe_appid" name="subscribe_appid"
                                       type="text">
                            </div>
                            <input type="hidden" id="store_id" name="store_id" value="{{$store->store_id}}">
                            <div>
                                <button onclick="addpost()" class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="button">
                                    <strong>保存</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function addpost() {
            //layer.alert('修改成功', {icon: 6});
            if(!$("#jsapi_path_list").val()){
                layer.msg('请输入您的公众账号JSAPI支付授权目录!');
                $("#store_name").focus();
            }else if(!$("#sub_appid").val()){
                layer.msg('请输入您的公众账号APPID!');
                $("#sub_appid").focus();
            }else if(!$("#subscribe_appid").val()) {
                layer.msg('请输入您需要推荐关注的公众账号APPID!');
                $("#subscribe_appid").focus();
            }else{
                $.post("{{route('webankeditsubdevconfigpost')}}",
                        {
                            _token: '{{csrf_token()}}',
                            store_id:$("#store_id").val(),
                            wx_wb_merchant_id:$("#wx_wb_merchant_id").val(),
                            jsapi_path_list:$("#jsapi_path_list").val(),
                            sub_appid:$("#sub_appid").val(),
                            subscribe_appid:$("#subscribe_appid").val(),



//                            ali_wb_merchant_id:$("#ali_wb_merchant_id").val(),
//                            store_name:$("#store_name").val(),
//                            alias_name:$("#alias_name").val(),
//                            id_type:$("#id_type").val(),
//                            id_no:$("#id_no").val(),
//                            licence_no:$("#licence_no").val(),
//                            contact_name:$("#contact_name").val(),
//                            contact_phone_no:$("#contact_phone_no").val(),
//                            merchant_type_code:$("#merchant_type_code").val(),
//                            wx_category_id:$("#wx_category_id").val(),
//                            ali_category_id:$("#ali_category_id").val(),
//                            account_no:$("#account_no").val(),
//                            account_opbank_no:$("#account_opbank_no").val(),
//                            account_name:$("#account_name").val(),
//                            account_opbank:$("#account_opbank").val(),
//                            commission_rate:$("#commission_rate").val(),
                        },
                        function (result) {
                            //layer.alert('修改成功', {icon: 6});
                            if (result.code == 0) {
                                layer.confirm('修改成功', {
                                    btn: ['确定'] //按钮
                                }, function () {
                                    window.location.href = "{{route('webankindex')}}";
                                });
//                                layer.alert('修改成功', {icon: 6});
                            }else{
                                layer.msg(result.msg);
                            }
                        }, "json")
                //layer.alert('修改成功', {icon: 6});
            }


        }
    </script>
    <script type="text/javascript">
        publicfileupload("#fileupload", ".files", "#client_cert1", ".up_progress .progress-bar", ".up_progress");
        publicfileupload("#fileupload1", ".files1", "#client_key1", '.up_progress1 .progress-bar1', ".up_progress1");
        publicfileupload("#fileupload2", ".files2", "#client_cert2", ".up_progress2 .progress-bar2", ".up_progress2");
        publicfileupload("#fileupload3", ".files3", "#client_key2", '.up_progress3 .progress-bar3', ".up_progress3");
        function publicfileupload(fileid, imgid, postimgid, class1, class2) {
            //图片上传
            $(fileid).fileupload({
                dataType: 'json',
                add: function (e, data) {
                    var numItems = $('.files .images_zone').length;
                    if (numItems >= 2) {
                        alert('提交文件过多');
                        return false;
                    }
                    $(class1).css('width', '0px');
                    $(class2).show();
                    $(class1).html('上传中...');
                    data.submit();
                },
                done: function (e, data) {
                    $(class2).hide();
                    $('.upl').remove();
                    var d = data.result;
                    if (d.status == 0) {
                        alert(d.error);
                    } else {
                        jQuery(postimgid).val(d.path);
                    }
                },
                progressall: function (e, data) {
                    console.log(data);
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $(class1).css('width', progress + '%');
                }
            });
        }
    </script>
@endsection