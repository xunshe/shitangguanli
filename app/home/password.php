<?php
    // +----------------------------------------------------------------------
    // | 个人修改密码 页面
    // +----------------------------------------------------------------------

    //引入头部公共部分
    include('header-layout.php');
  
?>
<div class="container" style="margin-top: 7%;margin-bottom: 20%">
    <?php 
      //引入个人资料菜单
        include('profile-layout.php');
    ?>
    <div class="col-md-9">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;密码修改</h3>
            </div>
            <div class="panel-body">
                <form role="form">
                    <fieldset>
                            <div class="form-group">
                                <label for="input_name"><span class="glyphicon glyphicon-user"></span>&nbsp;输入旧密码</label>
                                <input  class="form-control"  placeholder="请输入密码"  id="oldpassword" name="name" type="password">
                            </div>
                            <div class="col-md-12" id="error_name"></div>
                             <div class="form-group">
                                <label for="input_name"><span class="glyphicon glyphicon-user"></span>&nbsp;输入新密码</label>
                                <input  class="form-control"  placeholder="请输入密码"  id="password" name="name"  type="password">
                            </div>
                            <div class="form-group">
                                <label for="input_email"><span class="glyphicon glyphicon-envelope"></span>&nbsp;重复输入新密码</label>
                                <input id="repassword" class="form-control" placeholder="请再次输入密码"  type="password">
                            </div>
                            <div class="col-md-12" id="error_info"></div>
                        <button type="button" class="btn btn-success" onclick="changePassword()"><span class="glyphicon glyphicon-saved"></span>&nbsp;保存修改</button>
                        </fieldset>
            
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    function changePassword() {
        var oldpassword = $('#oldpassword').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();

        $.post("/app/home/handler/changePassword.handler.php",{oldpassword:oldpassword,password:password,repassword:repassword}, function(data){
            if( data.result == 1 ){
                alert('恭喜你,密码修改成功');
                window.location.reload();
            }else{
                alert(data.message);
                window.location.reload();
            }
        },'json');
    }   

</script>
<?php          
    //引入公共底部部分
    include('footer-layout.php');
?>
