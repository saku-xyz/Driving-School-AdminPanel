<?php
session_start();
$db=mysqli_connect('localhost','root','','learners');
$errors= array();
$fullname="";
$pass="";

//$con=mysqli_connect($servername, $username, $password1, $db) or die("connection failed");
//$mysqli=new mysqli($servername, $username, $password1, $db);
//log user in from login page
if (isset($_POST['login']))
{
    $username= ($_POST['username']);
    $pass1= ($_POST['password']);
    
if(empty($username))
{
	array_push($errors, "Username is required");
}

if(empty($pass1))
{
	array_push($errors, "Password is required");
}
if (count($errors)==0){
	$password1= md5($pass1);//encript password before comparing with that from data base
	$query="SELECT * FROM users WHERE user_name='$username' AND password='$password1'";
	$result = mysqli_query($db, $query);

	if(mysqli_num_rows($result)==1){
		$row = mysqli_fetch_assoc($result);
		$user_id = $row['user_id'];
		$username = $row['name'];
		$_SESSION["user_id"] = $user_id;

		header("Location: home.php");		    
		}else{
            // array_push($errors,"wrong username/password");
            echo '<script type="text/javascript">
            window.onload = function () { alert("Username or password incorrect..!!"); }
            </script>';
		}   
}
}

// insert details to website table
if (isset($_POST['addweb']))
{
$webname= ($_POST['web_name']);
$url= ($_POST['url']);

//fields empty
if(empty($webname))
{
array_push($errors,"Please enter website name!");
}
if(empty($url))
{
array_push($errors,"Please enter URL!");
}

//no errors
if(count($errors) == 0)
{
$sql="INSERT INTO websites (web_name,url) VALUES ('$webname','$url')";
mysqli_query($db, $sql);

header('location:website.php');
}
}

//Update Website Table
if(isset($_POST['update_user'])){
	$web_id= ($_REQUEST['web_id']);
	$web_qry = "SELECT * FROM websites where web_id=$web_id"; 
	$result = mysqli_query($db, $web_qry);
	while($row = $result->fetch_assoc()) {    
	$web_name = $row['web_name'];
	$url = $row['url'];
	}	
	$web_update_qry = "UPDATE websites
	SET web_name= $web_name, url=$url
	WHERE web_id=$web_id";
}

//Delete Websites
if (isset($_GET['web_delete']))
{
$webid = ($_GET['web_id']);
$web_delete_qry="DELETE FROM websites WHERE web_id = $webid;";
mysqli_query($db, $web_delete_qry);

header("Location: website.php");
}

// insert details to users table
if (isset($_POST['addcustomer']))
{
$indexno= ($_POST['indexno']);
$name= ($_POST['name']);
$nic= ($_POST['nic']);
$barcode= ($_POST['barcode']);
$dob = ($_POST['dob']);
$telephone = ($_POST['telephone']);
$address = ($_POST['address']);
$vehicle_class = ($_POST['vehicle_class']);
$training_type = ($_POST['training_type']);
$licence_no = ($_POST['licence_no']);
$vehicle_class2 = ($_POST['vehicle_class2']);
$issued_date = ($_POST['issued_date']);
$medical_no = ($_POST['medical_no']);
$medi_issued_date = ($_POST['medi_issued_date']);

//fields empty
if(empty($indexno))
{
array_push($errors,"Please enter IndexNo!");
}
if(empty($name))
{
array_push($errors,"Please enter name!");
}

//no errors
if(count($errors) == 0)
{
$sql="INSERT INTO customer (cus_index,name,nic,barcode,dob,address,telephone,vehicle_no,training_type,license_no,vehicle_class,lic_issued_date,medical_no,med_issued_date,special_notes) VALUES ('$indexno','$name','$nic','$barcode','$dob','$address','$telephone','$vehicle_class','$training_type','$licence_no','$vehicle_class2','$issued_date','$medical_no','$medi_issued_date','test')";
mysqli_query($db, $sql);

header('location:user_account.php');
}
}

// User table update query 
if(isset($_POST['user_update'])){
	$user_id = $GET['user_id'];
    $username = $row['name'];   
	$email = $row['user_name'];
	$userpw = $row['password'];
	
	$usr_update_qry = "UPDATE users
	SET name= $username, user_name=$email,password=$userpw
	WHERE user_id=$user_id";
}

//Delete Users
if (isset($_GET['user_delete']))
{
$userid = ($_GET['user_id']);
$user_delete_qry="DELETE FROM users WHERE user_id = $userid;";
mysqli_query($db, $user_delete_qry);

header("Location: user_account.php");
}

// Add Slots to DB
if (isset($_POST['add_slot']))
{
// $web_id = ($_REQUEST['web_id']);
$slot_type= ($_POST['slot_type']);
$slot_name = $_POST['slot_name'];
$web = $_POST['web'];

//fields empty
if(empty($slot_type))
{
array_push($errors,"Please enter slot type!");
}
if(empty($slot_name))
{
array_push($errors,"Please enter slot name!");
}

//no errors
if(count($errors) == 0)
{
$slot_add_qry="INSERT INTO slots (slot_name,slot_type,web_id) VALUES ('$slot_name','$slot_type', '$web')";
mysqli_query($db, $slot_add_qry);

header("Location: slot_manage.php");
}
}

//Delete Slots
if (isset($_GET['slot_delete']))
{
$slot_id = ($_GET['slot_id']);
$web_id = ($_GET['web_id']);
$slot_delete_qry="DELETE FROM slots WHERE slot_id=$slot_id;";
mysqli_query($db, $slot_delete_qry);

header("Location: slot_manage.php");
}

//Delete User_Slots
if (isset($_GET['userslot_delete']))
{
$user_id = ($_GET['user_id']);
$slot_id = ($_GET['slot_id']);
$usr_slot_delete="DELETE FROM user_slots WHERE user_id=$user_id AND slot_id=$slot_id;";
mysqli_query($db, $usr_slot_delete);

header("Location: user_slot.php");
}

//Delete Customers
if (isset($_GET['customer_delete']))
{
$cus_id = ($_GET['cus_id']);
$cus_delete="DELETE FROM customer WHERE cus_id=$cus_id;";
mysqli_query($db, $cus_delete);

header("Location: user_account.php");
}

//logout
if(isset($_GET['logout'])){
session_destroy();
header('location:index.php');
}
?>