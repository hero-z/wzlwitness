@extends('layouts.public')
@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>支付宝交易流水
                <small>所有支付宝支付订单的查询，商户可以通过该接口主动查询订单状态</small>
            </h5>
        </div>
        <div class="ibox-content">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline" role="grid">
                <table style="Word-break: break-all;" class="table table-striped table-bordered table-hover dataTables-example dataTable"
                       id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr role="row">

                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 333px;" aria-label="浏览器：激活排序列升序">支付宝交易号
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 308px;" aria-label="平台：激活排序列升序">店铺ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">商户名称
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">收银员
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 142px;" aria-label="引擎版本：激活排序列升序">创建时间
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">更新时间
                        </th>

                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">总金额
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 189px;" aria-label="渲染引擎：激活排序列升序" aria-sort="ascending">订单来源
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">交易状态
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                            style="width: 144px;" aria-label="CSS等级：激活排序列升序">备注
                        </th>
                    </tr>
                    </thead>
                    <tbody id="appends">
                    @if($datapage)
                        @foreach($datapage as $v)
                            <tr class='gradeA odd'>
                                <td class=''>{{$v->trade_no}}</td>
                                <td class=''>{{$v->store_id}}</td>
                                <td class=''>{{$v->main_shop_name}}</td>
                                <td class=''>
                                    @if($v->merchant_id&&isset($cashier[$v->merchant_id]))
                                        {{$cashier[$v->merchant_id]}}
                                    @endif
                                </td>
                                <td class=''>{{$v->created_at}}</td>
                                <td class=''>{{$v->updated_at}}</td>
                                <td class=''>{{$v->total_amount}}</td>
                                @if($v->type=="101")
                                <td class=''>二维码当面付</td>
                                @endif
                                @if($v->type=="102")
                                    <td class=''>二维码口碑</td>
                                @endif
                                @if($v->type=="103")
                                    <td class=''>扫码枪当面付</td>
                                @endif
                                @if($v->type=="104")
                                    <td class=''>当面付固定金额</td>
                                @endif
                                @if($v->type=="105")
                                    <td class=''>扫码枪口碑</td>
                                @endif
                                @if($v->type=="106")
                                    <td class=''>口碑固定金额</td>
                                @endif
                                @if($v->pay_status=="1")
                                    <td style="color: green">
                                        <button type="button" class="btn btn-outline btn-success">付款成功</button>
                                    </td>
                                @endif
                                @if($v->pay_status=="2")
                                    <td class=''>
                                        <button type="button" class="btn btn-outline btn-danger">取消支付</button>
                                    </td>
                                @endif
                                @if($v->pay_status=="3")
                                    <td class=''>
                                        <button type="button" class="btn btn-outline btn-danger">等待支付</button>
                                    </td>
                                @endif
                                @if($v->pay_status=="4")
                                    <td class=''>
                                        <button type="button" class="btn btn-outline btn-danger">订单关闭</button>
                                    </td>
                                @endif
                                @if($v->pay_status=="5")
                                    <td class=''>
                                        <button type="button" class="btn btn-outline btn-danger">已退款</button>
                                    </td>
                                @endif
                                @if($v->pay_status=="")
                                    <td class=''>
                                        <button type="button" class="btn btn-outline btn-danger">支付失败</button>
                                    </td>
                                @endif
                                <td class=''>
                                   {{$v->remark}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            {{$paginator->render()}}
                        </div>
                    </div>
                </div>

                @else
                    <div class="row">
                        没有任何交易记录
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection

@section('js')
    {{--
        <script>
            window.onload = get;
            function get(){
                getinfo();
            }
            function getinfo() {
                $.post("{{route("ApplyOrderBatchQuery")}}", {_token:"{{csrf_token()}}"}, function (data) {
                    for (var key in data) {
                        var selObj = $("#appends");
                        selObj.append(
                                "<tr class='gradeA odd' >"+
                                "<td class=''>"+data[key].action+"</td>" +
                                "<td class=''>"+data[key].apply_id+"</td>" +
                                "<td class=''>"+data[key].biz_id+"</td>" +
                                "<td class=''>"+data[key].create_time+"</td>" +
                                "<td class=''>"+data[key].update_time+"</td>" +
                                "<td class=''>"+data[key].result_code+"</td>"+
                                "<td class=''>"+data[key].result_code+"</td>"+
                                "</tr>"
                        );
                    }
                }, "json");
            }
        </script>--}}
@endsection