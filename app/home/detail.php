<?php 
    // +----------------------------------------------------------------------
    // | 菜品详情页面
    // +----------------------------------------------------------------------
    include('../../config/config.php');

    include('header-layout.php'); 

    //获取当前的菜品
    $id = $_GET['id'];
    $sql = "SELECT categorys.category_name,products.* FROM products INNER JOIN categorys on categorys.id=products.category_id WHERE products.id='$id'";
    $product = fetchOne($link,$sql);

    //获取此菜品所有评论
    $sql2 = "SELECT * FROM comments INNER JOIN users ON comments.user_id=users.id WHERE product_id='$id' AND status=1";
    $comments = fetchAll($link,$sql2);

?>
	<div class="container" style="margin-top:7%"> 
            <ol class="breadcrumb">
              <li><a href="/">主页</a></li>
              <li><a href="#"><?php echo $product['category_name'] ;?></a></li>
            </ol>
            <div class="col-md-11">
                <div class="panel">
                  <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card" style="width: 350px;height: 300px;margin:30px">
                                <img src="<?php echo $product['img'] ;?>" style="width: 350px;height: 300px">
                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-top: 20px">
                            <small>分类-<?php echo $product['category_name'] ;?><span onclick="shoucang(<?php echo $product['id'] ?>)" style="font-size: 15px" class="pull-right"><i class="fa fa-star-o"></i>收藏</span></small>
                            <p style="font-size: 20px;"><?php echo $product['title'] ;?></p>
                            <hr/>
                            <input type="hidden" name="id" value="<?php echo $product['id'] ;?>">
                            <span style="font-size: 35px;color:red">￥&nbsp;&nbsp;<?php echo $product['price'] ?></span>
                            <a href="javascript:void(0)" class="button button-3d button-action button-rounded pull-right" onclick="addCart()">加入到菜单</a>
                            <div class="row" style="margin-top:20px;margin-left: 10px">
                             <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon right_down"><i class="fa fa-minus"></i></span>
                                    <input type="text" class="form-control right_number" name="num" style="width: 50px" value="1">
                                    <span class="input-group-addon right_up"><i class="fa fa-plus"></i>
                                     
                                    </span>
                                </div>
                            </div>
                            </div>
                            <hr/>
                    

                            <script>
                              //加入到购物车中的功能
                              function addCart() {
                                    //ID
                                    var id = $("input[name=id]").val();
                                    var num = $("input[name=num]").val();
                                    //跳转到购物车页面
                                    window.location.href = '/app/home/handler/addCart.handler.php?id='+id+'&num='+num;
                              }
                            </script>
                            
                            <p><?php echo $product['description'] ?></p>
                        </div>
                    </div>
                  </div>
                </div>
                 <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;菜品详情</h3>
                    </div>
                    <div class="panel-body">
                       <?php echo $product['content'] ;?>
                        
                    </div>
                </div>

                 <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;评价</h3>
                    </div>
                      <div class="panel-body">
                             
                            <?php 
                                if(is_array($comments)){
                                    //遍历每一个评论
                                    foreach($comments as $comment) {
                            ?>
                                <div class="comment">
                                  <a href="###" class="avatar">
                                    <img src="<?php echo $comment['avatar'] ?>" class="img-cricle">
                                  </a>
                                  <div class="content">
                                    <div class="pull-right text-muted"><?php echo $comment['addtime'] ?></div>
                                    <div><strong><?php echo $comment['name'] ?></strong>
                                    <div class="text" style="font-size: 18px"><?php echo $comment['comment_content']; ?></div>
                                  
                                  </div>
                                </div>
                            
                          </div>
                          <?php }}else{
                            echo '<h4>抱歉，目前还没有留言！</h4>';
                          } ?>
                        </div>
                </div>
                <div class="row">
                      <form role="form">
                        <div class="form-group">
                            <label for="name">评价</label>
                            <textarea id="comment_content" class="form-control"></textarea>
                            <input id="product_id" value="<?php echo $product['id']; ?>" type="hidden">
                        </div>
                        <button type="button" class="btn btn-default pull-right" onclick="commit()">发布评价</button>
                      </form>
                </div>
            </div>
        </div>

    <script>
    //用户发表留言
    function commit() {
        var comment_content = $("#comment_content").val();
        var product_id = $("#product_id").val();

        $.post('/app/home/handler/commit.handler.php',{comment_content:comment_content,product_id:product_id},function(data){
                if(data.result == 1) {
                    alert(data.message);
                    window.location.reload();
                }
                if(data.result == 0){
                    alert(data.message);
                }
        },'json');      
    } 

    //用户点击收藏
    function shoucang(id) {
         $.post('/app/home/handler/collection.handler.php',{id:id},function(data){
                if(data.result == 1) {
                    alert(data.message);
                    window.location.reload();
                }
                if(data.result == 0){
                    alert(data.message);
                }
        },'json');      
    }

   //购物车数量加减
    $(document).ready(function(){
        //获得文本框对象
        var t = $(".right_number");
        //初始化数量为1,并失效减
        $('.right_down').attr('disabled',true);
         //数量增加操作

         $(".right_up").click(function(){ 
          // 给获取的val加上绝对值，避免出现负数
          t.val(Math.abs(parseInt(t.val()))+1);
          if (parseInt(t.val()) !=1 ){
          $('.right_down').attr('disabled',false);
          };
         }) 
         //数量减少操作
         $(".right_down").click(function(){
         t.val(Math.abs(parseInt(t.val()))-1);
         if (parseInt(t.val()) < 1){
          t.val(1)
         };
         })
    });
</script>
<?php          
    //引入公共底部部分
    include('footer-layout.php');
?>