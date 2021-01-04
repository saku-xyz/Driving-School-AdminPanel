 <!-- Sidebar -->
 <?php
        if (($row['role'] == "admin")) {
            echo '<ul class="sidebar navbar-nav">
                 <li class="nav-item">
                 <a class="nav-link" href="add_user.php">
                         <i class="fas fa-fw fa-chart-area"></i>
                         <span>Add Customers</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="view_user.php">
                         <i class="fas fa-fw fa-table"></i>
                         <span>Customers List</span></a>
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
        } else {
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