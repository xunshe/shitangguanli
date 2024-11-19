<?php
	// +----------------------------------------------------------------------
    // | 后台供应商列表页面
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
            <h1>供应商</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 供应商管理</a></li>
                <li class="active">管理列表</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">供应商列表</h3>
                            <div class="box-tools">
                                 <div class="input-group input-group-sm" style="width: 150px;">
                                    <a href="/app/admin/add_supplier.php"><button class="btn btn-success">添加供应商</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>编号</th>
                                    <th>名称</th>
                                    <th>电话</th>
                                    <th>地址</th>
                                    <th>供应类型</th>
                                </tr>
                                <?php
                                	//写查询供应商的sql语句,获取所有供应商
                                	$sql = 'SELECT * FROM suppliers';
                                	//查询所有用户
                                	$suppliers = fetchAll($link,$sql);
                                	//判断suppliers是否是个数组
                                	if(is_array($suppliers)){
                                		//遍历每一个用户
                                		foreach($suppliers as $supplier) {
                                ?>
                                <tr>
                                    <td><?php echo $supplier['id']?></td>
                                    <td><?php echo $supplier['supplier_name']?></td>
                                    <td><?php echo $supplier['supplier_phone']?></td>
                                    <td><?php echo $supplier['supplier_address']?></td>
                                    <td><?php echo $supplier['supplier_type']?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="delsupplier(<?php echo $supplier['id'] ?>,'suppliers')"  class="label label-danger">删除</a>
                                    </td>
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
    //删除供应商的方法
    function delsupplier(id,table) {
        if(confirm('确定删除此供应商信息吗？')){
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
