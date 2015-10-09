<?php 
require "config.php";
header('Allow-Control-Access-Origin:*');
header('Content-Type: application/json');
$id=$_POST['id'];
$year=$_POST['year'];
$sem=$_POST['sem']; 
$course = $_POST['course'];
$curr = $_POST['curr'];
//get subjects with grades by student
/*
$sql = "Select * from qrystats where  year='".$year."' and semester='".$sem."' and student_ID='".$id."' order by year ASC";
$res = mysqli_query($conn,$sql);
$subs_taken = array();
$ctr=0;
$json = array();
$taken =array();
while($data=mysqli_fetch_array($res)){
//$subs_taken[]=array('TITLE'=>$data['TITLE']);
$taken[]=array('TITLE'=>$data['SUBJECT_TITLE']);
$ctr++;
}

//get subject per year and sem
$sql = "Select distinct(SUBJECT_TITLE) from prospectus where  year='".$year."' and semester='".$sem."' and course ='".$course."' and curriculum ='".$curr."'order  by year ASC	";
$res = mysqli_query($conn,$sql);
echo $sql;
$subjects = array();
$ctr=0;
while($data=mysqli_fetch_array($res)){
$subjects[]=array('TITLE'=>$data['SUBJECT_TITLE']);
$ctr++;
}*/
$sql ="Select distinct(SUBJECT_CODE), TITLE from qry where student_ID='".$id."' and year='".$year."' and semester ='".$sem."' and course ='".$course."' and curriculum='".$curr."'";
$res = mysqli_query($conn,$sql);
$taken=array();
$taken_x=mysqli_num_rows($res);
while($data=mysqli_fetch_array($res)){
$taken[]=array('CODE'=>$data[0],'TITLE'=>$data[1]);	
}
//get subjects in that year and sem
$sql ="Select * from prospectus where  year='".$year."' and semester ='".$sem."' and course ='".$course."' and curriculum='".$curr."'";
$subjects =array();
$res = mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res)){
$subjects[]=array('CODE'=>$data[3],'TITLE'=>$data[4]);	
}
$subject_x=mysqli_num_rows($res);
//index 0 to N ng subjects
$percent = ($taken_x)/($subject_x)*100;
$json[]= array('PERCENTAGE'=>$percent,'TAKEN'=>$taken,'NOT'=>(array_values(array_diff_key($subjects,$taken))));
;
echo json_encode($json);
?>
