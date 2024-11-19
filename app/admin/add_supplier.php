  <?php
    // +----------------------------------------------------------------------
    // | 后台添加供应商页面
    // +----------------------------------------------------------------------
    
    //引用常用的函数
    require_once('../../config/config.php');

    //判断判断管理员有没有访问的权限,validateAdmin(),在common/helpers.php
    validateAdmin();

    //引入头部
    include('header-layout.php');
?>


 
  <div class="content-wrapper">
        <!--内容-->
        <section class="content-header">
            <h1>供应商添加</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 供应商管理</a></li>
                <li class="active">添加供应商</li>
            </ol>
        </section>
        <div class="col-md-6 col-md-offset-3">
            <section class="content" id="showcontent">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">添加供应商</h3>
                            </div>
                        
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="input_name">供应商名称</label>
                                        <input type="text" class="form-control" id="supplier_name" placeholder="请输入供应商名称！">
                                    </div>
                                     <div class="form-group">
                                        <label for="input_name">供应商电话</label>
                                        <input type="text" class="form-control" id="supplier_phone" placeholder="请输入供应商电话！">
                                    </div>
                                     <div class="form-group">
                                        <label for="input_name">供应商地址</label>
                                        <input type="text" class="form-control" id="supplier_address" placeholder="请输入供应商地址！">
                                    </div>
                                     <div class="form-group">
                                        <label for="input_name">供应商品类型</label>
                                        <input type="text" class="form-control" id="supplier_type" placeholder="请输入供应商类型！">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="button" class="btn btn-primary" onclick="add()">添加</button>
                                </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!--内容-->
    </div>
    <script>
        //保存供应商方法
        function add() {
            var supplier_name = $('#supplier_name').val();
            var supplier_phone = $('#supplier_phone').val();
            var supplier_address = $('#supplier_address').val();
            var supplier_type = $('#supplier_type').val();

            $.post('/app/admin/handler/add_supplier.handler.php',{supplier_name:supplier_name,supplier_phone:supplier_phone,supplier_address:supplier_address,supplier_type:supplier_type},function(data){
                if(data.result == 1){
                    alert(data.message);
                    window.location.reload();
                }
                if(data.result == 0){
                    alert(data.message);
                }
            },'json')
        }

    </script>


    <?php include('footer-layout.php') ?>