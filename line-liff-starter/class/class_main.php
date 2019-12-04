<?php
class Main{
	function __construct($pdo){
		$this->pdo = $pdo;
	}
	function getData($table,$where,$order){
		$order_by = ($order!=''?' ORDER BY '.$order:'');
		$where = ($where!=''?' WHERE '.$where.$order_by:$order_by);
		$query = $this->pdo->prepare('SELECT * FROM '.$table.$where);
		// echo 'SELECT * FROM '.$table.$where;
		// die();
		$query ->execute();
		return $query->fetchAll();
	}

	function getData_join($field,$table,$where,$order){
		$field_show = ($field!=''?$field:'*');
		//echo $field_show;
		$order_by = ($order!=''?' ORDER BY '.$order:'');
		$where = ($where!=''?' WHERE '.$where.$order_by:$order_by);
		$query = $this->pdo->prepare('SELECT '.$field_show.' FROM '.$table.$where);
		//echo 'SELECT '.$field_show.' FROM '.$table.$where;
		//die();
		$query ->execute();
		return $query->fetchAll();
	}

	function getData_custom_qry($qry){
		$query = $this->pdo->prepare($qry);
		$query ->execute();
		return $query->fetchAll();
	}

	function InsertSQLTabel($table,$value_array){
		$fieldTB='';
		$valueTB='';
		if(gettype($value_array)=="array"){
			$i="";
			foreach ($value_array as $key => $value) {
				$fieldTB .=$i.$key;
				$valueTB .=$i."'".$value."'";
				$i=",";
			}
			$query = $this->pdo->prepare("INSERT INTO ".$table."(".$fieldTB.") VALUES(".$valueTB.")");
			//echo 'INSERT INTO '.$table."(".$fieldTB.") VALUES(".$valueTB.")";
			//die();
			$query ->execute();
		}
		return 'success!!';
	}

	function UpdateSQL($table,$value_array,$where){
		$fieldTB='';
		if(gettype($value_array)=="array"){
			$i="";
			foreach ($value_array as $key => $value) {
				$fieldTB .=$i.$key."= '".$value."'";
				$i=",";
			}
			$query = $this->pdo->prepare("UPDATE ".$table." SET ".$fieldTB." WHERE ".$where."");
			//echo "UPDATE ".$table." SET ".$fieldTB." WHERE ".$where."";
			//die();
			$query ->execute();
		}
		return 'success!!';
	}

	function thai_datetime($data){

	$year=substr($data,0,4);
	$month=substr($data,5,2); 
	$day=substr($data,8,2);
	$time=substr($data,10);
	$thai_month_arr=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");    
	$datetime_thai = intval($day) ." ".$thai_month_arr[intval($month)]." ".($year+543)." ".$time; 
		
	$datetime_thai=ereg_replace("0","๐",$datetime_thai);
	$datetime_thai=ereg_replace("1","๑",$datetime_thai);	
	$datetime_thai=ereg_replace("2","๒",$datetime_thai);
	$datetime_thai=ereg_replace("3","๓",$datetime_thai);	
	$datetime_thai=ereg_replace("4","๔",$datetime_thai);
	$datetime_thai=ereg_replace("5","๕",$datetime_thai);	
	$datetime_thai=ereg_replace("6","๖",$datetime_thai);
	$datetime_thai=ereg_replace("7","๗",$datetime_thai);
	$datetime_thai=ereg_replace("8","๘",$datetime_thai);
	$datetime_thai=ereg_replace("9","๙",$datetime_thai);
	
	echo $datetime_thai; 
	} 

	function thai_dateEng($data){

	$year=substr($data,0,4);
	$month=substr($data,5,2); 
	$day=substr($data,8,2);
	$time=substr($data,10);
	$thai_month_arr=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");    
	$datetime_thai = intval($day) ." ".$thai_month_arr[intval($month)]." ".($year+543)." ".$time; 
		
	$datetime_thai=ereg_replace("0","0",$datetime_thai);
	$datetime_thai=ereg_replace("1","1",$datetime_thai);	
	$datetime_thai=ereg_replace("2","2",$datetime_thai);
	$datetime_thai=ereg_replace("3","3",$datetime_thai);	
	$datetime_thai=ereg_replace("4","4",$datetime_thai);
	$datetime_thai=ereg_replace("5","5",$datetime_thai);	
	$datetime_thai=ereg_replace("6","6",$datetime_thai);
	$datetime_thai=ereg_replace("7","7",$datetime_thai);
	$datetime_thai=ereg_replace("8","8",$datetime_thai);
	$datetime_thai=ereg_replace("9","9",$datetime_thai);
	
	echo $datetime_thai; 
	}     

				
	function __destruct() {
		//print "Destructor Called";
	}

}

?>