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
    	$userid = $_POST['useroption'];
    	$slotid = $_POST['slotoption'];
    	// $role = $_POST['role'];
    	$mysqli->query("UPDATE `user_slots` SET `user_id` = '$userid', `slot_id` = '$slotid' WHERE `web_id`=$id");
    	header("location:user_slot.php");
    }
    
$result = $mysqli->query("SELECT DISTINCT users.user_id, users.user_name , slots.slot_id, slots.slot_name, slots.slot_type
FROM users, slots GROUP BY slots.slot_id");
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
    <form method="post" action="edit_userslot.php" role="form">
        <div class="modal-body">
            <div class="form-group">
                <label for="id">User Name</label>
                <select name="useroption" class="form-control">
                    <?php 
                    while($row = $result->fetch_assoc()) {
                    $userid =$row['user_id']; ?>
                    <option value="<?php echo $userid ?>"><?php echo $row['user_id'] ?> - <?php echo $row['user_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Slot ID</label>
                <select name="slotoption" class="form-control">
                <?php 
                    foreach ($result as $rows) {
                    $slotid =$rows['slot_id']; ?>
                    <option value="<?php echo $slotid ?>"><?php echo $rows['slot_id'] ?> - <?php echo $rows['slot_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="submit" value="Update" />&nbsp;
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
</body>
</html>