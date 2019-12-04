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
    $transfer_status = isset($row['transfer_status']) ? $row['transfer_status'] : "";

    $data = $cls->getData('kb_order_confirm','order_id='."'".$order_id."'",''); 
    foreach($data as $row){
        $product_price = isset($row['pd_confirm_price']) ? $row['pd_confirm_price'] : 0;
        $pd_total_price += $product_price;
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ยืนยันการโอนเงิน</title>

    <!-- Custom fonts for this template-->
    <link href="https://2jds.com/analytics/plugins/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <!-- <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> -->
    <!-- Custom styles for this template-->
    <link href="https://2jds.com/analytics/plugins/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
    
    <link href="https://2jds.com/analytics/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://2jds.com/analytics/css/datepicker3.css" rel="stylesheet" type="text/css" />
    

    <script src="https://2jds.com/analytics/plugins/sb-admin-2/vendor/jquery/jquery.min.js"></script>
    <script src="https://2jds.com/analytics/js/bootstrap.min.js"></script>
    <script src="https://2jds.com/analytics/js/bootstrap-datepicker.js"></script>

    <script>
        $(function () {
            $(".datepicker").datepicker({
                    format: 'dd/mm/yyyy', 
                    autoclose: true, 
                    todayHighlight: true
            }).datepicker('update', new Date());
 
           
        });
    </script>

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

                        <?php if ($transfer_status == 'waiting'){ ?>
                            <div class="row">
                                <div class="col-lg-12" style="margin-top: 15px;">  
                                    <div class="p-3 text-center">
                                        <h4 class="small font-weight-bold">เจ้าหน้าที่กำลังตรวจสอบการโอน... <span class="float-right">60%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h1 class="h4 text-gray-900 mb-2" style="font-size: 30px;">เจ้าหน้าที่กำลังตรวจสอบการโอน...</h1>
                                    </div> 
                                </div>
                            </div>
                        <?php } else if ($transfer_status == 'complete'){ ?>

                            <div class="row">
                                <div class="col-lg-12" style="margin-top: 15px;">  
                                    <div class="p-3 text-center">
                                        <h4 class="small font-weight-bold">นำส่งสินค้า <span class="float-right">80%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h1 class="h4 text-gray-900 mb-2" style="font-size: 30px;">นำส่งสินค้า EMS NO. 1254685425452</h1>
                                    </div> 
                                </div>
                            </div>

                        <?php } else { ?>
                            <div class="row">
                                <div class="col-lg-12" style="height: 0;margin-top: 15px;"> 
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">ยืนยันการโอนเงิน</h1>
                                        <p class="mb-4"></p> 
                                    </div> 
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-5" style="padding-bottom: 0px !important;">
                                        <div class="text-center" style="background-color: #ddd;border: solid 1px #858796;padding: 10px 5px;margin-top: 20px;border-radius: 5px;">
                                            <p>กรุณาโอนเงินจำนวน</p>
                                            <h3><?php echo $pd_total_price; ?> บาท</h3>
                                            <p>เข้าบัญชีด้านล่าง</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6" style="margin-top: 35px;">
                                    <div class="p-4" > 
                                        
                                        <form class="user" method="post" enctype="multipart/form-data"
                                            action="controller/users_controller.php">
        
                                            <div class="form-group">
                                                <select class="form-control" name="bank_transfer" id="bank_transfer" required>
                                                    <option class="lang_please_bank" value="" selected="">โปรดเลือกชื่อธนาคารที่โอน</option>
                                                    <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                                                    <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option> 
                                                    <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                                                    <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                                                </select>
                                            </div>

                                            <div class="form-group">  
                                                <div class="detail_transfer" style="display:none;">
                                                    <p>รายละเอียดการโอน</p>
                                                    <div id = "show_detail_transfer"> </div> 
                                                </div>
                                            </div>
                                        
                                        
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" id="bank_transfer_no" name="bank_transfer_no"
                                                    placeholder="โอนเงินเข้าเลขที่บัญชี" required>
                                            </div>
                                        
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" id="transfer_amount" name="transfer_amount"
                                                    placeholder="ยอดเงินที่โอน" value="<?php echo $pd_total_price; ?>" required>
                                            </div>
                                            <div class="input-group" style="width: auto;">
                                                <input type="text" class="form-control datepicker" name="bank_transfer_date" id="bank_transfer_date" value=""  required>
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </div>

                                                <input id="timepicker" type="text" class="form-control" name="bank_transfer_time" style="margin-left: 10px;" value="" placeholder="hh:mm" required>
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </div>
                                                
                                            </div>

                                            <div class="form-group" style="margin-top: 15px;">
                                                <input type="hidden" id="hid_order_id" name="hid_order_id"   value="<?php echo $order_id; ?>">
                                                <input type="hidden" id="hid_submit_form" name="submit_form" value="confrim_payment">
                                                <input type="submit" class="form-control" name="btn_submit_form" value="ยืนยัน" style="background-color: #224abe;color: white;">
                                            </div>
                                        </form>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    
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

        jQuery('#bank_transfer').on('change', function() {
            var sel_val = $(this).val(); 
            $('#bank_transfer_no').val('1234567890');

            if (sel_val == 'ธนาคารกสิกรไทย'){
                $('.detail_transfer').css("display", "block");
                $('#show_detail_transfer').html("<img src='/line-liff-starter/assets/img/kbank_logo.jpg'><span> 1234567890</span><br> <span> ชื่อบัญชี Demo demo</span>");
            } else if (sel_val == 'ธนาคารกรุงเทพ'){
                $('.detail_transfer').css("display", "block");
                $('#show_detail_transfer').html("<img src='/line-liff-starter/assets/img/bangkok_logo.jpg'><span> 1234567890</span><br> <span> ชื่อบัญชี Demo demo</span>");
            } else if (sel_val == 'ธนาคารไทยพาณิชย์'){
                $('.detail_transfer').css("display", "block");
                $('#show_detail_transfer').html("<img src='/line-liff-starter/assets/img/scb_logo.jpg'><span> 1234567890</span><br> <span> ชื่อบัญชี Demo demo</span>");
            } else if (sel_val == 'ธนาคารกรุงไทย'){
                $('.detail_transfer').css("display", "block");
                $('#show_detail_transfer').html("<img src='/line-liff-starter/assets/img/ktb_logo.jpg'><span> 1234567890</span><br> <span> ชื่อบัญชี Demo demo</span>");
            } else {
                $('.detail_transfer').css("display", "none");
            }

        });


    });

    </script>
</body>

</html>