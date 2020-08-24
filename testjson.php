<?php include('config.php');?>
<?php
$item_id= $_GET['item_id']; 
//connect with database demo
 
//select all data from json table
$query="select * from items WHERE item_id=$item_id";
$result=$db->query($query);
 
//fetech all data from json table in associative array format and store in $result variable
$array=$result->fetch_assoc();
 
$json=json_encode($array,true);

var_dump($json);
 
//create file if not exists
$fo=fopen("myjson.json","w");
 
$fr=fwrite($fo,$json);
 
?>
