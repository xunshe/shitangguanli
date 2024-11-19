<?php
    // +----------------------------------------------------------------------
    // | 修改密码
    // +----------------------------------------------------------------------

    //引用常用的函数
    require_once('../../../config/config.php');

    //获取原密码
    $oldpassword = $_POST['oldpassword'];
    //获取新密码
    $password = $_POST['password'];
    //获取重复密码
    $repassword = $_POST['repassword'];

    //判断用户输入的旧密码是否为空
    if (!$oldpassword) {
        //如果为空，返回提示信息
        ajaxReturn(0, '请输入旧密码');
    }


    //判断用户输入的新密码是否为空
    if (!is_password($password)) {
           ajaxReturn(0,'新密码格式不正确，最少6位');
    }


    //判断用户输入的重复密码是否为空
    if ($repassword != $password) {
           ajaxReturn(0,'两次输入的密码不一致，请重新输入！');
    }

    //判断用户输入的原密码是否正确
    $user_id = $_SESSION['user']['id'];
    $sql = "SELECT * FROM users WHERE id='$user_id'";

    $user = fetchOne($link,$sql);

    if($oldpassword != $user['password']) {
        ajaxReturn(0,'抱歉，您输入的旧密码错误，请重新输入！');
    }


    //更新新的密码
    $where = "id='$user_id'";
    $data = array(
        "password"=>$password
    );

    $result = update($link,$data,'users',$where);

    if($result) {
        ajaxReturn(1,'密码更新成功！');
    }else{
        ajaxReturn(0,'密码更新失败！');
    }



