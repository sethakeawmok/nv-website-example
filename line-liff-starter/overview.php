<?php
    $config = (@$_GET['lang']==''||@$_GET['lang']=='th'?'config_th.php' : 'config_en.php');

    require_once('config/'.$config);
    require_once('config/connect.php');
    require_once('class/class_main.php');

    $cls = new Main($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>รายชื่อลูกค้า</title>

    <!-- Custom fonts for this template-->
    <link href="../plugins/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <link href="../plugins/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <!-- <link href="../plugins/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="display:none;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">รายชื่อลูกค้า</h1>
                    <p class="mb-4"> <a target="_blank" href="#"></a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ที่</th>
                                            <th style="min-width: 150px;">ชื่อ-นามสกุล</th> 
                                            <th>เบอร์โทร</th>
                                            <th>ที่อยู่</th>
                                            <!-- <th>วันที่ลงทะเบียน</th> -->
                                            <th style="min-width: 200px;">สถานะการโอน</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>ที่</th>
                                            <th>ชื่อ</th>
                                            <th>นามสกุล</th>
                                            <th>เบอร์โทร</th>
                                            <th>Email</th>
                                            <th>Line ID</th>
                                            <th>วันที่ลงทะเบียน</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>

                                        <?php 
                                        $no_row = 1;
                                        $data = $cls->getData('kb_orders_log','','ID DESC');
                                        foreach($data as $row){	 
                                           
                                            $ID = isset($row['ID']) ? $row['ID'] : "0";
                                            $FirstName = isset($row['FirstName']) ? $row['FirstName'] : "-";
                                            $LastName = isset($row['LastName']) ? $row['LastName'] : "";
                                            $PhoneNo = isset($row['PhoneNo']) ? $row['PhoneNo'] : "-";
                                            $Address = isset($row['Address']) ? $row['Address'] : "-";
                                            $LineID = isset($row['LineID']) ? $row['LineID'] : "-";
                                            $Created_Date = isset($row['Created_Date']) ? $row['Created_Date'] : "-";
                                            $bank_transfer = isset($row['bank_transfer']) ? $row['bank_transfer'] : "-";  
                                            $bank_transfer_no = isset($row['bank_transfer_no']) ? $row['bank_transfer_no'] : "-"; 
                                            $transfer_datetime = isset($row['transfer_datetime']) ? $row['transfer_datetime'] : "-"; 
                                            $transfer_amount = isset($row['transfer_amount']) ? $row['transfer_amount'] : "-"; 
                                            $transfer_status = isset($row['transfer_status']) ? $row['transfer_status'] : "-";
                                            if ($transfer_status == 'waiting'){
                                                $lbl_status = 'ตรวจสอบการโอนเงิน';
                                                $btn_color = 'btn-danger';
                                            } else if ($transfer_status == 'complate'){
                                                $lbl_status = 'โอนเงินแล้ว';
                                                $btn_color = 'btn-success';
                                            } else if ($transfer_status == 'not_transfer'){
                                                $lbl_status = 'ยังไม่โอนเงิน';
                                                $btn_color = 'btn-warning';
                                            } else {
                                                $lbl_status = '-';
                                            }
                                            
                                            if ($lbl_status != '-'){
                                                $lbl_status = '<div class="mb-4">
                                                    <button class="btn '.$btn_color.' btn-sm btn_ShowModal_detail_status btn_lbl_status-'.$ID.'" data-orderID="'.$ID.'" data-transfer_status="'.$transfer_status.'" data-current_color="'.$btn_color.'" type="button" id="dropdownMenuButton">
                                                    '.$lbl_status.' <i class="fas fa-fw fa-cog"></i>
                                                    </button></div>';
                                            }
                                            
                                            echo '<tr>
                                                    <td>'.$no_row.'</td>
                                                    <td>'.$FirstName.'  '.$LastName.'</td> 
                                                    <td>'.$PhoneNo.'</td>
                                                    <td>'.$Address.'</td> 
                                                    <td>'.$lbl_status.'</td>
                                                    <td class="d-none td_bank-'.$ID.'">'.$bank_transfer.'</td>
                                                    <td class="d-none td_bank_no-'.$ID.'">'.$bank_transfer_no.'</td>
                                                    <td class="d-none td_tranfer_dt-'.$ID.'">'.$transfer_datetime.'</td>
                                                    <td class="d-none td_tranfer_amount-'.$ID.'">'.$transfer_amount.'</td> 
                                                </tr>';
                                            $no_row +=1;
                                        } 
                                    ?>

                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

     <!-- Detail Status Modal-->
    <div class="modal fade" id="detail_status_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการโอนเงิน</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td>ธนาคาร : </td><td class="md_bank"></td>
                            </tr>
                            <tr>
                                <td>เลขบัญชี : </td><td class="md_bank_no"></td>
                            </tr>
                            <tr>
                                <td>ยอดโอน : </td><td class="md_transfer_total"></td>
                            </tr>
                            <tr>
                                <td>วันเวลาที่โอน : </td><td class="md_transfer_dt"></td>
                            </tr>
                            <tr>
                                <td>สถานะยอดโอน : </td>
                                <td>
                                    <select class="form-control" name="md_transfer_status" id="md_transfer_status">
                                        <option class="please_transfer_status" value="" selected>เลือกสถานะ</option>
                                        <option value="complate">โอนเงินแล้ว</option>
                                        <option value="not_transfer">ยังไม่โอนเงิน</option>  
                                    </select>
                                </td>
                            </tr>
                            <tr class="container-ems_no" style="display:none;">
                                <td>EMS No : </td>
                                <td>
                                    <input type="text" class="form-control ems_no" id="ems_no" name="ems_no" placeholder="" >
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" id="accept_line_notify" name="accept_line_notify" value="yes"> แจ้งเตือน Line หาลูกค้า<br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control hid_orderID" id="hid_orderID" name="hid_orderID" >
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-primary" id="confirm_transfer_status" href="#">ยืนยัน</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../plugins/sb-admin-2/vendor/jquery/jquery.min.js"></script>
    <script src="../plugins/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../plugins/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../plugins/sb-admin-2/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="../plugins/sb-admin-2/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="../plugins/sb-admin-2/js/demo/datatables-demo.js"></script> -->


    <script type="text/javascript">
        jQuery(function() {
            
            jQuery(".btn_ShowModal_detail_status").on("click", function(e) {
                
                var orderID = $(this).attr('data-orderID');
                var transfer_status = $(this).attr('data-transfer_status'); 
                var bank_name = $('.td_bank-'+orderID).html();
                var bank_no = $('.td_bank_no-'+orderID).html();
                var tranfer_dt = $('.td_tranfer_dt-'+orderID).html();
                var tranfer_amount = $('.td_tranfer_amount-'+orderID).html();
 
                $('#hid_orderID').val(orderID);
                $('.md_bank').html(bank_name);
                $('.md_bank_no').html(bank_no);
                $('.md_transfer_total').html(tranfer_amount + ' บาท');
                $('.md_transfer_dt').html(tranfer_dt); 
                
                $('.container-ems_no').css("display", "none");
                if (transfer_status == 'complate'){ 
                    $('#md_transfer_status').val(transfer_status);
                    $('.container-ems_no').css("display", "table-row"); 

                } else if (transfer_status != 'waiting' && transfer_status != ''){
                    $('#md_transfer_status').val(transfer_status); 

                } else {
                    $('#md_transfer_status').val(''); 
                }
                
                jQuery('#detail_status_Modal').modal();
                $('#confirm_transfer_status').children('i').removeClass("fa fa-check"); 

            });

            jQuery("#md_transfer_status").on("change", function(e) { 

                var sel_transfer_status = $(this).val(); 
                if (sel_transfer_status == 'complate'){
                    $('.container-ems_no').css("display", "table-row"); 
                } else {
                    $('.container-ems_no').css("display", "none"); 
                }

            });

            jQuery("#confirm_transfer_status").on("click", function(e) {
                e.preventDefault();
                
                var $this = $(this);
                var orderID = $('#hid_orderID').val();
                var payment_status = $('#md_transfer_status').val(); 
                var ems_no = $('#ems_no').val();  
                var accept_line_notify = ''; 
                if ($('#accept_line_notify').is(":checked")) {
                    accept_line_notify = 'yes';
                }
               
                if ( confirm("คุณแน่ใจแล้ว ที่จะเปลียนสถานะการโอนเงิน?") ) { 

                    var lbl_status = '';
                    var btn_color = '';
                    var btn_color = '';
                    var current_color = $('.btn_lbl_status-'+orderID).attr('data-current_color');
                    
                    if (payment_status == 'waiting'){
                        lbl_status = 'ตรวจสอบการโอนเงิน';
                        btn_color = 'btn-danger';
                    } else if (payment_status == 'complate'){
                        lbl_status = 'โอนเงินแล้ว';
                        btn_color = 'btn-success';
                    } else if (payment_status == 'not_transfer'){
                        lbl_status = 'ยังไม่โอนเงิน';
                        btn_color = 'btn-warning';
                    }  

                    jQuery.ajax({
                        type: 'post',
                        url: '/line-liff-starter/controller/users_controller.php',
                        dataType: 'json',
                        data: {
                                'action': 'update_payment_status',
                                'payment_status': payment_status,
                                'ems_no': ems_no,
                                'orderID': orderID,
                                'accept_line_notify': accept_line_notify
                        },
                        beforeSend: function () {
                            $this.prepend('<i class="fa-left fa fa-spin fa-spinner"></i> ');
                        },
                        success: function (data) {
                        
                            if (data.success) {
                                $this.children('i').removeClass("fa fa-spin fa-spinner").addClass("fa fa-check"); 
                                jQuery('.btn_lbl_status-'+orderID).html(lbl_status);
                                jQuery('.btn_lbl_status-'+orderID).removeClass(current_color).addClass(btn_color);    
                            }
                        },
                        error: function (xhr, status, error) {
                            // var err = eval("(" + xhr.responseText + ")");
                            // console.log(err.Message);
                        } 
                    });
                }

            });

        });     
    </script> 

</body>

</html>