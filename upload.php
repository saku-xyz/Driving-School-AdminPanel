<?php include('config.php');?>
<?php include('user.php');
$user = $_SESSION['user_id'];
?>
<?php  
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<?php
$slot_id = $_GET['slot_id'];
$query = "SELECT * FROM items  where slot_id= $slot_id ORDER BY order_num ASC";
$result = mysqli_query($db, $query);
$rows = mysqli_fetch_assoc($result);

$query_user = "SELECT user_id, slot_id FROM user_slots WHERE user_id=$user AND slot_id = $slot_id";
$result2 = mysqli_query($db, $query_user);
$row2 = mysqli_fetch_assoc($result2);
if((!isset($_SESSION['user_id']))||($row2['slot_id']!=$slot_id)) {
    // header("Location: home.php");
    echo "<script type='text/javascript'>
    alert('Access Denied!');
    window.location.href = 'home.php';
    </script>";
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

    <!-- testing 123 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
                <div class="container">
                    <h2>Upload Banner Images</h2>
                    <br>
                    <div class="file_upload">
                        <form action="file_upload.php?slot_id=<?php echo $slot_id ?>" class="dropzone">
                            <div class="dz-message needsclick">
                                <strong>Drop files here or click to upload.</strong><br />
                                <span class="note needsclick">(Please upload <strong>jpg or png</strong> files
                                    only.)</span>
                            </div>
                        </form>
                    </div>
                    <div style="margin:10px 0px 0px 0px;">
                        <a class="btn btn-default read-more" type="button" onClick="window.location.reload();"
                            style="background:#3399ff;color:white" href="#" title="">Apply</a>
                    </div>
                </div> <br>
                <hr>

                <div class="container">
                    <h2>Drag & Edit Banner Order</h2>
                    <div class="container box">
                        <table class="table">
                            <tbody class="list-unstyled" id="page_list">
                                <?php 
                     while ($row = mysqli_fetch_assoc($result)):    
                        $s= $row['order_num'];
                        $a=1;
                        $t=$s+$a;
                        echo '        <tr id="'.$row['item_id'].'"> ';
                        echo '           <td> <img src="uploads/'.$row['content'].'" width="70px" height="50px">
                                 </td>';
                        echo '              <td>
                                             <h6>'.$t.'</h6>
                                             </td>';
                        echo '              <td>
                                              <h6>'.$row['url'].'</h6>
                                            </td>';
                        echo '            <td>
                                        <a class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#exampleModal"
                                        data-whatever="'.$row['item_id'].'"><i class="material-icons"
                                                data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                        <a onClick="slotDelete('.$row['item_id'].')" class="delete" data-toggle="modal"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Delete">&#xE872;</i></a>
                                    </td>';
                        echo '        </tr>';
                    endwhile;
                    /* free result set */
                ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="page_order_list" id="page_order_list" />
                    </div>
                </div>

                <!-- Edit Modal HTML -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="memberModalLabel">Edit Slot Items</h4>
                            </div>
                            <div class="dash">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'id=' + recipient;
        $.ajax({
            type: "GET",
            url: "edititem.php?slot_id=<?php echo $slot_id ?>",
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

    <script>
    function slotDelete(b) {
        var id = b;
        // alert(id);
        if (window.confirm("Do you really want to Delete ?")) {
            window.location.href = "config.php?item_delete=1&item_id=" + id + "";
        }
    }
    </script>

    <script>
    $(document).ready(function() {
        $("#page_list").sortable({
            placeholder: "ui-state-highlight",
            update: function(event, ui) {
                var page_id_array = new Array();
                $('#page_list tr').each(function() {
                    page_id_array.push($(this).attr("id"));
                });
                $.ajax({
                    url: "update.php",
                    method: "POST",
                    data: {
                        page_id_array: page_id_array
                    },
                    success: function(data) {
                        // alert(data);
                    }
                });
            }
        });

    });
    </script>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src="./assets/js/script.js"></script>
    <script type="text/javascript" src="./assets/js/dropzone.js"></script>

</body>

</html>