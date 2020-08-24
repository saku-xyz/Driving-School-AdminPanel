<?php
$conn = mysqli_connect('localhost','root','','content_management');

$query = "SELECT * FROM items";
$result = mysqli_query($conn,$query);

while ($row = mysqli_fetch_array($result)){
    
    echo " ".$row["item_type"]." ".$row["url"]." <br> ";
}

?>