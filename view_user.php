<?php include('config.php'); ?>
<?php include('user.php'); ?>
<?php
require('conn.php');

$result = $mysqli->query("SELECT * FROM `customer`");
?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<?php
$showRecordPerPage = 5;
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
$totalUserSQL = "SELECT * FROM customer";
$allUserResult = mysqli_query($db, $totalUserSQL);
$totalUser = mysqli_num_rows($allUserResult);
$lastPage = ceil($totalUser / $showRecordPerPage);
$firstPage = 1;
$nextPage = $currentPage + 1;
$previousPage = $currentPage - 1;
$userSQL = "SELECT *
FROM `customer` LIMIT $startFrom, $showRecordPerPage";
$userResult = mysqli_query($db, $userSQL);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

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
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <p class="mt-2" style="color:#fff;"> Logged as <?php echo $row['name']; ?></p>
                    <!-- <i class="fas fa-user-circle fa-fw"></i> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <form method="GET" action="">
                        <input type="submit" class="dropdown-item" name="logout" value="Logout" data-toggle="modal" data-target="#logoutModal">
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('navbar.php'); ?>

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
                                    <a href="add_user.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
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
                                <div id="member" class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Customer Index</th>
                                                <th>Name</th>
                                                <th>NIC</th>
                                                <th>Barcode</th>
                                                <th>Date of Birth</th>
                                                <th>Address</th>
                                                <th>Telephone</th>
                                                <th>Vehicle No</th>
                                                <th>Training Type</th>
                                                <th>Licence No</th>
                                                <th>Vehicle Class</th>
                                                <th>Licence Issued Date</th>
                                                <th>Medical No</th>
                                                <th>Medical Issued Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($userResult)) :
                                                echo '<tr>';
                                                echo '<td>' . $row['cus_index'] . '</td>';
                                                echo '<td>' . $row['name'] . '</td>';
                                                echo '<td>' . $row['nic'] . '</td>';
                                                echo '<td>' . $row['barcode'] . '</td>';
                                                echo '<td>' . $row['dob'] . '</td>';
                                                echo '<td>' . $row['address'] . '</td>';
                                                echo '<td>' . $row['telephone'] . '</td>';
                                                echo '<td>' . $row['vehicle_no'] . '</td>';
                                                echo '<td>' . $row['training_type'] . '</td>';
                                                echo '<td>' . $row['license_no'] . '</td>';
                                                echo '<td>' . $row['vehicle_class'] . '</td>';
                                                echo '<td>' . $row['lic_issued_date'] . '</td>';
                                                echo '<td>' . $row['medical_no'] . '</td>';
                                                echo '<td>' . $row['med_issued_date'] . '</td>';
                                                echo '<td>
                                                                    <a class="btn btn-sm btn-primary" style="color:#fff" 
                                                                    href="update_user.php?cus_id= ">
                                                                    <i
                                                                    class="material-icons" data-toggle="tooltip"
                                                                    title="Edit">&#xE254;</i>
                                                                    </a>

                                                                    <a onClick="slotDelete(' . $row['cus_id'] . ')" style="color:#fff" class="btn btn-sm btn-Danger">
                                                                        <i
                                                                    class="material-icons" data-toggle="tooltip"
                                                                    title="Delete">&#xE872;
                                                                    </i>
                                                                    </a>
                                                                </td>';
                                                echo '</tr>';
                                            endwhile;
                                            /* free result set */
                                            // $result->close();
                                            ?>
                                        </tbody>
                                    </table>
                                    <!-- Table Pagination Start -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <?php if ($currentPage != $firstPage) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
                                                        <span aria-hidden="true">First</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($currentPage >= 2) { ?>
                                                <li class="page-item"><a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a>
                                                </li>
                                            <?php } ?>
                                            <li class="page-item active"><a class="page-link" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a>
                                            </li>
                                            <?php if ($currentPage != $lastPage) { ?>
                                                <li class="page-item"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
                                                        <span aria-hidden="true">Last</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                    <!-- Table Pagination End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal HTML -->
                <div id="addUserModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="config.php">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add User</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <?php include('errors.php'); ?>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="confirmpass">
                                    </div>
                                    <div class="form-group">
                                        <label>Select User Role</label>
                                        <select name="role" class="form-control">
                                            <option value="admin">admin</option>
                                            <option value="user">user</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" name="adduser" class="btn btn-success" value="Add">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    function slotDelete(b) {
                        var id = b;
                        // alert(id);
                        if (window.confirm("Do you really want to Delete ?")) {
                            window.location.href = "config.php?customer_delete=1&cus_id=" + id + "";
                        }
                    }
                </script>


                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <!-- Latest compiled and minified JavaScript -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                <script>
                    $('#exampleModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget) // Button that triggered the modal
                        var recipient = button.data('whatever') // Extract info from data-* attributes
                        var modal = $(this);
                        var dataString = 'id=' + recipient;

                        $.ajax({
                            type: "GET",
                            url: "edituser.php",
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