<?php 
require "config.php";
header("Access-Control-Allow-Origin: *");
header('application\json');

$subjects = $_POST['subjects'];
$sched = $_POST['sched'];
$id = $_POST['id'];
$values="";
for($i=0;$i<=count($subjects)-1;$i++){
$sql="Select * from enlistment where SUBJECT_CODE='".$subjects[$i]."' and student_ID='".$id."'";
if(mysqli_num_rows(mysqli_query($conn,$sql))){}else{	
	$values=$values."('".$subjects[$i]."','".$id."','".$sched."'),";	
	
}
}
$sql ="Insert into enlistment(SUBJECT_CODE,STUDENT_ID,PREF_DATE)values".rtrim($values, ",");
mysqli_query($conn,$sql);
$x = array('MSG'=>'Thank you for enlisting');
echo json_encode($x);
?>