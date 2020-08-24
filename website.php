<?php include('config.php');?>
<?php include('user.php');?>
<?php
    require('conn.php');

    $result = $mysqli->query("SELECT * FROM `websites`");
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
$totalWebSQL = "SELECT * FROM websites";
$allWebResult = mysqli_query($db, $totalWebSQL);
$totalWebsites = mysqli_num_rows($allWebResult);
$lastPage = ceil($totalWebsites/$showRecordPerPage);
$firstPage = 1;
$nextPage = $currentPage + 1;
$previousPage = $currentPage - 1;
$websiteSQL = "SELECT *
FROM `websites` LIMIT $startFrom, $showRecordPerPage";
$webResult = mysqli_query($db, $websiteSQL);
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
                                    <h2>Manage Websites</h2>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#addWebModal" class="btn btn-success" data-toggle="modal"><i
                                            class="material-icons">&#xE147;</i> <span>Add New Website</span></a>
                                    <!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
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
                                                <th>ID</th>
                                                <th>Web Name</th>
                                                <th>URL</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                         while ($row = mysqli_fetch_assoc($webResult)):
                            $web_id = 1;
                            echo '<tr>';
                                echo '<td>'.$web_id.'</td>';
                                echo '<td>'.$row['web_name'].'</td>';
                                echo '<td>'.$row['url'].'</td>';
                                echo '<td>
                                        <a class="btn btn-sm btn-primary" style="color:#fff" 
                                           data-toggle="modal"
                                           data-target="#exampleModal"
                                           data-whatever="'.$row['web_id'].' ">
                                           <i
                                           class="material-icons" data-toggle="tooltip"
                                           title="Edit">&#xE254;</i>
                                        </a>

                                        <a onClick="slotDelete('.$row['web_id'].')" style="color:#fff" class="btn btn-sm btn-Danger">
                                            <i
                                           class="material-icons" data-toggle="tooltip"
                                           title="Delete">&#xE872;
                                           </i>
                                        </a>
                                     </td>';
                            echo '</tr>';
                            $web_id= $web_id+1;
                         endwhile;
                         /* free result set */
                         $result->close();
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
                    </div>

                    <!-- Edit Modal HTML -->
                    <div id="addWebModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Website</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <?php include('errors.php');?>
                                        <div class="form-group">
                                            <label>Web Name</label>
                                            <input type="text" class="form-control" name="web_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>URL</label>
                                            <input type="text" class="form-control" name="url" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal"
                                            value="Cancel">
                                        <input type="submit" name="addweb" class="btn btn-success" value="Add">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal HTML -->
                    <div id="editWebModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="config.php?web_id=<?php echo $web_id?>">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Update Website</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Website Name</label>
                                            <input type="text" name="web_name" placeholder="<?php echo $web_name ?>"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>URL</label>
                                            <input type="text" name="url" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal"
                                            value="Cancel">
                                        <input type="submit" name="update_user" class="btn btn-info" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal HTML -->
                    <div id="deleteWebModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form>
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete Employee</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete these Records?</p>
                                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal"
                                            value="Cancel">
                                        <input type="submit" class="btn btn-danger" value="Delete">
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
                            window.location.href = "config.php?web_delete=1&web_id=" + id + " ";
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
                            url: "editwebsite.php",
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