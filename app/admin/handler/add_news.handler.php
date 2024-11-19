<?php

	// +---------------------------------------------------------------------------------------------
	// | 添加公告功能
	// +----------------------------------------------------------------------------------------------
	
	//引用常用帮助的函数 
	require_once('../../../config/config.php');


	//获取发送来的数据
	$new_title = $_POST['new_title'];
	
	//先自定义个错误提示信息
	$error = '';

	//判断后台的信息有没有填写完整
	if(empty($new_title)) {
		$error = '请输入标题';
		exit($error);
	}


	//组装要插入数据库的数据
	$data = array(
		'new_title' =>$new_title,
		'addtime'=>date('Y-m-d H:i:s'),
	);

	$result = insert($link,$data,'news');

	if($result) {
		echo "<script>alert('数据保存成功！');window.location.href='/app/admin/news.php';</script>";
	}else{
		echo "<script>alert('保存失败，请重试！');window.location.href='/app/admin/add_news.php';</script>";
	}







