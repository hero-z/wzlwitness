@extends('layouts.publicStyle')
@section('css')
    <link href="{{asset('css/bootstrap.min.css?v=3.3.6')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$store_name}}分店列表<small>添加新分店是在该店铺下新添加分店;绑定分店是将原有无分店的总店添加为该店铺的分店,单独收款</small></h5>
                    </div>
                    <a href="{{url('/admin/newland/NewLandBranchRestore?pid='.$_GET['pid'])}}"  class="btn btn-sm btn-danger" style="color:white;">还原</a>
                    <a href="{{url('/admin/newland/NewLandBranchAdd?pid='.$_GET['pid'])}}">
                        <button class="btn btn-success " type="button"><span class="bold">添加分店</span></button>
                    </a>
                    <a href="{{url('admin/alipayopen/addOldBranchIndex?pid='.$_GET['pid'].'&type=newland')}}" class="btn btn-sm btn-primary">绑定分店</a>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>店铺ID</th>
                                    <th>店铺名称</th>
                                    <th>商户号</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($datapage)
                                    @foreach($datapage as $v)
                                        <tr>
                                            <td>{{$v['store_id']}}</td>
                                            <td>{{$v['store_name']}}</td>
                                            <td>{{$v['merc_id']}}</td>
                                            <td>{{$v['created_at']}}</td>
                                            <td>
                                                <a href="{{url('admin/alipayopen/CashierIndex?store_id='.$v['store_id'].'&store_name='.$v['store_name'])}}">
                                                    <button type="button" class="btn btn-success">收银员管理
                                                    </button>
                                                </a>
                                                <a href="{{url('admin/newland/NewLandBills?id='.$v['id'])}}"  class="btn btn-sm btn-default" style="color:white;">流水</a>
                                                <a href="{{url("/admin/newland/ChangeNewLand?id=".$v['id'])}}"><button class="btn btn-success" type="button">删除</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers"
                                     id="DataTables_Table_0_paginate">
                                    {{$datapage->appends(['pid'=>$pid])->links()}}
                                </div>
                            </div>
                        </div>
                        @else
                            没有记录

                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
@endsection