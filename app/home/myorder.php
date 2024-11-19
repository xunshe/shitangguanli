<?php
    // +----------------------------------------------------------------------
    // | 个人资料我的订单页面
    // +----------------------------------------------------------------------
    include('../../config/config.php');
    //引入头部公共部分
    include('header-layout.php');

       //判断用户有没有登录，如果没有登录转跳到登录页面 
    if (empty($_SESSION['user'])){
            echo "<script>alert('抱歉，请先登录后在查看')</script>";
            redirect('/app/home/login.php');
    } 
  
?>
<div class="container" style="margin-top: 7%;margin-bottom: 20%">
    <?php 
      //引入个人资料菜单
        include('profile-layout.php');
    ?>
    <div class="col-md-9">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;我的订单</h3>
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>订单编号</th>
                      <th>取号码</th>
                      <th>付款状态</th>
                      <th>生成时间</th>
                      <th>付款</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $user_id = $_SESSION['user']['id'];
                    $sql = "SELECT * FROM order_code  WHERE user_id='$user_id' ";
                    $orders = fetchAll($link,$sql);
                    if(is_array($orders)) {
                        foreach($orders as $order){
                  ?>
                    <tr>
                      <td><?php echo $order['code_num'] ?></td>
                      <td>排：<?php echo $order['jiaohao'] ?>号</td>

                      <td><?php echo $order['pay_status']==0?'<span class="label label-warning">未付款</span>':'<span class="label label-success">已付款</span>'?></td>
                      <td><?php echo $order['addtime'] ?></td>
                      <td><a href="/app/home/pay.php?id=<?php echo $order['id'] ?>">付款</a></td>
                    </tr>
                    <?php }}?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php          
    //引入公共底部部分
    include('footer-layout.php');
?>
