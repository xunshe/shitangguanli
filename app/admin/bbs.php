<?php
	// +----------------------------------------------------------------------
    // | 管理员管理论坛内容
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
            <h1>论坛管理</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 论坛管理</a></li>
                <li class="active">管理列表</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">发布列表</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>编号</th>
                                    <th>发布用户</th>
                                    <th>发布标题</th>
                                    <th>发布时间</th>
                                    <th>操作</th>
                                </tr>


                                <?php
                                	$sql = 'SELECT posts.*,users.name FROM posts  INNER JOIN users on posts.user_id=users.id ';
                                	//查询所有订单
                                	$posts = fetchAll($link,$sql);
                                	//判断news是否是个数组
                                	if(is_array($posts)){
                                		//遍历每一个用户
                                		foreach($posts as $key=>$post) {
                                ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $post['name']?></td>
                                    <td><?php echo $post['post_title']?></td>
                                    <td><?php echo $post['addtime']?></td>

                                    <td> 
                                        <a target="_block" href="/app/home/bbs-content.php?id=<?php echo $post['id'] ?>" ><button class="btn btn-info btn-xs">详情</button></a>
                                        <a href="javascript:void(0)" onclick="del(<?php echo $post['id'] ?>,'posts')"  class="label label-danger">删除</a></td>
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
    function del(id,table) {
        if(confirm('确定删除此用户发布的信息吗？')){
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
