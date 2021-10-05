<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>
<?php
if (isset($_GET['accept'])) {
    $id = $_GET['accept'];
    $query = "SELECT * FROM reservation WHERE id=$id";
    $res = mysqli_query($connect, $query);

    $row = mysqli_fetch_assoc($res);

    $uid = $row['UID'];
    $bid = $row['BID'];
    $status = $row['status'];
    $date = $row['date'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lending</title>
</head>

<body>
    <?php
    date_default_timezone_set("Asia/Colombo")
    ?>
    <div class="container body">
        <div class="col-md-12">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 shadow-sm">
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <h3 class="text-center my-3">Book Lending</h3>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="random-number" class="form-label">Code</label>
                                <input type="text" name="code" id="random-number" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="book" class="form-label">Select book</label>
                                <select name="book" id="book" class="form-control">
                                    <?php
                                    $res = mysqli_query($connect, "SELECT * FROM books where id='$bid'");
                                    while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <option value="<?php echo $row["bookname"]; ?>">
                                            <?php echo $row["bookname"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">

                                <label for="student" class="form-label">Select student</label>
                                <select name="student" id="student" class="form-control">
                                    <?php
                                    $res = mysqli_query($connect, "SELECT * FROM users where id = '$uid' ");
                                    while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <option value="<?php echo $row["first_name"]; ?>">
                                            <?php echo $row["first_name"] . " " . $row["last_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date" class="form-label">Date</label>
                                <input name="date" id="date" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="days" class="form-label">Free lending period</label>
                                <input type="text" name="days" id="days" class="form-control" placeholder="Enter days" maxlength="2">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block" name="submit">Add</button>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-success btn-block" href="showlending.php">Back</a>
                            </div>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
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
                book: {
                    required: true
                },
                student: {
                    required: true
                },
                days: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                book: 'Please enter book name.',
                student: 'Please enter publisher.',
                days: {
                    required: 'Please enter year.',
                    number: 'Enter valid day.'
                },
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
    $("#days").ForceNumericOnly();
</script>
<script>
    const d = new Date();
    document.getElementById('random-number').value = "LE#" + d.getHours() + d.getMinutes() + d.getSeconds();
</script>
<?php
if (isset($_POST["submit"])) {
    $code = $_POST['code'];
    $book = $_POST['book'];
    $student = $_POST['student'];
    $date = $_POST['date'];
    $days = $_POST['days'];

    $query = "INSERT INTO lendingbooks(code,book,student,date,days) VALUES('$code', '$book', '$student', '$date', '$days')";
    $res = mysqli_query($connect, $query);

    $sql = "UPDATE reservation SET status='Lended' where id='$id'";
    $res1 = mysqli_query($connect, $sql);

    if ($res == true && $res1 == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Lending added successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "showlending.php";
                });
            });
            </script>';
    } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Lending added Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>

</html>