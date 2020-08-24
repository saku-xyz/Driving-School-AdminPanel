<?php include('config.php');?>
<?php include('user.php');?>
<?php  
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$role = $row['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Panel</title>

    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/dropzone.css" />

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                    <input type="submit" class="dropdown-item" name="logout" value="Logout" data-toggle="modal" data-target="#logoutModal">
                </form>
            </div>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        if(( $role == "admin")){
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
                </ol>

                <?php 
                    // must change sql query's manual web id
                    $query = "SELECT DISTINCT websites.web_name , websites.web_id , websites.url
                    FROM `websites`, users, user_slots, slots 
                    WHERE users.user_id=user_slots.user_id 
                    and user_slots.slot_id=slots.slot_id 
                    and slots.web_id=websites.web_id 
                    and users.user_id=$user_id 
                    GROUP BY websites.web_id"; 
                    $result = mysqli_query($db, $query); ?>

                <div class="row">
                    <?php  
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $web_id = $row['web_id'];
                            $webname = $row['web_name'];
                            $web_url = $row['url'];
                            ?>
 
                        <div class="card m-3 ml-5" style="width: 18rem;" style="width: 18rem;">
                            <img class="card-img-top" src="uploads/testimg.png" alt="Card image cap" width="200px"
                                height="250px">
                            <div class="card-body">
                                <h4 class="card-title"> <?php echo $webname ?> </h4>
                                <h6 class="card-title"> <?php echo $web_url ?> </h6>
                                <a href="slots.php?web_id=<?php echo $web_id?>" class="btn btn-success"
                                    style="margin-right:3px;"> Go to Slots </a>
                            </div>
                        </div>

                    <?php         
                        }
                    ?>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src="./assets/js/script.js"></script>
    <script type="text/javascript" src="./assets/js/dropzone.js"></script>
</body>

</html>