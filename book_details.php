<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Packages</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="userassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link href="userassets/css/style.css" rel="stylesheet">
</head>
<?php
include('./connection.php');
include('./restrictstd.php');
?>
<?php
if (isset($_SESSION['other'])) {
    $set_id = $_SESSION['oid'];
    $sql = "select * from users where id='$set_id'";
    $res = mysqli_query($connect, $sql);

    $users = mysqli_fetch_array($res);

    $id = $users['id'];
    $fname = $users['first_name'];
    $email = $users['email'];
}
?>
<?php
if (isset($_GET['pckid'])) {
    $edit_id = $_GET['pckid'];
    $sql = "select * from books where id='$edit_id'";
    $res = mysqli_query($connect, $sql);

    if ($res->num_rows > 0) {
        $i = 1;
        while ($row_book = $res->fetch_assoc()) {
            $bookid = $row_book['id'];
            $bookname = $row_book['bookname'];
            $category = $row_book['category'];
            $publisher = $row_book['publisher'];
            $year = $row_book['year'];
            $isbn = $row_book['isbn'];
            $status = $row_book['status'];
        }
    }
}
?>
<?php
date_default_timezone_set("Asia/Colombo")
?>


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
                    <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
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

    <div class="container" style="margin-top: 100px;">
        <br><br>
        <form id="form" method="post" enctype="multipart/form-data">
            <table class="table" style="width: 75%;">
                <tr>
                    <td style="font-weight: bold;vertical-align: middle;"><label for="publisher" class="form-label">Publisher Name</label></td>
                    <td><input type="text" class="form-control" style="border: none;" name="publisher" id="publisher" value="<?php echo $publisher; ?>" readonly></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;vertical-align: middle;"><label for="book" class="form-label">Book Name</label></td>

                    <td><input type="text" class="form-control" style="border: none;" value="<?php echo $bookname; ?>" name="book" id="book" readonly></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;vertical-align: middle;"><label for="category" class="form-label">Category</label></td>
                    <td><input type="text" class="form-control" style="border: none;" name="category" id="category" value="<?php echo $category; ?>" readonly></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;vertical-align: middle;"><label for="year" class="form-label">Year</label></td>
                    <td><input type="text" class="form-control" style="border: none;" name="year" id="year" value="<?php echo $year; ?>" readonly></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;vertical-align: middle;"><label for="isbn" class="form-label">ISBN</label></td>
                    <td><input type="text" class="form-control" style="border: none;" name="isbn" id="isbn" readonly value="<?php echo $isbn; ?>"></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;vertical-align: middle;"><label for="status" class="form-label">Status</label></td>
                    <td><input type="text" class="form-control" style="border: none;" name="status" id="status" readonly value="<?php echo $status; ?>"></td>
                </tr>

                <tr>
                    <td style="font-weight: bold;vertical-align: middle;"><label for="usremail" class="form-label">User</label></td>
                    <td><input type="text" class="form-control" style="border: none;" name="usremail" id="usremail" readonly value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;vertical-align: middle;"><label for="usrname" class="form-label">User name</label></td>
                    <td><input type="text" class="form-control" style="border: none;" name="usrname" id="usrname" readonly value="<?php echo $fname; ?>"></td>
                </tr>
            </table>
            <input type="hidden" name="date" id="date" value="<?php echo date("Y-m-d"); ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary btn-block" style="width: 100%;" value="Reserve Book" name="submit">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <a class="btn btn-success btn-block" style="width: 100%;" href="index.php#book">Back</a>
                    </div>
                </div>
            </div>
        </form>
        <br><br>
    </div>
    <br><br>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style>
        .error {
            color: red;
        }
    </style>
</body>

<?php
if (isset($_POST['submit'])) {

    $date = $_POST['date'];

    $sql = "insert into reservation (date,UID,BID,status) values ('$date','$id','$bookid','Pending')";
    $result = mysqli_query($connect, $sql);
    if ($result == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Your book has been reserved!",
                    icon: "success",
                  }).then(function() {
                    window.location = "index.php#book";
                });
            });
            </script>';
    } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Reservation Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>

</html>