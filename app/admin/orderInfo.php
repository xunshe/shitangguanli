<?php
	// +----------------------------------------------------------------------
    // | 后台查看订单的详情信息
    // +----------------------------------------------------------------------
	
	//引用常用的函数
	require_once('../../config/config.php');

	//判断判断管理员有没有访问的权限,validateAdmin(),在common/helpers.php
	validateAdmin();

	//引入头部
	include('header-layout.php');
?>
 
  <div class="content-wrapper"> 
        <!--内容-->
        <section class="content-header">
            <h1>用户订单详情</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 订单详情</a></li>
                <li class="active">管理列表</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">订单详情列表</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>编号</th>
                                    <th>菜品标题</th>
                                    <th>菜品图片</th>
                                    <th>数量</th>
                                    <th>单价</th>
                                </tr>
                                <?php
                                    $code_num = $_GET['code_num'];
                                	//写查询订单的sql语句,获取所订单
                                	$sql = "SELECT * FROM orders INNER JOIN products on products.id=orders.product_id WHERE orders.order_code='$code_num'";

                                	//查询所有订单
                                	$orders = fetchAll($link,$sql);
                                	//判断news是否是个数组
                                	if(is_array($orders)){
                                		//遍历每一个用户
                                		foreach($orders as $order) {
                                ?>
                                <tr>
                                    <td><?php echo $order['id']?></td>
                                    <td><?php echo $order['title']?></td>
                                    <td><img src="<?php echo $order['img'] ?>" style="width: 60px;height: 60px" alt=""></td>
                                    <td><?php echo $order['order_num']?></td>
                                    <td><?php echo $order['price'] ?>元</td>
                                </tr>
                                <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--内容-->
    </div>


<?php include('footer-layout.php'); ?>

<script>
    //删的方法
    function delorder(id,table) {
        if(confirm('确定删除此订单信息吗？')){
        $.post('/app/admin/handler/del.handler.php',{id:id,table:table},function(data){
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
</script>
