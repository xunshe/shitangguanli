<?php 
    // +----------------------------------------------------------------------
    // | 生成订单页面页面
    // +----------------------------------------------------------------------
    include('../../config/config.php');

    include('header-layout.php');
    //判断用户有没有登录，如果没有登录转跳到登录页面
    if (empty($_SESSION['user'])){
            echo "<script>alert('抱歉，请先登录')</script>";
            redirect('/app/home/login.php');
    } 

    //获取此用户的收获地址 
    $user_id = $_SESSION['user']['id'];
    $sql = "SELECT * FROM addresses WHERE user_id='$user_id'";
    $addresses = fetchAll($link,$sql);
?>

    <div class="container" style="margin-top: 5%">
   		<h2>订单提交</h2>
		<h3 style="margin-top: 50px">选择收货地址</h3>
		<div class="row">
		<div class="col-md-6" style="margin-top: 2%">
		<form action="/app/home/handler/order.handler.php" method="post">
	      	<?php 
	      		if(is_array($addresses)) {
	      			foreach($addresses as $address){
	      	?>
	      	<input type="radio" name="address_id" value="<?php echo $address['id'] ?>" checked="checked" class="form-contral">
	      	<?php echo $address['address_content'].$address['address_name'].$address['address_phone'] ?><br/>
	      	<?php }}else{
	      		echo "<h4>没有收货地址，点击<a href='/app/home/add_address.php'>添加</a></h4>";
	      	}?>
    	</div>
    	</div>
	    <div class="row" style="margin-top: 2%">
			<h3>物品清单</h3>
		</div>
				<?php 
					if(!empty($_SESSION["cart"]))
		    			{
		        			$arr=$_SESSION["cart"];

		        			foreach($arr as $v) {
		        				 $id = $v['id'];
        				         $sql = "SELECT * FROM products where id='$id'";
        				         $product = fetchOne($link,$sql);
		    		?>

		 		<div class="row" style="margin-top: 2%">
		 			<div class="col-md-3">
		 				<img src="<?php echo $product['img'] ?>" width="150px" height="100px">
		 			</div>
		 			<div class="col-md-3">
		 					<h6><?php echo $product['title'] ?></h6>
 							<p>发货地：<?php echo $product['city'] ?></p>
 							<p>尺寸：<?php echo $product['size'] ?></p>
		 			</div>
		 			<div class="col-md-2">
                		<p style="font-size:14px;margin-top: 18px">数量:<?php echo $v['num']  ?></p>
            		</div>
		 			<div class="col-md-2">
		 				<p style="font-size:25px;margin-top: 18px">￥<?php echo $product['price'] ?></p>
		 			</div>
		 		</div>
		 		<hr/>
		 		<?php 
		 			}}else{
		 				echo "<h2 class='text-center'>当前购物清单
		 				为空</h2>";
		 			}
		 		?>
		 		<?php
		 			//获取总计价格
		 			$tot = 0;
		 			
		 			$tot = 0;
		 			if(!empty($_SESSION["cart"]))
		    			{
		        			$arr=$_SESSION["cart"];
		        			foreach($arr as $v) {
		                        $id = $v['id'];
		        				$sql = "SELECT * FROM products where id='$id'";
		        				$product = fetchOne($link,$sql);
		        				$tot+=$product['price']*$v['num'];
		        		     }
		        		}
		 		?>
		 		<h2 class="pull-right">总计<span class="text-success">￥<?php echo $tot ?></span>元<br/><br/>
		 		<a href="/app/home/order.php"><button type="submit" class="btn btn-success pull-right">提交</button></h2></a>
			</h2>

</form>
    </div>
<?php          
    //引入公共底部部分
    include('footer-layout.php');
?>