  <?php
    // +----------------------------------------------------------------------
    // | 后台添加菜品页面
    // +----------------------------------------------------------------------
    
    //引用常用的函数
    require_once('../../config/config.php');
    //判断判断管理员有没有访问的权限,如果没有，那么回退到登录页面，validateAdmin(),在common/helpers.php
    validateAdmin();

    //引入头部
    include('header-layout.php'); 
?>

<link rel="stylesheet" href="/public/wangEditor/dist/css/wangEditor.min.css">  
<div class="content-wrapper">
        <!--内容-->
        <section class="content-header">
            <h1>添加菜品</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 菜品添加</a></li>
                <li class="active">添加菜品</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">菜品添加</h3>
                        </div>
                        <form role="form" action="/app/admin/handler/add_product.handler.php" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="input_title">菜品名称</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="请输入菜品名称！">
                                </div>
                                <div class="form-group">
                                    <label for="input_title">菜品价格</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="请输入菜品价格！">
                                </div>
                                <div class="form-group">
                                    <label for="input_title">菜品分类选择</label>
                                        
                                              <select class="form-control" name="category_id">
                                                <?php 
                                                    //获取所有的分类
                                                    $sql = "SELECT * FROM categorys";
                                                    $categorys = fetchAll($link,$sql);
                                                    if(is_array($categorys)){
                                                        foreach ($categorys as $category) {                                                           
                                                ?>

                                                <option value="<?php echo $category['id'] ?>"><?php echo $category['category_name'] ?></option>
                                                  <?php }}?>
                                              </select>
                                       
                                </div>
                                <div class="form-group">
                                    <label for="movieinfo">菜品描述</label>
                                    <textarea class="form-control" rows="10" name="description" id="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="logo">上传菜品图片</label>
                                    <input type="file" id="img" name="img">   
                                </div>
                                <div class="form-group">
                                    <label for="movieinfo">菜品详情信息</label>
                                    <textarea id="textarea1"  class="form-control"  style="height: 400px;max-height: 400px;" name="content"> </textarea>
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

<script src="/public/wangEditor/dist/js/wangEditor.min.js"></script>
<script>
      var editor = new wangEditor('textarea1');
      editor.config.menus = [
        'fontsize',
        'bold',
        'italic',
        'eraser',
        'forecolor',
        'fontfamily',
        'head',
        'orderlist',
        'alignleft',
        'aligncenter',
        'alignright',
        'emotion',
        'undo',
        'redo',
     ];
  
    editor.create();    
  </script>

<?php include('footer-layout.php') ?>