<?php
	// +----------------------------------------------------------------------
    // | 用户收藏菜品功能
    // +----------------------------------------------------------------------
    
	//引用常用的函数
	require_once('../../../config/config.php');

	//获取产品id
	$id = $_POST['id'];

    //获取评论的用户id
    $user_id = $_SESSION['user']['id'];

    //判断用户有没有登录，没有登录不准收藏
    if(!$user_id) {
    	ajaxReturn(0,'抱歉，请登录后再收藏！');
    }

    //判断有没有收藏过此菜品
    $sql = "SELECT * FROM collects WHERE user_id='$user_id' AND product_id=$id";
    $result2 = fetchOne($link,$sql);
    if($result2) {
        ajaxReturn(0,'此菜品已经收藏过');
    } 

    //组装数据
    $data = array(
    	'product_id'=>$id,
    	'user_id'=>$user_id,
    	'addtime'=>date('Y-m-d H:i:s')
    );

    //把组装的数据插入到数据库collects表中
    $result = insert($link,$data,'collects');


    if($result) {
        //收藏成功的话，菜品收藏数加1
        $sql2 = "SELECT * FROM products WHERE id='$id'";
        $result3 = fetchOne($link,$sql2);
        $view = $result3['view']+1;
        $where = 'id='.$id;
        $data2 = array(
            'view'=>$view,
        );
        update($link,$data2,'products',$where);


    	   ajaxReturn(1,'收藏成功！');
    }else{
    	   ajaxReturn(0,'收藏失败！');
    }
