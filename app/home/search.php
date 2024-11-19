<?php 
    // +----------------------------------------------------------------------
    // | 搜索页面
    // +----------------------------------------------------------------------
    include('../../config/config.php');

    include('header-layout.php');

    //获取到要搜索的内容 
    $keywords = $_GET['keyword'];

    $sql2 = "SELECT * FROM products WHERE title like '%{$keywords}%'";
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
                      搜索内容
                  </div>
                  <div class="panel-body">
                      <?php
                        $products = fetchAll($link,$sql2);
                        if(is_array($products)) {
                            foreach($products as $product){
                       ?>
                      <div class="col-xs-4 col-sm-3 col-lg-3">
                      <a href="/app/home/detail.php?id=<?php echo  $product['id'];?>" class="card" >
                          <div class="media-wrapper">
                            <img src="<?php echo $product['img'] ?>">
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
                    
                   <?php }} ?>                
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<?php          
    //引入公共底部部分
    include('footer-layout.php');
?>