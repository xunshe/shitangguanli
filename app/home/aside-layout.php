<?php
	// +----------------------------------------------------------------------
    // | 网站公告模块
    // +----------------------------------------------------------------------
	//获取最新的公告信息
	$sql = "SELECT * FROM news ORDER BY id DESC limit 1";

	$new = fetchOne($link,$sql);
?>

<div class="col-sm-3 hidden-xs">
		<div class="panel hot-news">
			<div class="panel-body"><p>网站公告</p></div>
	        <div class="alert alert-primary with-icon">
	   			<div class="content"><?php echo $new['new_title'] ?></div>
			</div>
		</div>

		<div class="panel">
			<div class="panel-heading">
			  	热度排行榜top5
			</div>
			<div class="panel-body">
				<?php
					$sql ="SELECT * FROM products ORDER BY view DESC limit 5";
					$products = fetchAll($link,$sql);
					if(is_array($products)){
					foreach($products as $key=>$product){
				?>
				<a href="/app/home/detail.php?id=<?php echo  $product['id'];?>"><p style="margin-left: 30px"><span style="color:red">top<?php echo $key+1 ?></span><span style="margin-left: 10px"><?php echo $product['title'] ?></span></p></a>
				<?php 
				 }}else{
				 	echo '暂无';
				 }
				?>
			</div>
		</div>
</div>
