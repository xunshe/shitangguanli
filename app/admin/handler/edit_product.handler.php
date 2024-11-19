<?php

	// +---------------------------------------------------------------------------------------------
	// | 管理员修改菜品功能
	// +----------------------------------------------------------------------------------------------
	
	//引用常用帮助的函数
	require_once('../../../config/config.php');

	//获取发送来的数据
	$title = $_POST['title'];
	$category_id = $_POST['category_id'];
	$img = $_FILES['img'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$content = $_POST['content'];
	$id = $_POST['id'];
	$where = 'id='.$id;

	//先自定义个错误提示信息 
	$error = '';

	//判断后台的信息有没有填写完整
	if(empty($title)) {
		$error = '请输入产品标题';
		exit($error);
	}


	//判断后台的信息有没有填写完整
	if(empty($price)) {
		$error = '请输入产品的价格';
		exit($error);
	}

	//判断后台的信息有没有填写完整
	if(empty($description)) {
		$error = '请输入描述';
		exit($error);
	}

	if(empty($content)) {
		$error = '请输入产品详情';
		exit($error);
	}

	if(empty($category_id)) {
		$error = '请选择产品分类';

	}

	if(!empty($img['tmp_name'])){
		//具体上传图片操作,其中上传图片的函数在common/helpers.php里
		// 参数$img是视频文件  ，第二个是保存的地址
		$img = uploadImg($img,'../../../public/uploads');

		//如果上传图片失败，提示
		if(!$img) {
			exit('上传图片失败！');
		}

		//组装要插入数据库的数据
		$data = array(
			'title' =>$title,
			'category_id'=>$category_id,
			'img'=>$img,
			'price'=>$price,
			'description'=>$description,
			'content'=>$content,
			'addtime'=>date('Y-m-d H:i:s'),
		);

		$result = update($link,$data,'products',$where);

		if($result) {
			echo "<script>alert('数据修改成功！');window.location.href='/app/admin/product.php';</script>";
		}else{
			echo "<script>alert('修改失败，请重试！');</script>";
		}
	}else{
		//组装要插入数据库的数据
		$data = array(
			'title' =>$title,
			'category_id'=>$category_id,
			'price'=>$price,
			'description'=>$description,
			'content'=>$content,
			'addtime'=>date('Y-m-d H:i:s'),
		);

		$result = update($link,$data,'products',$where);

		if($result) {
			echo "<script>alert('数据修改成功！');window.location.href='/app/admin/product.php';</script>";
		}else{
			echo "<script>alert('修改失败，请重试！');</script>";
		}
	}

	
	
		








