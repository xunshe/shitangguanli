<?php
	// +----------------------------------------------------------------------
    // | 后台公告管理列表页面
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
            <h1>公告管理</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 公告管理</a></li>
                <li class="active">管理列表</li>
            </ol>
        </section>
        <section class="content" id="showcontent">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">公告列表</h3>
                            <div class="box-tools">
                                 <div class="input-group input-group-sm" style="width: 150px;">
                                    <a href="/app/admin/add_news.php"><button class="btn btn-success">添加公告</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>编号</th>
                                    <th>标题</th>
                                    <th>发布时间</th>
                                    <th>操作事项</th>
                                </tr>


                                <?php
                                	//写查询公告的sql语句,获取所有公告
                                	$sql = 'SELECT * FROM news';

                                	//查询所有用户
                                	$news = fetchAll($link,$sql);
                                	//判断news是否是个数组
                                	if(is_array($news)){
                                		//遍历每一个用户
                                		foreach($news as $new) {
                                ?>
                                <tr>
                                    <td><?php echo $new['id']?></td>
                                    <td><?php echo cur_str($new['new_title'],30)?></td>
                                    <td><?php echo $new['addtime']?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="delnew(<?php echo $new['id'] ?>,'news')"  class="label label-danger">删除</a>
                                        <a href="/app/admin/edit_news.php?id=<?php echo $new['id'] ?>"  class="label label-info">修改</a>
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
    //删除公告的方法
    function delnew(id,table) {
        if(confirm('确定删除此公告信息吗？')){
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
