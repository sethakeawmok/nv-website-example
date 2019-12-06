<?php

require_once('../config/config_th.php');
require_once('../config/connect.php');
require_once('../class/class_main.php'); 
$cls = new Main($pdo);

if(@$_POST && @$_POST['submit_form']=='add_product'){ 

    $pd_no = $_POST['pd_no'];
    $pd_name_th = $_POST['pd_name_th'];
    $pd_name_en = $_POST['pd_name_en'];
    $pd_price = $_POST['pd_price'];
    
    $val = array();
    $val['pd_no'] = $pd_no;
    $val['pd_name_th'] = $pd_name_th;
    $val['pd_name_en'] = $pd_name_en; 
    $val['pd_price'] = $pd_price; 
    $val['del_flag'] = 'N'; 

    $insert = $cls->InsertSQLTabel('kb_products',$val);
    header('location:'.path_root.'views/dashboard/products.php'); 

} else if(@$_POST && @$_POST['submit_form']=='update_product'){ 

    $pd_ID = $_POST['hid_pdID'];
    $pd_no = $_POST['pd_no'];
    $pd_name_th = $_POST['pd_name_th'];
    $pd_name_en = $_POST['pd_name_en'];
    $pd_price = $_POST['pd_price'];
    
    $val = array();
    $val['pd_no'] = $pd_no;
    $val['pd_name_th'] = $pd_name_th;
    $val['pd_name_en'] = $pd_name_en; 
    $val['pd_price'] = $pd_price; 

    $update = $cls->UpdateSQL('kb_products',$val,'ID= '.$pd_ID);
    header('location:'.path_root.'views/dashboard/products.php'); 

} else if(@$_POST && @$_POST['action']=='delete_product'){ 

    $pd_ID = $_POST['pdID'];
    
    $val = array();
    $val['del_flag'] = 'Y'; 

    $update = $cls->UpdateSQL('kb_products',$val,'ID= '.$pd_ID);
    
    $ajax_response = array( 'success' => true );
    echo json_encode( $ajax_response ); 

}

?>



