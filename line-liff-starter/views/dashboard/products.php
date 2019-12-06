<?php
    $config = (@$_GET['lang']==''||@$_GET['lang']=='th'?'config_th.php' : 'config_en.php');

    require_once('../../config/'.$config);
    require_once('../../config/connect.php');
    require_once('../../class/class_main.php');

    $cls = new Main($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>ข้อมูลสินค้า</title>

    <?php include('../layouts/header.php'); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        <?php 
        include('../layouts/navbar.php'); 
        include('../layouts/sidebar.php'); 
    ?>


        <div class="content-wrapper">

            <section class="content-header">
                <h1>
                    Simple Tables
                    <small>preview of simple tables</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">รายการสินค้า</li>
                </ol>
            </section>


            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box-body text-right">
                            <button type="button" class="btn btn-success add-product" >
                                เพิ่มสินค้า
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="form_mgt_product_Modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">จัดการสินค้า</h4>
                        </div>
                        <form class="form_product_mgt" method="post" enctype="multipart/form-data" action="<?php echo path_root ?>controller/products_controller.php">
                            <div class="modal-body">

                                <input type="hidden" id="hid_pdID" name="hid_pdID" value="">
                                <div class="form-group">
                                    <label for="">รหัสสินค้า</label>
                                    <input type="text" class="form-control" id="pd_no" name="pd_no"
                                        placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="">รายละเอียดสินค้า TH</label>
                                    <input type="text" class="form-control" id="pd_name_th" name="pd_name_th"
                                        placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="">รายละเอียดสินค้า EN</label>
                                    <input type="text" class="form-control" id="pd_name_en" name="pd_name_en"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">ราคา/หน่วย</label>
                                    <input type="number" class="form-control" id="pd_price" name="pd_price"
                                        placeholder="" required>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                                <input type="hidden" id="submit_form" name="submit_form" value="add_product">
                                <input type="submit" class="btn btn-primary" name="btn_submit_form" value="บันทึก">

                            </div>
                        </form>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">รายการสินค้า</h3>

                                <!-- <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div> -->
                            </div>

                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                        <th>ที่</th>
                                        <th>รหัสสินค้า</th>
                                        <th>รายละเอียดสินค้า</th>
                                        <th>รายละเอียดสินค้า EN</th>
                                        <th>ราคา/หน่วย</th>
                                        <th>วันที่สร้าง</th>
                                        <th style="min-width: 120px;">จัดการข้อมูล</th>
                                    </tr>

                                    <?php 

                                $no_row = 1;
                                $data = $cls->getData('kb_products',"del_flag='N'",'ID DESC');
                                foreach($data as $row){	 
                                    
                                    $ID = isset($row['ID']) ? $row['ID'] : "";
                                    $pd_no = isset($row['pd_no']) ? $row['pd_no'] : "";
                                    $pd_name_th = isset($row['pd_name_th']) ? $row['pd_name_th'] : "";
                                    $pd_name_en = isset($row['pd_name_en']) ? $row['pd_name_en'] : "";
                                    $pd_price = isset($row['pd_name_en']) ? $row['pd_price'] : ""; 
                                    $Created_Date = isset($row['Created_Date']) ? $row['Created_Date'] : "-";
                                                                     
                                    echo '<tr class="tr-container-'.$ID.'">
                                            <td>'.$no_row.'</td> 
                                            <td class="td_pd_no-'.$ID.'">'.$pd_no.'</td> 
                                            <td class="td_pd_name_th-'.$ID.'">'.$pd_name_th.'</td> 
                                            <td class="td_pd_name_en-'.$ID.'">'.$pd_name_en.'</td>
                                            <td class="td_pd_price-'.$ID.'">'.$pd_price.'</td>
                                            <td>'.$Created_Date.'</td> 
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default">Action</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a class="edit-product" data-pdID="'.$ID.'" style="cursor: pointer;">แก้ไข</a></li>
                                                        <li><a class="delete-product" data-pdID="'.$ID.'" style="cursor: pointer;">ลบ</a></li>
                                                    </ul>
                                                </div>
                                            </td> 
                                        </tr>';
                                    $no_row +=1;
                                } 

                            ?>

                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

        </div>

        <?php include('../layouts/footer.php'); ?>

    </div>

    <?php include('../layouts/footer-script.php'); ?>
    
    <script>
        jQuery(function() {

            jQuery('.add-product').on('click', function() {
               
                $('#hid_pdID').val('');
                $('#pd_no').val('');
                $('#pd_name_th').val('');
                $('#pd_name_en').val('');
                $('#pd_price').val(''); 
                $('#submit_form').val('add_product');

                jQuery('#form_mgt_product_Modal').modal();

            });

            jQuery('.edit-product').on('click', function() {
                var pdID = $(this).attr('data-pdID');
                var pd_no = $('.td_pd_no-'+pdID).html();
                var pd_name_th = $('.td_pd_name_th-'+pdID).html();
                var pd_name_en = $('.td_pd_name_en-'+pdID).html();
                var pd_price = $('.td_pd_price-'+pdID).html();

                $('#hid_pdID').val(pdID);
                $('#pd_no').val(pd_no);
                $('#pd_name_th').val(pd_name_th);
                $('#pd_name_en').val(pd_name_en);
                $('#pd_price').val(pd_price); 
                $('#submit_form').val('update_product');

                jQuery('#form_mgt_product_Modal').modal();

            });


        });

    </script>

</body>

</html>