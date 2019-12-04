<?php

require_once('../config/config_th.php');
require_once('../config/connect.php');
require_once('../class/class_main.php');
require_once('../class/fn_line_notify.php');
$cls = new Main($pdo);

if(@$_POST && @$_POST['submit_form']=='send'){ 

    $line_userID = $_POST['hid_line_userID'];
    $line_displayName = $_POST['hid_line_displayName'];
    $province = $_POST['sel_province']; 
    $amphur = $_POST['sel_amphur'];
    $district = $_POST['sel_district'];
    $postcode = $_POST['postcode'];

    $data = $cls->getData('kb_user_line_bot','Line_userID='."'".$line_userID."'",'ID DESC');  
    $count_query = sizeof($data);

    if ($count_query == 0){

        $val = array();
        $val['Line_userID'] = $line_userID;
        $val['Line_displayName'] = $line_displayName;
        $insert = $cls->InsertSQLTabel('kb_user_line_bot',$val);

        $data = $cls->getData('kb_user_line_bot','Line_userID='."'".$line_userID."'",'');  
        
        foreach($data as $row);
        $val = array();
        $sys_ID = $row['ID'];
        $val['user_line_bot_ID'] = $row['ID'];
        $val['FirstName'] = $_POST['FirstName'];
        $val['LastName'] = $_POST['LastName']; 
        $val['PhoneNo'] = $_POST['PhoneNo'];
        $val['Address'] = $_POST['Address'];
        $val['province_id'] = $province;
        $val['amphur_id'] = $amphur;
        $val['postcode'] = $postcode;
        $insert = $cls->InsertSQLTabel('kb_orders_log',$val);
        
    } else {

        foreach($data as $row);
        $sys_ID = $row['ID'];

        $val = array();
        $val['user_line_bot_ID'] = $row['ID'];
        $val['FirstName'] = $_POST['FirstName'];
        $val['LastName'] = $_POST['LastName']; 
        $val['PhoneNo'] = $_POST['PhoneNo'];
        $val['Address'] = $_POST['Address'];
        $val['province_id'] = $province;
        $val['amphur_id'] = $amphur;
        $val['district_id'] = $district;
        $val['postcode'] = $postcode;

        $insert = $cls->InsertSQLTabel('kb_orders_log',$val);

        $line_displayName = $row['Line_displayName'];

    }

    if ($insert == 'success!!'){
        echo "ขอบคุณสำหรับข้อมูล เจ้าหน้าที่จะแจ้งสรุปยอดสินค้า ให้ทราบอีกครั้งค่ะ";
    }

    $data = $cls->getData('kb_orders_log','','ID DESC LIMIT 1'); 
    foreach($data as $val);

    $txt_msg_notify = "ขอบคุณสำหรับข้อมูล เจ้าหน้าที่จะแจ้งสรุปยอดสินค้า ให้ทราบอีกครั้งค่ะ"; 
    notify_to_customer_text_msg($txt_msg_notify, $line_userID);

    $msg_noti_line_notify = "มีลูกค้าลงทะเบียนสั่งซื้อสินค้า ชื่อ: ".$line_displayName. "\n\n ลิงค์ยืนยัน https://analytics.2jds.com/line-liff-starter/confirm_order.php?order_id=".$val['ID']; 
    $res = line_notify_message($msg_noti_line_notify,ADMIN_LINE_NOTIFY_TOKEN_ID);
    
    // header('location:'.path_root.'?uri=webboard'); 

} elseif(@$_POST && @$_POST['submit_form'] == 'confrim_order'){

    $order_id = $_POST['hid_order_id'];

    $chk_product = $_POST['chk_product']; 
    if (sizeof($chk_product) != 0){
        $line_userID = '';
        $data = $cls->getData_custom_qry("SELECT t1.FirstName,t2.Line_userID,t2.Line_displayName FROM kb_orders_log t1 INNER JOIN kb_user_line_bot t2 ON t1.user_line_bot_ID = t2.ID where t1.ID =".$order_id);
        
        foreach($data as $val);
        $line_userID = $val['Line_userID'];
        $Line_displayName = $val['Line_displayName'];
        $FirstName = $val['FirstName'];

        $val = array();
        $val['del_flag'] = 'Y';
        $update = $cls->UpdateSQL('kb_order_confirm',$val,'order_id= '.$order_id);  


        foreach($chk_product as $pd_id) {
            
            $data = $cls->getData('kb_order_confirm',"order_id=$order_id AND pd_confirm_id=$pd_id",'ID DESC LIMIT 1'); 
            $pd_name_th =  $_POST['hid_pd_name_th-'.$pd_id];
            $product_count =  $_POST['product_count-'.$pd_id];
            $product_price = $_POST['product_price-'.$pd_id];

            if (sizeof($data) == 0){
                $val = array();
                $val['order_id'] = $order_id;
                $val['pd_confirm_id'] = $pd_id;
                $val['pd_confirm_count'] = $product_count; 
                $val['pd_confirm_price'] = $product_price;
                $val['del_flag'] = 'N';
        
                $insert = $cls->InsertSQLTabel('kb_order_confirm',$val);
            }else {
                
                foreach($data as $confirm_id);
                $confirm_id = $confirm_id['ID'];
                $val = array(); 
                $val['pd_confirm_count'] = $product_count; 
                $val['pd_confirm_price'] = $product_price; 
                $val['del_flag'] = 'N';

                $update = $cls->UpdateSQL('kb_order_confirm',$val,'ID= '.$confirm_id);
            }

            $pd_count_total += $product_count;
            $pd_count_price += $product_price;

            $msg_pd_detail_arr[] = array("pd_id" => $pd_id
                ,"pd_name_th" => $pd_name_th
                ,"pd_count" => $product_count
                ,"pd_price" => $product_price ); 
        }

        $msg_pd_total_arr[] = array("order_id" => $order_id
            ,"FirstName" => $FirstName
            ,"pd_total_count" => $pd_count_total
            ,"pd_total_price" => $pd_count_price );

        notify_to_customer($msg_pd_detail_arr, $msg_pd_total_arr, $line_userID);

        echo "ส่งข้อมูลยืนยันให้ลูกค้าแล้ว !!!";
    }

    // header('location:'.path_root.'?uri=view_webboard&wb_id='.$_POST['wbid_poster']);    
} elseif(@$_POST && @$_POST['action'] == 'update_payment_status'){

    $order_id = $_POST['orderID'];
    $bank_transfer_status =  $_POST['payment_status'];
    $ems_no =  $_POST['ems_no'];
    $accept_line_notify =  $_POST['accept_line_notify'];
    if ($bank_transfer_status != 'complate'){
        $ems_no = '';
    }

    $val = array();  
    $val['transfer_status'] = $bank_transfer_status;  
    //$val['ems_no'] = $ems_no;

    $update = $cls->UpdateSQL('kb_orders_log',$val,'ID= '.$order_id);
    
    if ($accept_line_notify == 'yes'){
        //$res = line_notify_message("55555",ADMIN_LINE_NOTIFY_TOKEN_ID);

        $line_userID = '';
        $data = $cls->getData_custom_qry("SELECT t1.FirstName,t2.Line_userID,t2.Line_displayName FROM kb_orders_log t1 INNER JOIN kb_user_line_bot t2 ON t1.user_line_bot_ID = t2.ID where t1.ID =".$order_id);
        
        foreach($data as $val);
        $line_userID = $val['Line_userID'];

        $msg_ems_no = '';
        if ( !empty($ems_no) ){
            $msg_ems_no = 'สามารถติดตามสินค้าได้จาก EMS No. : '.$ems_no;
        }

        $txt_msg_notify = "เจ้าหน้าที่ยืนยันการโอนเงินของคุณแล้ว ".$msg_ems_no; 
        notify_to_customer_text_msg($txt_msg_notify, $line_userID);
    }
    
    $ajax_response = array( 'success' => true );
    echo json_encode( $ajax_response );
    
} elseif(@$_POST && @$_POST['submit_form'] == 'confrim_payment'){

    $order_id = $_POST['hid_order_id'];
    $bank_transfer =  $_POST['bank_transfer'];
    $bank_transfer_no =  $_POST['bank_transfer_no'];
    
    $date_format = explode("/", $_POST['bank_transfer_date']); 
    $date_format = $date_format[2].'-'.$date_format[1].'-'.$date_format[0]; 
    $bank_transfer_dt = $date_format.' '.$_POST['bank_transfer_time'];
    $transfer_amount =  $_POST['transfer_amount'];
    
    $val = array();
    $val['bank_transfer'] = $bank_transfer;
    $val['bank_transfer_no'] = $bank_transfer_no;
    $val['transfer_datetime'] = $bank_transfer_dt;
    $val['transfer_amount'] = $transfer_amount;
    $val['transfer_status'] = 'waiting';
    $update = $cls->UpdateSQL('kb_orders_log',$val,'ID = '.$order_id);  

    $data = $cls->getData('kb_orders_log','ID='."'".$order_id."'",''); 
    foreach($data as $val);
    $FirstName = $val['FirstName'];
    $LastName = $val['LastName'];

    $msg_noti_line_notify = "มีลูกค้ายืนยันการโอนเงิน ชื่อ: ".$FirstName. " ".$LastName."
    ธนาคาร : ".$bank_transfer."
    เลขบัญชี :  ".$bank_transfer_no."
    จำนวน : ".number_format($transfer_amount)."
    วันเวลา : ".$bank_transfer_dt."\n\n ยืนยันสถาะได้ที่ https://analytics.2jds.com/line-liff-starter/overview.php"; 

    $res = line_notify_message($msg_noti_line_notify,ADMIN_LINE_NOTIFY_TOKEN_ID);

    $line_userID = '';
    $data = $cls->getData_custom_qry("SELECT t2.Line_userID FROM kb_orders_log t1 INNER JOIN kb_user_line_bot t2 ON t1.user_line_bot_ID = t2.ID where t1.ID =".$order_id);
    foreach($data as $val);
    $line_userID = $val['Line_userID']; 

    echo $txt_msg_notify = "ขอบคุณสำหรับข้อมูลรอเจ้าหน้าที่ตรวจสอบ การโอนเงินค่ะ"; 
    notify_to_customer_text_msg($txt_msg_notify, $line_userID);
    
    // header('location:'.path_root.'?uri=view_webboard&wb_id='.$_POST['wbid_poster']);    
}

?>



