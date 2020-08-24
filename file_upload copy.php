<?php 
include_once("config.php");
session_start();
if(!empty($_FILES)){
    $slot_id = $_GET['slot_id'];  

    $upload_dir = "uploads/";
    $fileName = $_FILES['file']['name'];
    $uploaded_file = $upload_dir.$fileName; 

    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){
        //insert file information into db table
		$mysql_insert = "INSERT INTO items (content, upload_time, slot_id)VALUES('".$fileName."','".date("Y-m-d H:i:s")."', '".$slot_id."')";
		mysqli_query($db, $mysql_insert) or die("database error:". mysqli_error($db));
    }   
}
