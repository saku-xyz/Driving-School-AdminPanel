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
    	$webname = $_POST['name'];
    	$url = $_POST['url'];
    	$mysqli->query("UPDATE `websites` SET `web_name` = '$webname', `url` = '$url' WHERE `web_id`=$id");
    	header("location:website.php");
	}

    $result = $mysqli->query("SELECT * FROM `websites` WHERE `web_id`='$id'");
    $row = mysqli_fetch_assoc($result);
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
    <form method="post" action="editwebsite.php" role="form">
        <div class="modal-body">
            <div class="form-group">
                <label for="id">Web ID</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $row['web_id'];?>"
                    readonly="true" />

            </div>
            <div class="form-group">
                <label for="name">Web Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['web_name'];?>" />
            </div>
            <div class="form-group">
                <label for="phone">Url</label>
                <input type="text" class="form-control" id="email" name="url"
                    value="<?php echo $row['url'];?>" />
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="submit" value="Update" />&nbsp;
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
</body>

</html>