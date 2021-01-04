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
                <div class="container">
                    <form method="post" action="config.php">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="indexno">ඇතුලත්වීමේ අංකය</label>
                                <input type="text" class="form-control" id="indexno" name="indexno" placeholder="Index Number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">සම්පූර්ණ නම</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nic">හැදුනුම්පත් අංක​ය</label>
                                <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC Number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="barcode">Barcode</label>
                                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="dob">උපන්දින​ය</label>
                                <input type="text" class="form-control" id="dob">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telephone">දුරක​තන අංක​ය</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone Number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">ලිපින​ය</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Name">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="vehicle_class">වාහන පංති​ය</label>
                                <select name="vehicle_class" class="custom-select">
                                    <option selected>Select Vehicle Class</option>
                                    <option value="A">A</option>
                                    <option value="A1">A1</option>
                                    <option value="B">B</option>
                                    <option value="B1">B1</option>
                                    <option value="G">G</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">පුහුණුවේ ස්වභාව​ය</label>
                                <input type="text" class="form-control" id="training_type" name="training_type">
                            </div>
                        </div>

                        <label style="margin-top: 10px;">රියදුරු බලපත්‍රය ඇත්නම් විස්ත​ර</label>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="licence_no">අංක​ය</label>
                                <input type="text" class="form-control" id="licence_no" name="licence_no" placeholder="Licence Number">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">වාහන පංති​ය</label>
                                <input type="text" class="form-control" id="vehicle_class2" name="vehicle_class2">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCity">නිකුත්කල දින​ය</label>
                                <input type="text" class="form-control" id="issued_date" name="issued_date">
                            </div>
                        </div>

                        <label style="margin-top: 10px;">වෛද්‍ය සහතික​ය</label>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="medical_no">අංක​ය</label>
                                <input type="text" class="form-control" id="medical_no" name="medical_no" placeholder="Medical Number">
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <label for="inputCity">නිකුත්කල දින​ය</label>
                                <input type="text" class="form-control" id="medi_issued_date" name="medi_issued_date">
                            </div> -->

                            <div class="form-group col-md-6">
                                <!-- Date input -->
                                <label for="inputCity">නිකුත්කල දින​ය</label>
                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text" />
                            </div>
                        </div>

                        <button type="submit" name="addcustomer" class="btn btn-primary">Register</button>
                    </form>
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