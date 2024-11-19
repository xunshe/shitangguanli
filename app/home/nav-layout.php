

<div class="panel menu-cart">
  <div class="panel-body">
      <div class="row">
	      <ul class="nav nav-secondary">
			    <li class="active"><a href="#">菜单分类</a></li>
				<li ><a href="/app/home/zhaopai.php">招牌菜</a></li>
			</ul>
	  </div>
	  <div class="row">
	      <div class="col-xs-8 col-sm-12 col-lg-12">
	      <?php 
			//首页上获取所有的分类 
		    $sql  = "SELECT * FROM categorys ORDER BY id ASC"; 
		    $categorys = fetchAll($link,$sql);
	      	if(is_array($categorys)){
	      		foreach($categorys as $category) {
	      ?>
			  <div class="col-xs-4 col-sm-2 col-lg-1">
			  	<a href="/app/home/list.php?id=<?php echo $category['id'] ?>"><p class="menu-all"><?php echo $category['category_name'] ?></p></a>
              </div>
		  <?php }} ?>
          </div>
      </div>  
  </div>
</div>