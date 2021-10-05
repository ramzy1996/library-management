<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>

<?php
if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];
    $query = "SELECT * FROM users WHERE id=$id";
    $res = mysqli_query($connect, $query);

    $row = mysqli_fetch_assoc($res);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
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
    <title>Update User</title>

</head>

<body>
    <div class="container body">
        <h2 class="text-center">Edit Users</h2>
        <br><br>
        <div class="text-center">
            <?php if (empty($image)) : ?>
                <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px;" src="images/admin.png">
            <?php else : ?>
                <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px" src="images/<?php echo $image ?>">
            <?php endif ?>
        </div>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input name="fname" class="form-control" id="fname" value="<?php echo $first_name ?>" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input class="form-control" id="lname" name="lname" value="<?php echo $last_name ?>" placeholder="Enter last name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image" accept=".png,.jpg,.jpeg,.gif,.tif" style="border:0px!important;" onchange="document.getElementById('profilePicture').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" class="form-control">
                            <option value="Student" <?php if ($role == 'Student') echo "selected"; ?>>Student</option>
                            <option value="Librarian" <?php if ($role == 'Librarian') echo "selected"; ?>>Librarian</option>
                            <option value="Professor" <?php if ($role == 'Professor') echo "selected"; ?>>Professor</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo $email ?>" placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input class="form-control" id="mobile" name="mobile" value="<?php echo $mobile ?>" placeholder="Enter mobile number" maxlength="10">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password ?>" id="password" placeholder="Enter password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="c_password" class="form-label">Confirm Password</label>
                        <input type="password" name="c_password" class="form-control" value="<?php echo $password ?>" id="c_password" placeholder="Enter confirm password">
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
                </div>
                <div class="col-6">
                    <a class="btn btn-success btn-block" href="showuser.php">Back</a>
                </div>
            </div>
            <br><br>
        </form>
    </div>

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
                fname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    rangelength: [9, 10],
                    number: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                c_password: {
                    required: true,
                    equalTo: "#password"
                },
            },
            messages: {
                fname: 'Please enter first name.',
                email: {
                    required: 'Please enter Email Address.',
                    email: 'Please enter a valid Email Address.',
                },
                mobile: {
                    required: 'Please enter mobile number.',
                    rangelength: 'Mobile number should be 10 digit number.'
                },
                password: {
                    required: 'Please enter Password.',
                    minlength: 'Password must be at least 8 characters long.',
                },
                c_password: {
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
    $("#mobile").ForceNumericOnly();
</script>
<?php
if (isset($_POST['submit'])) {

    $e_fname = $_POST['fname'];
    $e_lname = $_POST['lname'];
    $e_email = $_POST['email'];
    $e_mobile = $_POST['mobile'];
    $e_role = $_POST['role'];
    $e_image = $_FILES['image']['name'];
    $e_tmp_name = $_FILES['image']['tmp_name'];
    $e_password = $_POST['password'];

    if (empty($e_image)) {
        $e_image = $image;
    }

    $sql = "update users set first_name='$e_fname',last_name='$e_lname',mobile='$e_mobile',email='$e_email',role='$e_role',profile='$e_image',password='$e_password' where id='$id'";
    $result = mysqli_query($connect, $sql);

    if ($result == true) {
        move_uploaded_file($e_tmp_name, "images/$e_image");
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Updated success!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "showuser.php";
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

</html>