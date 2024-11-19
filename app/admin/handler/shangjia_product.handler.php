<?php
	// +----------------------------------------------------------------------
	// |  后台菜品的上下架功能
	// +----------------------------------------------------------------------

	//引用常用的函数
	require_once('../../../config/config.php');

	//获取发来的数据
	$id = $_POST['id']; //获取数据的id
	//检查是否正确获取到id
	if(!$id) {
		ajaxReturn(0,'抱歉，参数错误！');
	}

	//查看当前商品的状态
	$sql = "SELECT * FROM products WHERE id='$id'";
	$result = fetchOne($link,$sql);

	if($result['is_xiajia'] == 1 ) {
		//如果当前状态是审核通过状态，那么限制
		$data = array('is_xiajia'=>0);
		$result2 = update($link,$data,'products','id='.$id);
		if($result2) {
			ajaxReturn(1,'此商品下架成功');
		}else{
			ajaxReturn(0,'失败，请重试！');
		}
	}
	

	if($result['is_xiajia'] == 0 ) {
		//如果当前状态是限制状态，那么通过
		$data = array('is_xiajia'=>1);
		$result2 = update($link,$data,'products','id='.$id);
		if($result2) {
			ajaxReturn(1,'此商品上架成功！');
		}else{
			ajaxReturn(0,'失败，请重试！');
		}
	}

