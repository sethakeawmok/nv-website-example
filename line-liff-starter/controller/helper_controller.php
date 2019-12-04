<?php

require_once('../config/config_th.php');
require_once('../config/connect.php');
require_once('../class/class_main.php'); 
$cls = new Main($pdo);

if(@$_POST && @$_POST['action']=='sel_province'){ 

    $province_val = $_POST['province_val'];
    $data = $cls->getData('amphur','PROVINCE_ID='."'".$province_val."'",'AMPHUR_NAME ASC');  
    
    foreach($data as $row){
        $AMPHUR_ID = isset($row['AMPHUR_ID']) ? $row['AMPHUR_ID'] : "";
        $AMPHUR_NAME = isset($row['AMPHUR_NAME']) ? $row['AMPHUR_NAME'] : "";
        $POSTCODE = isset($row['POSTCODE']) ? $row['POSTCODE'] : "";
        
        $ajax_response[] = array( 'AMPHUR_ID' => $AMPHUR_ID, 'AMPHUR_NAME' => $AMPHUR_NAME, 'POSTCODE' => $POSTCODE );
    }   
    echo json_encode( $ajax_response );

} else if(@$_POST && @$_POST['action']=='sel_amphur'){ 

    $province_id = $_POST['province_id'];
    $amphur_id = $_POST['amphur_id'];
    $data = $cls->getData('district',"PROVINCE_ID=".$province_id." AND AMPHUR_ID=".$amphur_id ,'DISTRICT_NAME ASC');  
    
    foreach($data as $row){
        $DISTRICT_ID = isset($row['DISTRICT_ID']) ? $row['DISTRICT_ID'] : "";
        $DISTRICT_NAME = isset($row['DISTRICT_NAME']) ? $row['DISTRICT_NAME'] : ""; 
        
        $ajax_response[] = array( 'DISTRICT_ID' => $DISTRICT_ID, 'DISTRICT_NAME' => $DISTRICT_NAME );
    }   
    echo json_encode( $ajax_response );

} 

?>



