<?php
	// +----------------------------------------------------------------------
    // | 后台订单列表页面
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
            <h1>订单管理</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 订单管理</a></li>
                <li class="active">管理列表</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">订单列表</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>编号</th>
                                    <th>订单用户</th>
                                    <th>取餐号</th>
                                    <th>订单号</th>
                                    <th>订单时间</th>
                                    <th>订单状态</th>
                                    <th>操作</th>
                                </tr>


                                <?php
                                	//写查询订单的sql语句,获取所订单
                                	$sql = 'SELECT * FROM order_code INNER JOIN users on order_code.user_id=users.id ';
                                	//查询所有订单
                                	$orders = fetchAll($link,$sql);
                                	//判断news是否是个数组
                                	if(is_array($orders)){
                                		//遍历每一个用户
                                		foreach($orders as $key=>$order) {
                                ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $order['name']?></td>
                                    <td>排：<?php echo $order['jiaohao']?>号</td>
                                    <td><?php echo $order['code_num']?></td>
                                    <td><?php echo $order['addtime']?></td>
                                    <td><?php echo $order['pay_status']==0?'<span class="label label-warning">未付款</span>':'<span class="label label-success">已付款</span>'  ?></td>
                                    <td> <a href="/app/admin/orderInfo.php?code_num=<?php echo $order['code_num'] ?>"><button class="btn btn-info btn-xs">订单详情</button></a></td>
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
