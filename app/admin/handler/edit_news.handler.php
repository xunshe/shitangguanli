<?php

	// +---------------------------------------------------------------------------------------------
	// | 修改公告功能
	// +----------------------------------------------------------------------------------------------
	
	//引用常用帮助的函数
	require_once('../../../config/config.php');


	//获取发送来的数据
	$new_title = $_POST['new_title'];

	$id = $_POST['id'];
	$where = 'id='.$id;

	
		//组装要插入数据库的数据
		$data = array(
			'new_title' =>$new_title,  
			
			'addtime'=>date('Y-m-d H:i:s'),
		);

		$result = update($link,$data,'news',$where);

		if($result) {
			echo "<script>alert('数据保存成功！');window.location.href='/app/admin/news.php';</script>";
		}else{
			echo "<script>alert('数据更新失败，请重试！');</script>";
		}
	

	






