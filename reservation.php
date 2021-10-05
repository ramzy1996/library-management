<?php
include("./connection.php");

$output = "";
$style = '';

if (isset($_POST["reservation"])) {

    $date = $_POST['date'];
    $uid = $_POST['uid'];
    $bid = $_POST['bid'];
    $error = array();

    if (empty($date)) {
        $error['error'] = "Date is Empty";
    } else if (empty($uid)) {
        $error['error'] = "User id is Empty";
    } else if (empty($bid)) {
        $error['error'] = "Book id is Empty";
    }


    if (isset($error['error'])) {
        $output .= $error['error'];
        $style = 'style="color:red"';
    } else {
        $output .= "";
    }
    if (count($error) < 1) {
        $query = "INSERT INTO reservation(date,uid,bid) VALUES('$date','$uid', '$bid')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $output .= "You have successfully registered";
            $style = 'style="color:green"';
            header("Location:showuser.php");
        } else {
            $output .= "Failed to register";
        }
    }
}
?>

<?php
date_default_timezone_set("Asia/Colombo")
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multilogin System</title>
</head>

<body>

    <?php include("./header.php"); ?>

    <div class="container">
        <div class="col-md-12">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 shadow-sm" style="margin-top: 100px;">
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <h3 class="text-center my-3">Reservation</h3>

                        <div class="text-center" <?php echo $style ?>><?php echo $output; ?> </div>
                        <br>
    
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Date</label>
                                <input name="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" placeholder="Enter date" autocomplete="off" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>User Id</label>
                                <input type="int" name="uid" class="form-control" placeholder="Enter User ID" autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter User Name" autocomplete="off">

                            </div>
                            <div class="form-group col-md-6">
                                <label>Book ID</label>
                                <input type="int" name="bid" class="form-control" placeholder="Enter Book Id" autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Book Name</label>
                                <input type="text" name="bookname" class="form-control" placeholder="Enter Book Name" autocomplete="off">
                            </div>
                        </div>

                        
                        <br>
                        <input type="submit" name="reservation" class="btn btn-success" value="Reserve">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="" style="margin-top: 30px;"></div>


</body>

</html>