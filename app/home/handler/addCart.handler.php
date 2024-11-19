<?php
 // +----------------------------------------------------------------------
    // | 加入购物车功能
    // +----------------------------------------------------------------------
    include('../../../config/config.php');
    //获取商品id
    if(isset($_GET['id'])) {
        $product_id = $_GET['id']; 
    }
    //获取商品的数量
    if(isset($_GET['num'])) {
        $num = $_GET['num'];//获取商品数量
    }
    
    //判断用户有没有登陆
    $user_id = $_SESSION['user']['id'];
    if(!$user_id) {
        notice("请登陆后在加入购物车！");
    }

    //判断用户是否第一次加入此商品大到购物车
    $sql = "select * from carts where user_id={$user_id} and product_id={$product_id}";
    $cart = fetchOne($link,$sql);

    //如果此用户的购物车有此商品，那么就更新此商品的数量
    if(!empty($cart['num'])) {
        $cart_id = $cart['id'];
        $where = "id=".$cart_id;
        $data = array(
            "num"=>$cart['num']+$num
        );
        update($link,$data,'carts',$where);
    }

    //如果此用户的购物车没有此加入过此商品，那么就直接添加此商品和数量到购物车中
    if(empty($cart['num'])) {
        $data = array(
            "num" => $num,
            "product_id" => $product_id,
            "user_id" => $user_id,
            "addtime" => date("Y-m-d H:i:s")
        );

        insert($link,$data,'carts');
    }

    //保存成功后，跳转到购物车页面
    noticeUrl('加入购物车成功','/app/home/addCart.php');
