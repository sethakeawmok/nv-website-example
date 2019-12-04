<?php

require_once('../config/config_th.php');
require_once('../config/connect.php');
require_once('../class/class_main.php');
$cls = new Main($pdo);

//จัดการข้อมูลสินค้า
if(@$_POST && @$_POST['save_products']=='save'){
   
  $datenow=date("ymdHis");
  echo $img_upload=@$_FILES['pd_picture']['tmp_name'];
  //die();
  $picname=@$_FILES['pd_picture']['name'];  
  $arraypic=explode(".",$picname);
  $count=count($arraypic)-1;
  $filetype=strtolower($arraypic[$count]);
  $newpicname=$datenow.".".$filetype; 
    if($filetype=="jpg" || $filetype=="jpeg"  || $filetype=="png" || $filetype=="gif")
    {
      copy($img_upload,"../assets/img/product/".$newpicname);
      unlink($img_upload);      
    }
    else
    {
      $newpicname="nopicture.png";
    }
   
	$val = array();
    $val['pd_id'] = $_POST['pd_id'];
    $val['pd_name'] = $_POST['pd_name'];
    $val['pd_brand'] = $_POST['pd_brand'];
    $val['pd_cost'] = $_POST['pd_cost'];
    $val['pd_price'] = $_POST['pd_price'];
    $val['pd_stock'] = $_POST['pd_stock'];   
    $val['pd_discustomer'] = $_POST['pd_discustomer']; 
    $val['update_date'] = date('Y-m-d H:i:s'); 
    $val['pd_picture'] = $newpicname;  
    $val['pd_status'] = 1;  
    $insert = $cls->InsertSQLTabel('t_products',$val);
    header('location:'.path_root.'admins/?uri=products');    
}elseif(@$_POST && @$_POST['save_products']=='edit'){
    $datenow=date("ymdHis");
    $img_upload=$_FILES['pd_picture']['tmp_name'];
    $picname=$_FILES['pd_picture']['name'];  
    $editpic=$_POST['picture'];
    
    if($picname!="" and $editpic!="nopicture.png")
    {
        unlink("../assets/img/product/".$_GET['edit_pic']);
    }
    $arraypic=explode(".",$picname);
    $count=count($arraypic)-1;
    $filetype=strtolower($arraypic[$count]);
    
    if($filetype=="jpg" || $filetype=="jpeg" || $filetype=="png" || $filetype=="gif")
    {
            $newpicname=$datenow.".".$filetype;
            copy($img_upload,"../assets/img/product/".$newpicname);
            unlink($img_upload);            
    }
    else
    {
        $newpicname=$editpic;
    }

    $val = array();
    $val['pd_name'] = $_POST['pd_name'];
    $val['pd_brand'] = $_POST['pd_brand'];
    $val['pd_cost'] = $_POST['pd_cost'];
    $val['pd_price'] = ($_POST['pd_price']);
    $val['pd_stock'] = $_POST['pd_stock'];
    $val['pd_discustomer'] = $_POST['pd_discustomer'];
    $val['pd_picture'] = $newpicname;
    $update = $cls->UpdateSQL('t_products',$val,"pd_id='".$_POST['pd_id']."'");
    header('location:'.path_root.'admins/?uri=products');   
}elseif(@$_GET['del']){
    $val = array();
    //$val['update_date'] = date('Y-m-d H:i:s');
    $val['pd_status'] = 0; 
    $update = $cls->UpdateSQL('t_products',$val,"pd_id='".$_GET['del']."'");
    header('location:'.path_root.'admins/?uri=products'); 
}
//จัดการข้อมูลยี่ห้อสินค้า
elseif(@$_POST && @$_POST['save_brand']=='save'){
    $datenow=date("ymdHis");
    echo $img_upload=@$_FILES['img_brand']['tmp_name'];
    //die();
    $picname=@$_FILES['img_brand']['name'];  
    $arraypic=explode(".",$picname);
    $count=count($arraypic)-1;
    $filetype=strtolower($arraypic[$count]);
    $newpicname=$datenow.".".$filetype; 
    if($filetype=="jpg" || $filetype=="jpeg"  || $filetype=="png" || $filetype=="gif")
    {
      copy($img_upload,"../assets/img/brands/".$newpicname);
      unlink($img_upload);      
    }
    else
    {
      $newpicname="nopicture.png";
    }

    $val = array();
    $val['pd_brand'] = $_POST['pd_brand'];
    $val['brand_img'] = $newpicname;
    $val['brand_status'] = 1; 

    $insert = $cls->InsertSQLTabel('t_brand',$val);
    header('location:'.path_root.'admins/?uri=brand');   
}elseif(@$_POST && @$_POST['save_brand']=='edit'){
    $datenow=date("ymdHis");
    $img_upload=$_FILES['img_brand']['tmp_name'];
    $picname=$_FILES['img_brand']['name'];  
    $editpic=$_POST['img'];
    
    if($picname!="" and $editpic!="nopicture.png")
    {
        unlink("../assets/img/brands/".$_GET['edit_pic']);
    }
    $arraypic=explode(".",$picname);
    $count=count($arraypic)-1;
    $filetype=strtolower($arraypic[$count]);
    
    if($filetype=="jpg" || $filetype=="jpeg" || $filetype=="png" || $filetype=="gif")
    {
            $newpicname=$datenow.".".$filetype;
            copy($img_upload,"../assets/img/brands/".$newpicname);
            unlink($img_upload);            
    }
    else
    {
        $newpicname=$editpic;
    }

    $val = array();
    $val['pd_brand'] = $_POST['pd_brand'];
    $val['brand_img'] = $newpicname;
     
    $update = $cls->UpdateSQL('t_brand',$val,"brand_id='".$_POST['brand_id']."'");
    header('location:'.path_root.'admins/?uri=brand');     
}elseif(@$_GET['brand_del']){
    $val = array();
    //$val['update_date'] = date('Y-m-d H:i:s');
    $val['brand_status'] = 0; 
    $update = $cls->UpdateSQL('t_brand',$val,"brand_id='".$_GET['brand_del']."'");
    header('location:'.path_root.'admins/?uri=brand');    
}
//จัดการข้อมูลสมาชิก
elseif(@$_POST && @$_POST['mem_edit']=='edit'){

    $val = array();
    $val['mem_fname'] = $_POST['mem_fname'];
    $val['mem_lname'] = $_POST['mem_lname'];
    $val['mem_nname'] = $_POST['mem_nname'];
    $val['mem_email'] = $_POST['mem_email'];
    $val['mem_password'] = md5($_POST['mem_password']);
    $val['mem_tel'] = $_POST['mem_tel'];
   
    $update = $cls->UpdateSQL('t_member',$val,"mem_id='".$_POST['mem_id']."'");
    header('location:'.path_root.'admins/?uri=member');     
}elseif(@$_GET['mem_del']){
    $val = array();
    $val['mem_status'] = 0; 
    $update = $cls->UpdateSQL('t_member',$val,"mem_id='".$_GET['mem_del']."'");
    header('location:'.path_root.'admins/?uri=member');    
}

