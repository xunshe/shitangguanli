<?php
	// +---------------------------------------------------------------------------------------------
	// |管理员添加新的员工信息
	// +----------------------------------------------------------------------------------------------
	
	//引用常用帮助的函数
	require_once('../../../config/config.php');

	//获取新员工的数据
	$code = $_POST['code'];
	$name = $_POST['name'];
	$avatar = $_FILES['avatar'];
	$phone = $_POST['phone'];
	$sex = $_POST['sex'];
	$birth = $_POST['birth'];
	$city = $_POST['city'];
	$zhiwei = $_POST['zhiwei'];
	$email = $_POST['email'];

	//上传员工的证件照
	$avatar = uploadImg($avatar,'../../../public/uploads');

	//如果上传图片失败，提示
	if(!$avatar) {
		exit('上传证件照失败！');
	}


	//保存员工的数据到数据库中
	$data = array(
		'code' => $code,
		'name' => $name,
		'avatar' => $avatar,
		'phone' => $phone,
		'sex' => $sex,
		'birth' => $birth,
		'city' => $city,
		'zhiwei' => $zhiwei,
		'email' => $email,
		'addtime' => date('Y-m-d')
	);

	$result = insert($link,$data,'staffs');

	if($result) {
		echo "<script>alert('员工信息保存成功');window.location.href='/app/admin/staff.php';</script>";
	}else{
		echo "<script>alert('员工保存失败，请重试！');history.back();</script>";
	}