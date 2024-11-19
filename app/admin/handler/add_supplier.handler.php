<?php

	// +----------------------------------------------------------------------
	// | 添加供应商的功能
	// +----------------------------------------------------------------------

	//引用常用的函数
	require_once('../../../config/config.php');  

	//获取前台发来的数据
	$supplier_name = $_POST['supplier_name'];
	$supplier_phone = $_POST['supplier_phone'];
	$supplier_address = $_POST['supplier_address'];
	$supplier_type = $_POST['supplier_type'];

	//判断填入的是否正确
	if(!$supplier_name) {
		ajaxReturn(0,'请输入供应商名！');
	}
	if(!$supplier_phone) {
		ajaxReturn(0,'请输入供应商电话！');
	}
	if(!$supplier_address) {
		ajaxReturn(0,'请输入供应商地址！');
	}

    if(!$supplier_type) {
		ajaxReturn(0,'请输入供应商类型！');
	}

	//组装数据
	$data = array(
		'supplier_name'=>$supplier_name,
		'supplier_phone'=>$supplier_phone,
		'supplier_address'=>$supplier_address,
		'supplier_type'=>$supplier_type,
		'addtime'=>date('Y-m-d H:i:s'),
	);

	//保存标签到suppliers表,其中的$link在include.php里
	$result2 = insert($link,$data,'suppliers');

	//注册成功和失败的话，返回提示
	if(!$result2) {
		ajaxReturn(0,'添加失败！');
	}else{
		ajaxReturn(1,'添加成功');
	}
