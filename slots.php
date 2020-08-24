<?php include('config.php');?>
<?php include('user.php');
$user = $row['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<?php
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$web_id = $_GET['web_id'];
$query = "SELECT * FROM user_slots, users, slots where users.user_id = user_slots.user_id and user_slots.slot_id = slots.slot_id AND users.user_id = $user AND slots.web_id=$web_id group by slots.slot_id ORDER by slots.slot_id";
$result = mysqli_query($db, $query);

$query2 = "SELECT * from websites";
$result2 = mysqli_query($db,$query2);

$sql = "SELECT role FROM users WHERE user_id=$user_id";
$usr_result = mysqli_query($db, $sql); 
$rows = mysqli_fetch_assoc($usr_result);
$role = $row['role'];
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Panel</title>

    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/table.css" rel="stylesheet">

    <!-- testing 123 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f1f1f1;
    }

    .box {
        width: 800px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 25px;
    }

    #page_list li {
        padding: 16px;
        background-color: #f9f9f9;
        border: 1px dotted #ccc;
        cursor: move;
        margin-top: 12px;
    }

    #page_list li.ui-state-highlight {
        padding: 24px;
        background-color: #ffffcc;
        border: 1px dotted #ccc;
        cursor: move;
        margin-top: 12px;
    }
    </style>
</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="home.php">CMS</a>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <p class="mt-2" style="color:#fff;"> Logged as <?php echo $row['name']; ?></p>
                <li class="nav-item dropdown no-arrow">
                    <!-- <i class="fas fa-user-circle fa-fw"></i> -->
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <form method="GET" action="">
                    <input type="submit" class="dropdown-item" name="logout" value="Logout" data-toggle="modal"
                        data-target="#logoutModal">
                </form>
            </div>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="home.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Slots</li>
                </ol>
            </div>

            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage Slots</h2>
                        </div>
                        <?php
        if(( $role == "admin")){
                    echo '
                        <div class="col-sm-6">
                            <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Slot</span></a>
                        </div> ';
                    }else{
                        echo '';
                    } ?>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <?php  
                        // output data of each row
                        foreach ($result as $row) {
                            $slot_id = $row['slot_id'];
                            $slot_name = $row['slot_name'];
                            $slot_type = $row['slot_type'];
                            $web_id = $row['web_id'];
                            ?>
                    <div class="card m-3 ml-5" style="width: 18rem;">
                        <img class="card-img-top" src="uploads/testimg.png" alt="Card image cap" width="200px"
                            height="250px">
                        <div class="card-body">
                            <h4 class="card-title"> <?php echo $slot_name ?> </h4>
                            <!-- <a href="upload.php?slot_id= <?php echo $slot_id?>" class="btn btn-primary"
                                style="margin-right:3px;"> Edit </a> -->
                            <a onClick="changePage('<?php echo $slot_type?>')" class="btn btn-primary"
                                style="margin-right:3px;color:#fff"> Edit </a>
                            <a class="btn btn-danger" onClick="slotDelete('<?php echo $slot_id ?>')"
                                style="color:#fff">Delete</a>
                        </div>
                    </div>
                    <?php         
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Add New Slot Modal -->
        <div id="addUserModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="config.php?web_id=<?php echo $web_id?>">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Slot</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <?php include('errors.php');?>
                            <div class="form-group">
                                <label>Slot Name</label>
                                <input type="text" class="form-control" name="slot_name" required>
                            </div>
                            <div class="form-group">
                                <label>Select Website</label>
                                <select name="web" class="form-control">
                                    <?php
                                                foreach ($result2 as $web) { ?>
                                    <option value="<?php echo $web['web_id'] ?>">
                                        <?php echo $web['web_name'] ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Slot Type</label>
                                <select name="slot_type" class="form-control">
                                    <option value="image">Image</option>
                                    <option value="text">Text</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" name="add_slot" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Slot delete function -->
        <script>
        function myFunction() {
            if (confirm("Press a button!")) {
                window.location.href =
                    "config.php?slot_delete=1&slot_id=<?php echo $slot_id ?>&web_id=<?php echo $row['web_id'];?>";
            } else {
                window.location.href = "slots.php"
            }
        }
        </script>

        <script>
        function changePage(b) {
            var type = b;
            // alert(type);
            if (type == "image") {
                window.location.href = "upload.php?slot_id=<?php echo $slot_id ?>";
            } else {
                window.location.href = "uploadtext.php?slot_id=<?php echo $slot_id ?>&web_id=<?php echo $web_id ?>";
            }
        }
        </script>

        <script>
        function slotDelete(b) {
            var id = b;
            // alert(id);
            if (window.confirm("Do you really want to Delete ?")) {
                window.location.href = "config.php?slot_delete=1&slot_id=" + id +
                    "&web_id=<?php echo $row['web_id'];?>";
            }
        }
        </script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
</body>

</html>