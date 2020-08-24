<?php include('config.php');?>
<?php include('user.php');?>
<?php
    require('conn.php');
?>
<?php  
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<?php
$showRecordPerPage = 5;
if(isset($_GET['page']) && !empty($_GET['page'])){
$currentPage = $_GET['page'];
}else{
$currentPage = 1;
}
$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
$totalUserSlotSQL = "SELECT DISTINCT users.user_id , users.user_name , slots.slot_id , slots.slot_name, slots.slot_type, web_name
FROM users,user_slots,slots,websites
WHERE user_slots.user_id =users.user_id AND user_slots.slot_id=slots.slot_id AND slots.web_id=websites.web_id";
$allUserSlotResult = mysqli_query($db, $totalUserSlotSQL);
$totalCount = mysqli_num_rows($allUserSlotResult);
$lastPage = ceil($totalCount/$showRecordPerPage);
$firstPage = 1;
$nextPage = $currentPage + 1;
$previousPage = $currentPage - 1;
$UserSlotQL = "SELECT DISTINCT users.user_id , users.user_name , slots.slot_id , slots.slot_name, slots.slot_type, web_name
FROM users,user_slots,slots,websites
WHERE user_slots.user_id =users.user_id AND user_slots.slot_id=slots.slot_id AND slots.web_id=websites.web_id LIMIT $startFrom, $showRecordPerPage";
$Usr_Slot_Result = mysqli_query($db, $UserSlotQL);
?>

