<?php include('config.php');?>
<?php include('user.php');?>
<?php  
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<?php
    require('conn.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$name = $_POST['name'];
    	$phone = $_POST['phone'];
    	$address = $_POST['address'];
    	$email = $_POST['email'];
    	$mysqli->query("UPDATE `users` SET `name` = '$name', `phone` = '$phone', `address`='$address', `email`='$email' WHERE `sn`=$id");
    	header("location:user_account.php");
	}
	
	if (isset($_GET['user_delete']))
	{
	// $userid = ($_GET['user_id']);
	$user_delete_qry="DELETE FROM users WHERE user_id = $id;";
	mysqli_query($db, $user_delete_qry);
	
	header("Location: user_account.php");
	}

    $members = $mysqli->query("SELECT * FROM `users` WHERE `user_id`='$id'");
    $mem = mysqli_fetch_assoc($members);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<form method="post" action="editdata.php" role="form">
	<div class="modal-body">
		<div class="form-group">
			<label for="id">User ID</label>
			<input type="text" class="form-control" id="id" name="id" value="<?php echo $mem['user_id'];?>" readonly="true"/>

		</div>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo $mem['name'];?>" />
		</div>
		<div class="form-group">
			<label for="phone">Email</label>
				<input type="text" class="form-control" id="email" name="email" value="<?php echo $mem['user_name'];?>" />
		</div>
		<div class="form-group">
			<label for="address">User Role</label> 
			<select class="form-control" name="role">
				<option value="<?php echo $mem['role'];?>"><?php echo $mem['role'];?></option>
				<option value="user">user</option>
			</select>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>	
	</form>

</body>
</html>
