<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="title icon" href="~/images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kufam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="./assets/bootstrap/dist/css/bootstrap.min.css">

</head>
<?php
include('./restrict.php');
include('./connection.php');
?>
<?php

$url_array =  explode('/', $_SERVER['REQUEST_URI']);
$url = end($url_array);
?>
<?php
if (isset($_SESSION['Librarian'])) {
    $set_id = $_SESSION['libid'];
    $sql = "select * from users where id='$set_id'";
    $res = mysqli_query($connect, $sql);

    $row = mysqli_fetch_array($res);

    $id = $row['id'];
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $email = $row['email'];
    $image = $row['profile'];
    $role = $row['role'];
}


?>

<body>
    <!--wrapper start-->
    <div class="wrapper">
        <!--header satrt-->
        <div class="header">
            <div class="header-menu">
                <div class="title">Library <span>Management</span></div>
                <div class="sidebar-btn">
                </div>
                <ul>
                    <li><a href="logout.php"><i class="fas fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>
        <!--header end-->

        <!--sidebar start-->
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li class="text-center profile">
                    <?php if ($image) : ?>
                        <img src="images/<?php echo $image ?>">
                    <?php else : ?>
                        <img src="images/admin.png">
                    <?php endif ?>
                    <div class="text-muted">
                        <?php echo $fname; ?>
                    </div>
                    <div class="text-primary" style="user-select:none;">(<?php echo $role ?>)</div>
                </li>

                <li class="item">
                    <a class="menu-btn <?php if ($url == 'dashboard.php') {
                                            echo "current";
                                        } ?>" href="dashboard.php"><i class="fas fa-home mar"></i><span>Dashboard</span></a>
                </li>

                <li class="item">
                    <a class="menu-btn <?php if ($url == 'showuser.php' || $url == 'register.php' || isset($_GET['updateid'])) {
                                            echo "current";
                                        } ?>" href="showuser.php"><i class="fas fa-user mar"></i> <span>Users</span></a>
                </li>


                <li class="item">
                    <a class="menu-btn <?php if ($url == 'showbook.php' || isset($_GET['dbid']) || isset($_GET['ubid']) || $url == 'addbooks.php') {
                                            echo "current";
                                        } ?>" href="showbook.php"><i class="fas fa-cart-plus mar"></i><span>Books</span></a>
                </li>

                <li class="item">
                    <a class="menu-btn <?php if ($url == 'showlending.php' || isset($_GET['lenid']) || isset($_GET['lenuid']) || $url == 'lendingbooks.php') {
                                            echo "current";
                                        } ?>" href="showlending.php"><i class="fas fa-people-carry mar"></i><span>Lending</span></a>
                </li>


                <li class="item">
                    <a href="showreturn.php" class="menu-btn <?php if ($url == 'showreturn.php' || isset($_GET['retid'])) {
                                                                    echo "current";
                                                                } ?>"><i class="far fa-file-alt mar"></i><span>Return</span></a>
                </li>

                <li class="item">
                    <a href="user_reserved.php" class="menu-btn <?php if ($url == 'user_reserved.php') {
                                                                    echo "current";
                                                                } ?>"><i class="far fa-file-alt mar"></i><span>Reservation</span></a>
                </li>

                <li class="item" style="padding-bottom: 50px">
                    <a href="settings.php" class="menu-btn <?php if ($url == 'settings.php') {
                                                                echo "current";
                                                            } ?>"><i class="fas fa-cog  mar"></i><span>Settings</span></a>
                </li>
            </ul>
        </div>
        <!--sidebar end-->

    </div>
</body>

</html>