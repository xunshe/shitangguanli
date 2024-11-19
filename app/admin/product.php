 <?php
    // +----------------------------------------------------------------------
    // | 后台管理菜品页面
    // +----------------------------------------------------------------------
    
    //引用常用的函数
    require_once('../../config/config.php');

    //判断管理员有没有访问的权限,validateAdmin(),在common/helpers.php
    validateAdmin();

    //引入头部
    include('header-layout.php');
?>
 

 <div class="content-wrapper"> 
        <!--内容-->
        <section class="content-header">
            <h1>菜品列表</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 信息管理</a></li>
                <li class="active">信息列表</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">信息列表</h3>
                            <div class="box-tools">
                                 <div class="input-group input-group-sm" style="width: 150px;">
                                    <a href="/app/admin/add_product.php"><button class="btn btn-success">添加菜品</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>编号</th>
                                    <th>菜品图片</th>
                                    <th>标题</th>
                                    <th>菜品分类</th>
                                    <th>价格</th>
                                    <th>是否招牌菜</th>
                                    <th>是否上架</th>
                                    <th>操作事项</th>
                                </tr>
                                <?php
                                    //写查询菜品的sql语句
                                    $sql = "SELECT categorys.category_name,products.* FROM products INNER JOIN categorys ON categorys.id=products.category_id";

                                    //查询所有菜品
                                    $products = fetchAll($link,$sql);
                                    //判断是否是个数组
                                    if(is_array($products)){
                                        //遍历每一个管理员
                                        foreach($products as $product) {
                                ?>

                                <tr>
                                    <td><?php echo $product['id'] ?></td>
                                    <td><img src="<?php echo $product['img'] ?>" width="120px" height="100px"></td>
                                    <td><?php echo mb_substr($product['title'], 0,36) ?></td>
                                    <td><?php echo $product['category_name'] ?></td>
                                    <td><?php echo $product['price'] ?></td>
                                    <td><?php echo $product['is_recommed']==1?'是':'否'; ?></td>
                                    <td><?php echo $product['is_xiajia']==1?'是':'否'; ?></td>
                                    <td>
                                         <a class="label label-info" href="/app/admin/edit_product.php?id=<?php echo $product['id']?>">修改</a>
                                         <a class="label label-success" onclick="zhaopai(<?php echo $product['id']?>)">招牌</a>
                                         <a class="label label-warning" onclick="shangjia(<?php echo $product['id']?>)">上下架</a>
                                        <a class="label label-danger" onclick="del(<?php echo $product['id'] ?>,'products')">删除</a>
                                    </td>
                                </tr>
                                <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                
                    </div>
                </div>
            </div>
        </section>

    </div>



<?php include('footer-layout.php'); ?>


<script>
    //删除菜品的方法
    function del(id,table) {
        if(confirm('确定删除吗？')){
        $.post('/app/admin/handler/del_product.handler.php',{id:id,table:table},function(data){
            if(data.result == 1) {
                alert(data.message);
                window.location.reload();
            }

            if(data.result == 0) {
                alert(data.message);
            }
        },'json');
        }else{
            return false;
        }
    }

    //推荐的方法
    function zhaopai(id) {
         $.post('/app/admin/handler/tuijian_product.handler.php',{id:id},function(data){
            if(data.result == 1) {
                alert(data.message);
                window.location.reload();
            }

            if(data.result == 0) {
                alert(data.message);
            }
        },'json');
    }

    //商品上下架方法
    function shangjia(id) {
         $.post('/app/admin/handler/shangjia_product.handler.php',{id:id},function(data){
            if(data.result == 1) {
                alert(data.message);
                window.location.reload();
            }

            if(data.result == 0) {
                alert(data.message);
            }
        },'json');
    }

</script>