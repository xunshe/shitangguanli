  <?php
    // +----------------------------------------------------------------------
    // | 后台添加员工页面
    // +----------------------------------------------------------------------
    
    //引用常用的函数
    require_once('../../config/config.php');
    //判断判断管理员有没有访问的权限,如果没有，那么回退到登录页面，validateAdmin(),在common/helpers.php
    validateAdmin();
    

    //引入头部
    include('header-layout.php');
?>  
<div class="content-wrapper">
        <!--内容-->
        <section class="content-header">
            <h1>添加员工</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 员工添加</a></li>
                <li class="active">添加员工</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">员工添加</h3>
                        </div>
                        <form role="form" action="/app/admin/handler/add_staff.handler.php" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="input_title">员工姓名</label>
                                    <input type="text" class="form-control" id="name" required name="name" placeholder="请输入员工姓名！">
                                </div>
                                <div class="form-group">
                                    <label for="input_title">员工编号</label>
                                    <input type="text" class="form-control" id="price" required name="code" placeholder="请输入员工编号！">
                                </div>
                                <div class="form-group">
                                    <label for="input_title">手机号</label>
                                    <input type="number" class="form-control" id="price" required name="phone" placeholder="请输入员工手机号">
                                </div>
                               <div class="form-group">
                                  <label for="article-title" >性别</label>
                                  <select name="sex" class="form-control" required>
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="article-title" >出生日期</label>
                                  <input type="date"  name="birth" class="form-control" required placeholder="请输入员工的出生日期" required  >
                                </div>
                                <div class="form-group">
                                  <label for="article-title" >户籍城市</label>
                                  <input type="text"  name="city" class="form-control" required placeholder="请输入员工户籍城市" required  >
                                </div>
                                <div class="form-group">
                                  <label for="article-title" >邮箱</label>
                                  <input type="text"  name="email" class="form-control" required placeholder="请输入员工邮箱" required  >
                                </div>
                                 <div class="form-group">
                                  <label for="article-title" >所属职位</label>
                                  <input type="text"  name="zhiwei" class="form-control" required placeholder="请输入员工食堂职位" required  >
                                </div>
                                <div class="form-group">
                                    <label for="logo">员工证件照</label>
                                    <input type="file" id="img" name="avatar" required>   
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">添加</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--内容-->
    </div>


<?php include('footer-layout.php') ?>