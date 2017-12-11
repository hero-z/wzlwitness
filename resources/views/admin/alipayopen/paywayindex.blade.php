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
                        <h5>合肥优乐佳餐饮有限公司分店列表<small>添加新分店是在该店铺下新添加分店;绑定分店是将原有无分店的总店添加为该店铺的分店,单独收款</small></h5>
                    </div>
                    <form action="https://a.ft361.com/admin/webank/branchlist?pid=25" method="post">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input placeholder="请输入商户简称"  class="input-sm form-control" type="text" name="alias_name"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="7Vftf9P3K0HIHYmBK0qATitjaDp8XEZUUFW8txTt">
                    </form>
                    <a href="https://a.ft361.com/admin/webank/branchadd?pid=25">
                        <button class="btn btn-success " type="button"><span class="bold">添加分店</span></button>
                    </a>
                    <a href="https://a.ft361.com/admin/alipayopen/addOldBranchIndex?pid=25&amp;type=webank" class="btn btn-sm btn-primary">绑定分店</a>
                    <a href="https://a.ft361.com/admin/webank/restore"> <button type="button" class="btn btn-outline btn-default">还原商户</button></a>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>商户id</th>
                                    <th>商户简称</th>
                                    <th>联系人名称</th>
                                    <th>联系人手机号</th>
                                    <th>归属员工</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>b1498788895622565</td>
                                    <td><span class="pie">赵征擀面皮</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498788895622565">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498788895622565&amp;store_name=%E8%B5%B5%E5%BE%81%E6%93%80%E9%9D%A2%E7%9A%AE">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498788895622565",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498788895622565")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498788914883556</td>
                                    <td><span class="pie">快点小炒</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498788914883556">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498788914883556&amp;store_name=%E5%BF%AB%E7%82%B9%E5%B0%8F%E7%82%92">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498788914883556",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498788914883556")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498788940398149</td>
                                    <td><span class="pie">懒汉杂粮粉铁板饭</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498788940398149">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498788940398149&amp;store_name=%E6%87%92%E6%B1%89%E6%9D%82%E7%B2%AE%E7%B2%89%E9%93%81%E6%9D%BF%E9%A5%AD">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498788940398149",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498788940398149")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498788979215315</td>
                                    <td><span class="pie">重庆小面</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498788979215315">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498788979215315&amp;store_name=%E9%87%8D%E5%BA%86%E5%B0%8F%E9%9D%A2">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498788979215315",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498788979215315")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498789004856533</td>
                                    <td><span class="pie">张正麻辣串（百大店）</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498789004856533">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498789004856533&amp;store_name=%E5%BC%A0%E6%AD%A3%E9%BA%BB%E8%BE%A3%E4%B8%B2%EF%BC%88%E7%99%BE%E5%A4%A7%E5%BA%97%EF%BC%89">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498789004856533",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498789004856533")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498789027762210</td>
                                    <td><span class="pie">韩食汇石锅拌饭</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498789027762210">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498789027762210&amp;store_name=%E9%9F%A9%E9%A3%9F%E6%B1%87%E7%9F%B3%E9%94%85%E6%8B%8C%E9%A5%AD">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498789027762210",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498789027762210")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498789043269793</td>
                                    <td><span class="pie">巫山烤全鱼</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498789043269793">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498789043269793&amp;store_name=%E5%B7%AB%E5%B1%B1%E7%83%A4%E5%85%A8%E9%B1%BC">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498789043269793",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498789043269793")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498789068672572</td>
                                    <td><span class="pie">食尚花甲</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498789068672572">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498789068672572&amp;store_name=%E9%A3%9F%E5%B0%9A%E8%8A%B1%E7%94%B2">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498789068672572",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498789068672572")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498789095150054</td>
                                    <td><span class="pie">乐麻麻骨香麻辣烫</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498789095150054">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498789095150054&amp;store_name=%E4%B9%90%E9%BA%BB%E9%BA%BB%E9%AA%A8%E9%A6%99%E9%BA%BB%E8%BE%A3%E7%83%AB">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498789095150054",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498789095150054")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b1498789214483299</td>
                                    <td><span class="pie">优乐佳美食城</span></td>
                                    <td>刘</td>
                                    <td><span class="pie">18326638806</span></td>
                                    <td><span class="pie">张明明</span></td>
                                    <td>
                                        <a href="https://a.ft361.com/admin/webank/editcode?store_id=b1498789214483299">
                                            <button  type="button" class="btn btn-outline btn-success">收款信息</button>
                                        </a>












                                        <a href="https://a.ft361.com/admin/webank/cashierlist?store_id=b1498789214483299&amp;store_name=%E4%BC%98%E4%B9%90%E4%BD%B3%E7%BE%8E%E9%A3%9F%E5%9F%8E">
                                            <button type="button" class="btn btn-outline btn-primary">收银员管理
                                            </button>
                                        </a>
                                        <button id="cpay" onclick='co("b1498789214483299",0)' type="button"
                                                class="btn btn-outline btn-warning">关闭收款
                                        </button>
                                        <button onclick='del("b1498789214483299")' type="button"
                                                class="btn btn-outline btn-warning">删除
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers"
                                 id="DataTables_Table_0_paginate">
                                <ul class="pagination">

                                    <li class="disabled"><span>&laquo;</span></li>





                                    <li class="active"><span>1</span></li>
                                    <li><a href="https://a.ft361.com/admin/webank/branchlist?pid=25&amp;page=2">2</a></li>


                                    <li><a href="https://a.ft361.com/admin/webank/branchlist?pid=25&amp;page=2" rel="next">&raquo;</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- 全局js -->
    <script>
        function del(id) {
            //询问框
            layer.confirm('确定要删除', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post("https://a.ft361.com/admin/webank/deletestore", {_token: "7Vftf9P3K0HIHYmBK0qATitjaDp8XEZUUFW8txTt", id: id},
                    function (data) {
                        if(data.success){
                            window.location.href = "https://a.ft361.com/admin/webank/branchlist?pid=25";
                        }else{
                            layer.msg(data.erro_message)
                        }
                    }, "json");
            }, function () {

            });
        }

        function co(id, type) {
            if (type == 0) {
                //询问框
                layer.confirm('确定要关闭此商户的收款功能', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post("https://a.ft361.com/admin/webank/paystatus", {_token: "7Vftf9P3K0HIHYmBK0qATitjaDp8XEZUUFW8txTt", id: id, type: type},
                        function (data) {
                            window.location.href = "https://a.ft361.com/admin/webank/branchlist?pid=25";
                        }, "json");
                }, function () {

                });
            } else {
                //询问框
                layer.confirm('确定要开启此商户的收款功能', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.post("https://a.ft361.com/admin/webank/paystatus", {_token: "7Vftf9P3K0HIHYmBK0qATitjaDp8XEZUUFW8txTt", id: id, type: type},
                        function (data) {
                            window.location.href = "https://a.ft361.com/admin/webank/branchlist?pid=25";
                        }, "json");
                }, function () {

                });
            }
        }
    </script>
@endsection
@section('js')
@endsection