//Login
elseif(@$_POST &&@$_POST['login']=='login') {   
    $user =mysql_real_escape_string($_POST['user']);
    $pass = mysql_real_escape_string($_POST['pass']);
    $data = $cls->getData('t_admins',"ad_status=1 AND ad_user='".$user."' AND ad_password='".md5($pass)."'","");

    foreach($data as $row)
    @session_start();
    if (empty($row)){       
        header('location:'.path_root.'admins/?uri=login&chk=no'); 
    }else{
         $_SESSION['admin']=$row['ad_user'];
         $_SESSION['chk_text']=$row['ad_user'];
         header('location:'.path_root.'admins/?uri=products');       
    }  
}
//ผู้มาติดต่อ
elseif(@$_GET['con_del']){
    $val = array();
    $val['con_status'] = 0; 
    $update = $cls->UpdateSQL('t_contactus',$val,'con_id='.$_GET['con_del']);
    header('location:'.path_root.'admins/?uri=contactus');    
}
//admins
elseif(@$_POST && @$_POST['save_admins']=='save'){
    $val = array();
    $val['ad_fname'] = $_POST['ad_fname'];
    $val['ad_lname'] = $_POST['ad_lname'];
    $val['ad_user'] = $_POST['ad_user'];
    $val['ad_password'] = md5($_POST['ad_password']);
    $val['ad_tel'] = $_POST['ad_tel'];
    $val['ad_status'] = 1; 
    $insert = $cls->InsertSQLTabel('t_admins',$val);
    header('location:'.path_root.'admins/?uri=admins'); 

}elseif(@$_POST && @$_POST['save_admins']=='edit'){
    $val = array();
    $val['ad_fname'] = $_POST['ad_fname'];
    $val['ad_lname'] = $_POST['ad_lname'];
    $val['ad_user'] = $_POST['ad_user'];
    $val['ad_password'] = md5($_POST['ad_password']);
    $val['ad_tel'] = $_POST['ad_tel'];  
    $update = $cls->UpdateSQL('t_admins',$val,'ad_id='.$_POST['ad_id']);
    header('location:'.path_root.'admins/?uri=admins');  

}elseif(@$_GET['ad_del']){
    $val = array();
    $val['ad_status'] = 0; 
    $update = $cls->UpdateSQL('t_admins',$val,"ad_id='".$_GET['ad_del']."'");
    header('location:'.path_root.'admins/?uri=admins');    
}




elseif(@$_POST && @$_POST['edit_status']=='edit'){
    $val = array();
    $val['order_status'] = $_POST['chk_status'];
     
    $update = $cls->UpdateSQL('t_orders',$val,'order_id='.$_POST['order_id']);
    header('location:'.path_root.'admins/?uri=orders');     
}
?>