<?php 
// insert user slots
if (isset($_POST['adduserslot']))
{
$userid = ($_POST['useroption']);
$slotid = ($_POST['slotoption']);

//fields empty
if(empty($userid))
{
array_push($errors,"Please enter website name!");
}
if(empty($slotid))
{
array_push($errors,"Please enter URL!");
}

//no errors
if(count($errors) == 0)
{
$sql="INSERT INTO user_slots(user_id,slot_id) VALUES ('$userid','$slotid')";
mysqli_query($db, $sql);


header('location:user_slot.php');
}
}
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
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <p class="mt-2" style="color:#fff;"> Logged as <?php echo $row['name']; ?></p>
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
        <?php
        if(( $row['role'] == "admin")){
                 echo '<ul class="sidebar navbar-nav">
                 <li class="nav-item">
                 <a class="nav-link" href="website.php">
                         <i class="fas fa-fw fa-chart-area"></i>
                         <span>Websites</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="user_account.php">
                         <i class="fas fa-fw fa-table"></i>
                         <span>User Accounts</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="user_slot.php">
                         <i class="fas fa-fw fa-table"></i>
                         <span>User Slots</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="slot_manage.php">
                         <i class="fas fa-fw fa-table"></i>
                         <span>Slots</span></a>
                 </li>
             </ul>';
             }else{
                 echo '<ul class="sidebar navbar-nav">
                 <li class="nav-item active">
                 <a class="nav-link" href="home.php">
                         <i class="fas fa-fw fa-tachometer-alt"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
             </ul>';
             }
        ?>

        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
                <hr>

                <!-- User mANAGE Table -->

                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2>Manage Users</h2>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i
                                            class="material-icons">&#xE147;</i> <span>Add New User Slot</span></a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="memberModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="memberModalLabel">Edit User Detail</h4>
                                    </div>
                                    <div class="dash">

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div id="member" class="col-lg-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Website</th>
                                                <th>Slot Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                        while ($row = mysqli_fetch_assoc($Usr_Slot_Result)):
                            echo '<tr>';
                                echo '<td>'.$row['user_id'].'</td>';
                                echo '<td>'.$row['user_name'].'</td>';
                                echo '<td>'.$row['web_name'].'</td>';
                                echo '<td>'.$row['slot_name'].'</td>';
                                echo '<td>
                                        <a class="btn btn-sm btn-primary" style="color:#fff" 
                                           data-toggle="modal"
                                           data-target="#exampleModal"
                                           data-whatever="'.$row['user_id'].'">
                                           <i
                                           class="material-icons" data-toggle="tooltip"
                                           title="Edit">&#xE254;</i>
                                        </a>

                                        <a onclick="slotDelete('.$row['user_id'].','.$row['slot_id'].')" style="color:#fff" class="btn btn-sm btn-Danger">
                                            <i
                                           class="material-icons" data-toggle="tooltip"
                                           title="Delete">&#xE872;
                                           </i>
                                        </a>
                                     </td>';
                            echo '</tr>';
                         endwhile;
                         /* free result set */
                         $Usr_Slot_Result->close();
                    ?>
                                        </tbody>
                                    </table>

                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <?php if($currentPage != $firstPage) { ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">First</span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php if($currentPage >= 2) { ?>
                                            <li class="page-item"><a class="page-link"
                                                    href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a>
                                            </li>
                                            <?php } ?>
                                            <li class="page-item active"><a class="page-link"
                                                    href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a>
                                            </li>
                                            <?php if($currentPage != $lastPage) { ?>
                                            <li class="page-item"><a class="page-link"
                                                    href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $lastPage ?>"
                                                    aria-label="Next">
                                                    <span aria-hidden="true">Last</span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal HTML -->
                        <div id="addUserModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add User to Slot</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                        </div>
                                        <?php 
                                        $query = "SELECT * FROM users;";
                                        $result1 = mysqli_query($db, $query);

                                        $query = "SELECT * FROM slots;";
                                        $result2 = mysqli_query($db, $query);

                                        $web_result = $mysqli->query("SELECT * FROM websites");
                                        ?>
                                        <div class="modal-body">
                                            <?php include('errors.php');?>
                                            <div class="form-group">
                                                <label>Website</label>
                                                <select name="useroption" class="form-control">
                                                    <?php 
                                                 while($row = $web_result->fetch_assoc()) {
                                                     $userid =$row['web_name']; ?>
                                                    <option name="<?php echo $userid ?>" value="<?php echo $userid ?>">
                                                        <?php echo $row['web_id'] ?> - <?php echo $row['web_name'] ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <select name="useroption" class="form-control">
                                                    <?php 
                                                 while($row = $result1->fetch_assoc()) {
                                                     $userid =$row['user_id']; ?>
                                                    <option name="<?php echo $userid ?>" value="<?php echo $userid ?>">
                                                        <?php echo $row['user_id'] ?> - <?php echo $row['user_name'] ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Slot</label>
                                                <select name="slotoption" class="form-control">
                                                    <?php 
                                                 while($row = $result2->fetch_assoc()) { 
                                                    $slotid =$row['slot_id']; ?>
                                                    <option name="<?php echo $slotid ?>" value="<?php echo $slotid ?>">
                                                        <?php echo $row['slot_id'] ?> - <?php echo $row['slot_name'] ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" class="btn btn-default" data-dismiss="modal"
                                                value="Cancel">
                                            <input type="submit" name="adduserslot" class="btn btn-success" value="Add">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                        function slotDelete(a,b) {
                            var id = a;
                            var sid = b;
                            // alert(id);
                            if (window.confirm("Do you really want to Delete ?")) {
                                window.location.href = "config.php?userslot_delete=1&user_id="+a+"&slot_id="+b+"";
                            }
                        }
                        </script>
                        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                            crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                            crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                            crossorigin="anonymous"></script>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                        <!-- Latest compiled and minified JavaScript -->
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                            crossorigin="anonymous"></script>
                        <script>
                        $('#exampleModal').on('show.bs.modal', function(event) {
                            var button = $(event.relatedTarget) // Button that triggered the modal
                            var recipient = button.data('whatever') // Extract info from data-* attributes
                            var modal = $(this);
                            var dataString = 'id=' + recipient;

                            $.ajax({
                                type: "GET",
                                url: "edit_userslot.php",
                                data: dataString,
                                cache: false,
                                success: function(data) {
                                    console.log(data);
                                    modal.find('.dash').html(data);
                                },
                                error: function(err) {
                                    console.log(err);
                                }
                            });
                        })
                        </script>
</body>

</html>