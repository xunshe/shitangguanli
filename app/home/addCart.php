
<?php 
    // +----------------------------------------------------------------------
    // | 购物车页面
    // +----------------------------------------------------------------------
    include('../../config/config.php');

    include('header-layout.php'); 

   //判断用户有没有登录，如果没有登录转跳到登录页面
    if (empty($_SESSION['user'])){
            echo "<script>alert('抱歉，请先登录后再加入购物车')</script>";
            redirect('/app/home/login.php');
    } 
 
   $user_id = $_SESSION['user']['id'];
?> 
	
 <div class="container" style="margin-top: 8%;">
 <h2>我的菜单<a href="/"><button class="btn btn-primary pull-right">继续点餐</button></a></h2>
		<?php 
				//读取用户的购物车信息
				$sql = "select carts.*,products.title,products.img,products.price from carts,products where carts.product_id=products.id and  carts.user_id={$user_id}";
				$carts = fetchAll($link,$sql);
				if(!empty($carts)) {
					foreach($carts as $cart) {
    	?>

 		<div class="row" style="margin-top: 2%">
 			<div class="col-md-3">
 				<img src="<?php echo $cart['img'] ?>" width="150px" height="100px">
 			</div>
 			<div class="col-md-3">
 				<h6><?php echo $cart['title'] ?></h6>
 			</div>
            <div class="col-md-2">
                <p style="font-size:15px;margin-top: 18px">数量:&nbsp;&nbsp;<?php echo $cart['num']  ?></p>
            </div>
 			<div class="col-md-2">
 				<p style="font-size:25px;margin-top: 18px">￥<?php echo $cart['price'] ?></p>
 			</div>
 			<div class="col-md-2">
 				<a href="/app/home/handler/del_cart.php?id=<?php echo $cart['id'] ?>"><p style="font-size:14px;margin-top:25px" class="text-danger">删除</p></a>
 			</div>
 		</div>
 		<hr/>
 		<?php 
 			}}else{
 				echo "<h2 class='text-center'>当前购物车为空</h2>";
 			}
 		?>
 		<?php
 			//遍历购物车
			$totol = 0;
			foreach($carts as $cart) {
				$totol += ($cart['price']*$cart['num']);
			}
 		?>
 		<h2 class="pull-right">总计<span class="text-success">￥<?php echo $totol ?></span>元<br/><br/>
 		<a href="/app/home/handler/order.handler.php"><button class="btn btn-success pull-right">生成订单</button></h2></a>

 </div>
	

<?php          
    //引入公共底部部分
    include('footer-layout.php');
?>