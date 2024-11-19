<?php
	// +----------------------------------------------------------------------
	// | 用户上传讨论
	// +----------------------------------------------------------------------

	//引用常用帮助的函数
	require_once('../../../config/config.php');

	//获取发送来的数据
	$post_title = $_POST['post_title'];
	$post_content = $_POST['post_content'];
	$user_id = $_SESSION['user']['id'];
	$type_id = $_POST['type_id'];
	//先自定义个错误提示信息
	$error = '';
	//判断后台的信息有没有填写完整
	if(empty($post_title)) {
		$error = '请输入讨论的标题';
		exit($error);
	}

	//判断有没有选择标签
	if(empty($post_content)) {
		$error ='请输入讨论的内容';
		exit($error);
	}

	//判断有没有上传歌手
	if(empty($user_id)) {
		$error = '请登录后再发布讨论';
		exit($error); 
	}

	//组装要插入数据库的数据
	$data = array(
		'post_title' =>$post_title,                                           
		'post_content'=>$post_content,
		'user_id'=>$user_id,
		'type_id'=>$type_id,
		'addtime'=>date('Y-m-d H:i:s'),
	);

	$result = insert($link,$data,'posts');

	if($result) {
		echo "<script>alert('讨论发表成功！');window.location.href='/app/home/bbs.php';</script>";
	}else{
		echo "<script>alert('发表失败，请重试！');window.location.href='/app/home/bbs-post.php';</script>";
	}





