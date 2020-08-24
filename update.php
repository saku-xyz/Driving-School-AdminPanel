<?php
//update.php
$connect = mysqli_connect("localhost", "root", "", "content_management");
//$page_id = $_POST["page_id_array"];
for($i=0; $i<count($_POST["page_id_array"]); $i++)
{
 $query = "
 UPDATE items 
 SET order_num = '".$i."' 
 WHERE item_id = '".$_POST["page_id_array"][$i]."'";
 mysqli_query($connect, $query);
}
?>
