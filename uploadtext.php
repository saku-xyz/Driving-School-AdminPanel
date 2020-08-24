<?php include('config.php');?>
<?php include('user.php');?>
<?php  
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<?php
$slot_id = $_GET['slot_id'];
$web_id = $_GET['web_id'];
$query = ("SELECT * FROM items WHERE slot_id='$slot_id'");
$results = mysqli_query($db, $query);
$rows = mysqli_fetch_assoc($results);
?>
<?php 
        if (isset($_POST['submit']))
        {
        $text= ($_POST['upload_text']);
        $webid=($_POST['webid']);
        $slotid=($_POST['slotid']);
        //fields empty
        if(empty($text))
        {  
        array_push($errors,"Please enter something!");
        }
        
        //no errors
        if(count($errors) == 0)
        {
        $text_add_qry="INSERT INTO items (description,slot_id) VALUES ('$text','$slotid')";
        mysqli_query($db, $text_add_qry);
        header("Location:slots.php?web_id=$webid");
        }
        }
        if (isset($_POST['update']))
        {
        $text= ($_POST['upload_text']);
        $webid=($_POST['webid']);
        $slotid=($_POST['slotid']);
        //fields empty
        if(empty($text))
        {
        array_push($errors,"Please enter something!");
        }
        //no errors
        if(count($errors) == 0)
        {
        $text_update_qry="UPDATE items
        SET description = '$text'
        WHERE slot_id = $slotid";
        mysqli_query($db, $text_update_qry);
        header("Location:uploadtext.php?slot_id=$slotid&web_id=$webid");  
// echo '<script language="javascript">';
// echo 'alert("message successfully sent")';
// echo '</script>';  
        }
        }
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
    <link href="assets/css/table.css" rel="stylesheet">

    <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/dropzone.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

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
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
            </div>

            <div class="container">
                <!-- <h3> Upload Text </h3> <br> -->
                <form method="post" action="uploadtext.php">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">
                            <h5>Enter Your Text Here </h5>
                        </label>
                        <textarea class="form-control" name="upload_text" id="exampleFormControlTextarea1"
                            rows="8"><?php echo $rows['description'];?></textarea>
                    </div>
                    <input type="hidden" value="<?php echo $web_id ?>" name="webid" />
                    <input type="hidden" value="<?php echo $slot_id ?>" name="slotid" />
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="submit" value="Insert" />
                        <input class="btn btn-success" type="submit" name="update" value="Update" />
                    </div>
                </form>
            </div>

            <div class="container">

            </div>
        </div>
    </div>
</body>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src="./assets/js/script.js"></script>
<script type="text/javascript" src="./assets/js/dropzone.js"></script>

</html>