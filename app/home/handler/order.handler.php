<?php

	// +----------------------------------------------------------------------
    // |  用户保存订单信息
    // | 设计思路，获取到用户的电话和地址信息，还有购物车的商品信息，把他们都保存到
	// | orders 数据库表中，只要是购买过的商品，都会标记商品的状态，此购买的商品就
    // | 不会在上架了，因为已经购买了，并且卖家也会知道此商品购买了，就会发货了
    // +----------------------------------------------------------------------
    
		
	//引用常用的函数
	require_once('../../../config/config.php');


    $order_code1 = 'DZ'.time();

    //获取此用户的订单信息
    $user_id = $_SESSION['user']['id'];
    $cart_sql = "select * from carts where user_id={$user_id}";
    $carts = fetchAll($link,$cart_sql);


    $sql = "SELECT * FROM order_code ORDER BY id DESC limit 1";
    $order_code = fetchOne($link,$sql);

    if( empty($order_code)) {
        $jiaohao = 1;
    }else{
         $jiaohao = $order_code['jiaohao']+1;
    }

    //把订单的商品插入到订单表中
    foreach ($carts as $key => $value) {
    	$data = array(
            'order_code'=>$order_code1,
    		'product_id' => $value['product_id'],
    		'user_id'=>$_SESSION['user']['id'],
            'order_num'=>$value['num'],
    		'addtime'=>date('Y-m-d H:i:s')
    	);
    	insert($link,$data,'orders');
    }

    //把订单的订单号单独插入到一个订单号表中
    $data2 = array(
        'code_num'=>$order_code1,
        'jiaohao'=>$jiaohao,
        'user_id'=>$_SESSION['user']['id'],
        'addtime'=>date('Y-m-d H:i:s')
    );
    insert($link,$data2,'order_code'); 
  	
    echo "<script>alert('您的订单以生产，菜品制作中，请耐心等待');</script>";
    redirect('/app/home/myorder.php');
