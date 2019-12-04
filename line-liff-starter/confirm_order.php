<?php
    $config = (@$_GET['lang']==''||@$_GET['lang']=='th'?'config_th.php' : 'config_en.php');

    require_once('config/'.$config);
    require_once('config/connect.php');
    require_once('class/class_main.php');

    $cls = new Main($pdo);

    $order_id = '';
    if (isset($_GET['order_id']) && !empty($_GET['order_id'])){
        $order_id = $_GET['order_id'];
    }else {
        echo "คุณไม่มีสิทธิเข้าหน้านี้";
        die();
    }

    $data = $cls->getData('kb_orders_log','ID='."'".$order_id."'",''); 
    foreach($data as $row);                                       
    $ID = isset($row['ID']) ? $row['ID'] : "0";
    $FirstName = isset($row['FirstName']) ? $row['FirstName'] : "-";
    $LastName = isset($row['LastName']) ? $row['LastName'] : "";
    $PhoneNo = isset($row['PhoneNo']) ? $row['PhoneNo'] : "-";
    $Email = isset($row['Email']) ? $row['Email'] : "-";
    $LineID = isset($row['LineID']) ? $row['LineID'] : "-";
    $Created_Date = isset($row['Created_Date']) ? $row['Created_Date'] : "-";
    $bank_transfer = isset($row['bank_transfer']) ? $row['bank_transfer'] : "";
    $bank_transfer_no = isset($row['bank_transfer_no']) ? $row['bank_transfer_no'] : "";
    $transfer_status = isset($row['transfer_status']) ? $row['transfer_status'] : "";


    $products = $cls->getData('kb_products',"del_flag='N'",''); 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ยืนยันการสั่งซื้อของลูกค้า</title>

    <!-- Custom fonts for this template-->
    <link href="https://2jds.com/analytics/plugins/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="https://2jds.com/analytics/plugins/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    @font-face {
        font-family: 'prompt_lightregular';
        src: url('/line-liff-starter/assets/fonts/prompt/prompt-light-webfont.woff2') format('woff2'),
            url('/line-liff-starter/assets/fonts/prompt/prompt-light-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;

    }

    body {
        font-family: prompt_lightregular;
    }
    table th, table td {
        font-weight: unset;
    }
    </style>

</head>

<body class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12" style="height: 0;margin-top: 15px;"> 
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">ยืนยันลูกค้า</h1>
                                    <p class="mb-4"></p> 
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5" style="padding-bottom: 0px !important;">
                                    <div class="text-center">
                                        <p>
                                            ชื่อลูกค้า : <?php echo $FirstName.' '.$LastName; ?> <br>
                                            เบอร์โทร : <?php echo $PhoneNo; ?>
                                        </p>
                                        <?php if ( !empty($transfer_status) ){ ?>
                                        <div>
                                            <h5>ข้อมูลการโอน</h5>
                                            <span>ชื่อธนาคาร : <?php echo $bank_transfer; ?></span><br>
                                            <span>เลขบัญชี : <?php echo $bank_transfer_no; ?></span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5"> 
                                <?php if ( !empty($transfer_status) ){ ?> 

                                    <div class="text-center"> 
                                        <h5>รายละเอียด</h5>
                                        <table style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>จำนวน</th>
                                                    <th>ราคา</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                           
                                                $data = $cls->getData_custom_qry("SELECT t1.*,t2.pd_name_th FROM kb_order_confirm t1 INNER JOIN kb_products t2 ON t1.pd_confirm_id = t2.ID WHERE t1.del_flag = 'N' AND t2.del_flag = 'N' AND order_id = ".$order_id);  
                                                foreach($data as $row){ 
                                                    $pd_name_th = isset($row['pd_name_th']) ? $row['pd_name_th'] : "";
                                                    $pd_confirm_count = isset($row['pd_confirm_count']) ? $row['pd_confirm_count'] : "0";
                                                    $pd_confirm_price = isset($row['pd_confirm_price']) ? $row['pd_confirm_price'] : "0";
                                                   
                                                    $pd_total_count += $pd_confirm_count;
                                                    $pd_total_price += $pd_confirm_price;

                                                    echo "<tr>
                                                            <th>". $pd_name_th ."</th>
                                                            <th>". $pd_confirm_count ."</th>
                                                            <th>". $pd_confirm_price ."</th>
                                                        </tr>";
                                                }                                       
                                            
                                            ?>
                                                <tr>
                                                    <th>รวม</th>
                                                    <th><?php echo $pd_total_count; ?></th>
                                                    <th><?php echo $pd_total_price; ?></th>
                                                </tr>
                                            </tbody>
                                        </table> 
                                        
                                    </div>

                                <?php } else { ?>
                                    <form class="user" method="post" enctype="multipart/form-data"
                                        action="controller/users_controller.php">

                                        <?php 
                                            foreach($products as $row) { 
                                                $ID = isset($row['ID']) ? $row['ID'] : "0";
                                                $pd_name_th = isset($row['pd_name_th']) ? $row['pd_name_th'] : "-";
                                                $pd_name_en = isset($row['pd_name_en']) ? $row['pd_name_en'] : ""; 
                                        ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="chk_product[]" class="custom-control-input"
                                                    id="chk_product-<?php echo $ID; ?>" value = "<?php echo $ID; ?>"
                                                    data-productID="<?php echo $ID; ?>">
                                                <label class="custom-control-label"
                                                    for="chk_product-<?php echo $ID; ?>"><?php echo $pd_name_th ?></label>
                                                <input type="hidden" id="hid_pd_name_th" name="hid_pd_name_th-<?php echo $ID; ?>"
                                                value="<?php echo $pd_name_th; ?>">
                                            </div>
                                            <div style="display: none;width: 45%;"
                                                class="chk_detail-<?php echo $ID; ?>">
                                                <input type="number" class="form-control"
                                                    id="product_count-<?php echo $ID; ?>"
                                                    name="product_count-<?php echo $ID; ?>" placeholder="จำนวน"
                                                    style="height: 30px;text-align: center;">
                                            </div>
                                            <div style="display: none;width: 45%;"
                                                class="chk_detail-<?php echo $ID; ?>">
                                                <input type="text" class="form-control"
                                                    id="product_price-<?php echo $ID; ?>"
                                                    name="product_price-<?php echo $ID; ?>" placeholder="ราคา"
                                                    style="height: 30px;text-align: center;">
                                            </div>

                                        </div>
                                        <?php } ?>

                                        <div class="form-group">
                                            <input type="hidden" id="hid_order_id" name="hid_order_id"
                                                value="<?php echo $order_id; ?>">
                                            <input type="submit" class="form-control" name="submit_form" value="confrim_order"
                                                style="background-color: #224abe;color: white;">
                                        </div>
                                    </form>
                                    <hr>
                                <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://2jds.com/analytics/plugins/sb-admin-2/vendor/jquery/jquery.min.js"></script>
    <script src="https://2jds.com/analytics/plugins/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://2jds.com/analytics/plugins/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://2jds.com/analytics//plugins/sb-admin-2/js/sb-admin-2.min.js"></script>

    <script>
    jQuery(function() {

        jQuery("input[name = 'chk_product[]']").on("click", function(e) {
            var productID = $(this).attr('data-productID');
            if ($(this).prop("checked") == true) {
                jQuery(".chk_detail-" + productID).css('display', 'inline-block');

            } else {
                jQuery(".chk_detail-" + productID).css('display', 'none');

            }
        });


    });
    </script>
</body>

</html>