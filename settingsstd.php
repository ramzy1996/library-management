<?php
include('./links.php');
include('./connection.php');
include('./restrictstd.php');
?>
<?php
if (isset($_SESSION['other'])) {
    $set_id = $_SESSION['oid'];
    $sql = "select * from users where id='$set_id'";
    $res = mysqli_query($connect, $sql);

    $row = mysqli_fetch_array($res);

    $id = $row['id'];
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $image = $row['profile'];
    $role = $row['role'];
    $password = $row['password'];
}
?>
<?php
if (isset($_GET['cancel'])) {
    $can_id = $_GET['cancel'];
    $sql = "UPDATE reservation SET status='Canceled' where id='$can_id'";
    $res = mysqli_query($connect, $sql);
    if ($res == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Canceled success!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  });
            });
            </script>';
    } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="userassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="userassets/css/style.css" rel="stylesheet">

    <style>
        .avatar-xl img {
            width: 110px;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .text-muted {
            font-weight: 300;
        }



        ::-webkit-file-upload-button {
            cursor: pointer;
        }

        input[type=file] {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <input value="<?php echo $password ?>" id="Oldpassword" type="hidden" style="display: none;">
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

    <div class="container" style="margin-top: 100px;" id="profile">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <h2 class="h3 mb-4 page-title">Settings</h2>
                <div class="my-4">
                    <form id="form" method="post" enctype="multipart/form-data">
                        <input value="<?php echo $role ?>" id="role" name="role" type="hidden" style="display: none;">

                        <div class="row align-items-center">
                            <div class="col-md-3 text-center mb-5">
                                <label for="emp_image" style="cursor:pointer" class="avatar avatar-xl">
                                    <?php if (empty($image)) : ?>
                                        <img id="profilePicture" style="height: 100px; width: 100px;" class="avatar-img rounded-circle" src="images/admin.png">
                                    <?php else : ?>
                                        <img id="profilePicture" style="height: 100px; width: 100px;" class="avatar-img rounded-circle" src="images/<?php echo $image ?>">
                                    <?php endif ?>
                                </label>
                                <input type="file" id="emp_image" name="emp_image" style="display: none" accept=".png,.jpg,.jpeg,.gif,.tif" onchange="document.getElementById('profilePicture').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="col">
                                <div class="row mb-5 align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">Hi, <b><?php echo $fname ?></b></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="emp_fname" class="form-label">First Name</label>
                                <input name="emp_fname" class="form-control" id="emp_fname" autocomplete="off" value="<?php echo $fname ?>" placeholder="Enter first name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emp_lname" class="form-label">Last Name</label>
                                <input class="form-control" id="emp_lname" name="emp_lname" autocomplete="off" value="<?php echo $lname ?>" placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emp_email" class="form-label">Email address</label>
                            <input type="email" name="emp_email" class="form-control" id="emp_email" autocomplete="off" value="<?php echo $email ?>" placeholder="Enter email address">
                        </div>
                        <div class="form-group">
                            <label for="emp_mobile" class="form-label">Mobile Number</label>
                            <input class="form-control" id="emp_mobile" name="emp_mobile" value="<?php echo $mobile ?>" placeholder="Enter mobile number" maxlength="10">
                        </div>

                        <hr class="my-4" />
                        <button type="submit" name="submit" class="btn btn-primary">Save Change</button>
                    </form>
                    <br><br>
                    <form id="formPass" method="post" enctype="multipart/form-data">
                        <h2>Change Password</h2>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="old_emp_password" class="form-label">Old Password</label>
                                    <input type="password" name="old_emp_password" class="form-control" id="old_emp_password" placeholder="Enter old password">
                                </div>
                                <div class="form-group">
                                    <label for="emp_password" class="form-label">New Password</label>
                                    <input type="password" name="emp_password" class="form-control" id="emp_password" placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label for="c_emp_password" class="form-label">Confirm Password</label>
                                    <input type="password" name="c_emp_password" class="form-control" id="password" placeholder="Enter confirm password">
                                </div>
                            </div>


                        </div>
                        <hr class="my-4" />
                        <button type="submit" name="submitPass" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <h2 class="text-center">Your Reservation</h2>
    <hr>

    <div class="row" style="width: 100%;">
        <div class="col-md-12 main-datatable">
            <div class="card_body">
                <div class="row d-flex">
                    <div class="col-sm-8 add_flex">
                        <div class="form-group searchInput">
                            <label for="search">Search:</label>
                            <input type="search" name="search" class="form-control" id="filterbox" placeholder=" ">
                        </div>
                    </div>
                </div>
                <div class="overflow-x">
                    <table style="width:100%;" id="filtertable" class="table cust-datatable dataTable no-footer">
                        <thead>
                            <tr>
                                <th>Book Name</th>
                                <th>Publisher Name</th>
                                <th>Category</th>
                                <th>Year</th>
                                <th>ISBN</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($_SESSION['other']) {
                                $sql = "select * from reservation where UID='$id'";
                            }
                            $res = mysqli_query($connect, $sql);


                            while ($row = mysqli_fetch_array($res)) {

                                $id = $row['id'];
                                $date = $row['date'];
                                $user = $row['UID'];
                                $book = $row['BID'];
                                $status = $row['status'];

                                // books
                                $sqlbook = "select * from books where id='$book'";
                                $resbook = mysqli_query($connect, $sqlbook);
                                $rowbook = mysqli_fetch_array($resbook);

                                $bookname = $rowbook['bookname'];
                                $publisher = $rowbook['publisher'];
                                $category = $rowbook['category'];
                                $year = $rowbook['year'];
                                $isbn = $rowbook['isbn'];


                            ?>
                                <tr>
                                    <td><?php echo $bookname ?></td>
                                    <td><?php echo $publisher ?></td>
                                    <td><?php echo $category ?></td>
                                    <td><?php echo $year ?></td>
                                    <td><?php echo $isbn ?></td>
                                    <td>
                                        <span style="font-size: 11px;" class="badge <?php if ($status == 'Pending') echo "badge-warning";
                                                                                    else if ($status == 'Lended') echo "badge-success";
                                                                                    else if ($status == 'Canceled') echo "badge-danger"; ?>"><?php echo $status ?></span>
                                    </td>
                                    <td>
                                        <?php if ($status == "Pending") { ?>
                                            <a href="settingsstd.php?cancel=<?php echo $id; ?>" onclick="return confirm('Are you sure to cancel?')" class="btn btn-danger"><i class="fas fa-times"></i>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
    <style>
        .error {
            color: red;
        }
    </style>
    <script>
        $(document).ready(function() {
            var dataTable = $('#filtertable').DataTable({
                "pageLength": 6,
                aoColumnDefs: [{
                    "aTargets": [6],
                    // "bSortable": false
                }],
                "dom": '<"top">ct<"top"p><"clear">'
            });
            $("#filterbox").keyup(function() {
                dataTable.search(this.value).draw();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    emp_fname: {
                        required: true
                    },
                    emp_email: {
                        required: true,
                        email: true
                    },
                    emp_mobile: {
                        required: true,
                        rangelength: [9, 10],
                        number: true,
                    },
                },
                messages: {
                    emp_name: 'Please enter first name.',
                    emp_email: {
                        required: 'Please enter Email Address.',
                        email: 'Please enter a valid Email Address.',
                    },
                    emp_mobile: {
                        required: 'Please enter mobile number.',
                        rangelength: 'Mobile number should be 10 digit number.'
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        $(document).ready(function() {
            $('#formPass').validate({
                rules: {
                    old_emp_password: {
                        required: true,
                        equalTo: "#Oldpassword"
                    },
                    emp_password: {
                        required: true,
                        minlength: 6
                    },
                    c_emp_password: {
                        required: true,
                        equalTo: "#emp_password"
                    },
                },
                messages: {
                    old_emp_password: {
                        required: 'Please enter Confirm Password.',
                        equalTo: 'Old Password do not match with Password.',
                    },
                    emp_password: {
                        required: 'Please enter Password.',
                        minlength: 'Password must be at least 6 characters long.',
                    },
                    c_emp_password: {
                        required: 'Please enter Confirm Password.',
                        equalTo: 'Confirm Password do not match with Password.',
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        jQuery.fn.ForceNumericOnly =
            function() {
                return this.each(function() {
                    $(this).keydown(function(e) {
                        var key = e.charCode || e.keyCode || 0;
                        return (
                            key == 8 ||
                            key == 9 ||
                            key == 13 ||
                            key == 46 ||
                            key == 110 ||
                            key == 190 ||
                            (key >= 35 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 96 && key <= 105));
                    });
                });
            };
        $("#emp_mobile").ForceNumericOnly();
    </script>
    <?php
    if (isset($_POST['submit'])) {
        $e_fname = $_POST['emp_fname'];
        $e_role = $_POST['role'];
        $e_lname = $_POST['emp_lname'];
        $e_email = $_POST['emp_email'];
        $e_mobile = $_POST['emp_mobile'];
        $e_image = $_FILES['emp_image']['name'];
        $e_tmp_name = $_FILES['emp_image']['tmp_name'];
        if (empty($e_image)) {
            $e_image = $image;
        }

        $query = "update users set first_name='$e_fname',last_name='$e_lname',mobile='$e_mobile',email='$e_email',role='$e_role',profile='$e_image' where id='$set_id'";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
        if ($result == true) {
            move_uploaded_file($e_tmp_name, "images/$e_image");
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Updated successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "";
                });
            });
            </script>';
        } else {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Updated Failed!",
                    icon: "error",
                  });
            });
            </script>';
        }
    }
    if (isset($_POST['submitPass'])) {
        $e_password = $_POST['emp_password'];


        $queryPass = "update users set password='$e_password' where id='$set_id'";
        $resultPass = mysqli_query($connect, $queryPass) or die(mysqli_error($connect));

        if ($resultPass == true) {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Password updated successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  });
            });
            </script>';
        } else {
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Update Failed!",
                    icon: "error",
                  });
            });
            </script>';
        }
    }
    ?>
</body>

</html>