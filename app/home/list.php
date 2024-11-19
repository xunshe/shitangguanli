<?php 
    // +----------------------------------------------------------------------
    // | 菜品某个分类页面
    // +----------------------------------------------------------------------
    include('../../config/config.php');

    include('header-layout.php');

    //获取分类信息 
    $id = $_GET['id'];
    $sql3 = "SELECT * FROM categorys WHERE id='$id'";
    $categoryd = fetchOne($link,$sql3);
?>

	
<div class="row">
<div class="contents">
	<div class="container">
		
		<?php
			//引入菜单分类
			include('nav-layout.php');
		 ?>
		
		<div class="row">
	        <div class="col-sm-9">
	            <div class="panel">
				  <div class="panel-heading">
				    <?php echo $categoryd['category_name'] ?>
				  </div>
				  <div class="panel-body">
				      <?php
				      	//获取此分类下的菜品
				      	$category_id = $categoryd['id'];
				        $sql = "SELECT * FROM products WHERE category_id='$category_id' AND is_xiajia=1";
				      	$products = fetchAll($link,$sql);
				      	if(is_array($products)) {
				      		foreach($products as $product){
				       ?>
				      <div class="col-xs-4 col-sm-3 col-lg-3">
				      <a href="/app/home/detail.php?id=<?php echo  $product['id'];?>" class="card" >
						  <div class="media-wrapper">
						     <img src="<?php echo $product['img'] ?>" style="height: 130px;width: 183px">
						  </div>
						  <input type="hidden" value="{{$s->menu_id}}" ></input>
						  <div class="caption"><?php echo $product['description'] ?></div>
						  <div class="card-heading"><strong><?php echo $product['title'] ?></strong><span class="pull-right price"><?php echo $product['price'] ?>元</span></div>
						   <div class="card-actions">
							    <button type="button" class="btn btn-success add-to-cart"><i class="icon-plus "></i>详情</button>
							    <div class="pull-right text-success"><i class="icon-heart-empty"></i>520人喜欢</div>
                           </div>
						  <div class="card-content text-muted"></div>     
					  </a>
					  </div>
					
                   <?php }}else{
                   	echo "<h2>抱歉，暂无菜品信息！</h2>";
                   } ?>                
				  </div>
				</div>
			</div>
			<?php
			include('aside-layout.php'); 
			?>
		</div>
	</div>
</div>
</div>



<?php          
    //引入公共底部部分
    include('footer-layout.php');
?>