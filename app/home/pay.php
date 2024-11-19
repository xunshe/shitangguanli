<?php
    // +----------------------------------------------------------------------
    // | 支付页面
    // +----------------------------------------------------------------------
    include('../../config/config.php');
    //引入头部公共部分
    include('header-layout.php');

       //判断用户有没有登录，如果没有登录转跳到登录页面 
    if (empty($_SESSION['user'])){
            echo "<script>alert('抱歉，请先登录后在查看')</script>";
            redirect('/app/home/login.php');
    } 

    //获取订单id
    $id = $_GET['id'];
    $data = array( 'pay_status'=>1 );
    $where = 'id='.$id;
    update($link,$data,'order_code',$where);
  
?>
<div class="container" style="margin-top: 7%;margin-bottom: 20%">
    <?php 
      //引入个人资料菜单
        include('profile-layout.php');
    ?>
    <div class="col-md-9">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;支付页面</h3>
            </div>
            <div class="panel-body">
                  <img src="/public/images/pay.png" >
            </div>
        </div>
    </div>

</div>





<?php          
    //引入公共底部部分
    include('footer-layout.php');
?>
