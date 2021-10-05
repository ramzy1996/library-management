<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
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
    $mobile = $row['mobile'];
    $image = $row['profile'];
    $role = $row['role'];
    $password = $row['password'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

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


    <div class="container body">
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
    <style>
        .error {
            color: red;
        }
    </style>
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
            move_uploaded_file($e_tmp_name, "uploads/$e_image");
            echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Updated successfully!",
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