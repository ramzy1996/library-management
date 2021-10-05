<?php
session_start();
include("./links.php");
include("./connection.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="userassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="userassets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.php">Library Management</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="index.php#home">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#book">Book List</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                    <li><a class="nav-link scrollto" href="index.php#contact">Contact Us</a></li>
                    <?php if (isset($_SESSION['other'])) { ?>
                        <li><a class="nav-link scrollto" href="settingsstd.php#profile">Profile</a></li>
                        <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
                    <?php } else if (isset($_SESSION['Librarian'])) { ?>
                        <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li><a class="nav-link scrollto" href="login.php#login">Login</a></li>
                    <?php } ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->
    <div style="margin-top: 124px;">
        <section id="login" class="services">
            <div class="container">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 shadow-sm">
                            <form id="form" method="post">
                                <h3 class="text-center">Login</h3>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control my-2" placeholder="Enter Email" autocomplete="off">
                                </div>
                                <div class="form-group">

                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                                </div>
                                <br>
                                <input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Services Section -->
    </div>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>2021</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by Ruzny
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="userassets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="userassets/js/main.js"></script>
</body>
<style>
    .error {
        color: red;
    }
</style>
<script>
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: 'Please enter Email Address.',
                    email: 'Please enter a valid Email Address.',
                },
                password: {
                    required: 'Please enter mobile number.',
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];


    $query = "Select * FROM users WHERE email = '$username'";
    $res = mysqli_query($connect, $query);
    $users = mysqli_fetch_array($res);

    $id = $users['id'];
    $email = $users['email'];
    $usrpassword = $users['password'];
    $role = $users['role'];




    if ($role == "Student" || $role == "Professor") {
        if ($username == $email && $password == $usrpassword) {
            $_SESSION['oid'] = $id;
            $_SESSION['other'] = $email;
            if ($_GET['continue']) {
                echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Login successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "' . $_GET['continue'] . '";
                });
            });
            </script>';
            } else {
                echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Login successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "index.php";
                });
            });
            </script>';
            }
        } else {
            echo '
                    <script type="text/javascript">
                    $(document).ready(function(){
                        swal({
                            title: "Error!",
                            text: "Email or password wrong!",
                            icon: "error",
                          });
                    });
                    </script>';
        }
    }


    if ($role == "Librarian") {
        if ($username == $email && $password == $usrpassword) {
            $_SESSION['libid'] = $id;
            $_SESSION['Librarian'] = $email;
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Login successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "dashboard.php";
                });
            });
            </script>';
        } else {
            echo '
                    <script type="text/javascript">
                    $(document).ready(function(){
                        swal({
                            title: "Error!",
                            text: "Email or password wrong!",
                            icon: "error",
                          });
                    });
                    </script>';
        }
    }
}
?>

</html>