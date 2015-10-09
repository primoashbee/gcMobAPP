<?php 
require "config.php";
header('application\json');

$sql="Select distinct(NAME) from prospectus";
$res= mysqli_query($conn,$sql);
$name=array();

while($data=mysqli_fetch_array($res)){
$name[]=array('NAME'=>$data['NAME']);
	
}
$json[0] = array('LISTS'=>$name);
echo json_encode($json[0]);

?>