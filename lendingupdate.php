<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>

<?php
if (isset($_GET['lenuid'])) {
    $id = $_GET['lenuid'];
    $query = "SELECT * FROM lendingbooks WHERE id=$id";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($res);

    $code = $row['code'];
    $book = $row['book'];
    $student = $row['student'];
    $date = $row['date'];
    $days = $row['days'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Lending</title>
</head>

<body>

    <div class="container my-5 body">
        <div class="col-md-12">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 shadow-sm">
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <h3 class="text-center my-3">Update Book Lending</h3>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="random-number" class="form-label">Code</label>
                                <input type="text" name="code" value="<?php echo $code; ?>" id="random-number" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="book" class="form-label">Select book</label>
                                <select name="book" id="book" class="form-control">
                                    <?php
                                    $res = mysqli_query($connect, "SELECT * FROM books");
                                    while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <option value="<?php echo $row["bookname"]; ?>" <?php if ($row["bookname"] == $book) echo "selected" ?>>
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
                                    $res = mysqli_query($connect, "SELECT * FROM users where role = 'Student' ");
                                    while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <option value="<?php echo $row["first_name"]; ?>" <?php if ($row["first_name"] == $student) echo "selected" ?>>
                                            <?php echo $row["first_name"]; ?>
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
                                <input name="date" id="date" class="form-control" value="<?php echo $date; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="days" class="form-label">Free lending period</label>
                                <input type="text" name="days" id="days" class="form-control" placeholder="Enter days" value="<?php echo $days; ?>" maxlength="2">
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
<?php
if (isset($_POST['submit'])) {
    $code = $_POST['code'];
    $book = $_POST['book'];
    $student = $_POST['student'];
    $date = $_POST['date'];
    $days = $_POST['days'];

    $query = "UPDATE lendingbooks SET code='$code', book='$book', student='$student', date= '$date', days='$days' WHERE id=$id";
    $res = mysqli_query($connect, $query);
    if ($res == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Lending updated successfully!",
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
                    text: "Lending updated Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>

</html>