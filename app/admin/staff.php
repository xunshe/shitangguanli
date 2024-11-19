<?php
	// +----------------------------------------------------------------------
    // | 后台用户管理页面
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
            <h1>员工管理</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 员工管理</a></li>
                <li class="active">员工列表</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">员工列表</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <a href="/app/admin/add_staff.php"><button class="btn btn-success">添加员工</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>工作编号</th>
                                    <th>姓名</th>
                                    <th>证件照</th>
                                    <th>手机号</th>
                                    <th>邮箱</th>
                                    <th>性别</th>
                                    <th>出生日期</th>
                                    <th>居住地</th>
                                    <th>职位</th>
                                    <th>入职时间</th>
                                    <th>操作事项</th>
                                </tr>


                                <?php
                                	$sql = 'SELECT * FROM staffs ORDER BY id DESC';
                                	//查询所有用户
                                	$staffs = fetchAll($link,$sql);
                                	//判断staffs是否是个数组
                                	if(is_array($staffs)){
                                		//遍历每一个用户
                                		foreach($staffs as $staff) {
                                ?>

                                <tr>
                                    <td><?php echo $staff['code']?></td>
                                    <td><?php echo $staff['name']?></td>
                                    <td><img style="width: 100px" src="<?php echo $staff['avatar'] ?>"></td>
                                    <td><?php echo $staff['phone']?></td>
                                    <td><?php echo $staff['email']?></td>
                                    <td><?php echo $staff['sex']?></td>
                                    <td><?php echo $staff['birth']?></td>
                                    <td><?php echo $staff['city']?></td>
                                    <td><?php echo $staff['zhiwei']?></td>
                                    <td><?php echo $staff['addtime']?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="delstaff(<?php echo $staff['id'] ?>,'staffs')"  class="label label-danger">删除</a>
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
    //删除用户的方法
    function delstaff(id,table) {
        if(confirm('确定删除此职工信息吗')){
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
