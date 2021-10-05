<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>

<?php
if (isset($_GET['ubid'])) {
    $id = $_GET['ubid'];
    $query = "SELECT * FROM books WHERE id=$id";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($res);

    $bookname = $row['bookname'];
    $category = $row['category'];
    $publisher = $row['publisher'];
    $year = $row['year'];
    $isbn = $row['isbn'];
    $date = $row['date'];
    $status = $row['status'];
    $image = $row['image'];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Books</title>
</head>

<body>
    <div class="container my-5 body">

        <h2 class="text-center">Update Books</h2>
        <br><br>
        <div class="text-center">
            <?php if (empty($image)) : ?>
                <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px;" src="images/books.png">
            <?php else : ?>
                <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px" src="images/<?php echo $image ?>">
            <?php endif ?>
        </div>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bookname" class="form-label">Book Name</label>
                        <input type="text" name="bookname" id="bookname" class="form-control" placeholder="Enter book Name" value=<?php echo $bookname; ?>>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select name="category" id="category" class="form-control my-2">
                            <option value="Information Technology" <?php if ($category == "Information Technology") echo "selected"; ?>>Information Technology</option>
                            <option value="Business" <?php if ($category == "Business") echo "selected"; ?>>Business</option>
                            <option value="Science fiction" <?php if ($category == "Science fiction") echo "selected"; ?>>Science fiction</option>
                            <option value="Geological" <?php if ($category == "Geological") echo "selected"; ?>>Geological</option>
                            <option value="Mathematics" <?php if ($category == "Mathematics") echo "selected"; ?>>Mathematics</option>
                            <option value="Periodical" <?php if ($category == "Periodical") echo "selected"; ?>>Periodical</option>
                            <option value="Novels" <?php if ($category == "Novels") echo "selected"; ?>>Novels</option>
                            <option value="General" <?php if ($category == "General") echo "selected"; ?>>General</option>
                        </select>
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
                        <label for="publisher" class="form-label">Publisher</label>
                        <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Enter publisher name" value="<?php echo $publisher; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" name="year" id="year" class="form-control" placeholder="Enter year" value=<?php echo $year; ?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN No</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Enter ISBN number" value=<?php echo $year; ?>>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input name="date" id="date" class="form-control my-2" placeholder="Enter date" autocomplete="off" value=<?php echo $date; ?> readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <select class="form-control my-2" id="status" name="status">
                            <option value="Available" <?php if ($status == "Available") echo "selected"; ?>>Available</option>
                            <option value="UnAvailable" <?php if ($status == "UnAvailable") echo "selected"; ?>>UnAvailable</option>
                        </select>
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
                    <a class="btn btn-success btn-block" href="showbook.php">Back</a>
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
                bookname: {
                    required: true
                },
                publisher: {
                    required: true
                },
                year: {
                    required: true,
                    rangelength: [4, 4],
                    number: true,
                },
                isbn: {
                    required: true,
                    rangelength: [4, 12],
                    number: true,
                },
            },
            messages: {
                bookname: 'Please enter book name.',
                publisher: 'Please enter publisher.',
                year: {
                    required: 'Please enter year.',
                    rangelength: 'year should be 4 digit number.',
                    number: 'Enter valid year'
                },
                isbn: {
                    required: 'Please enter isbn.',
                    rangelength: 'isbn should be 4 to 12 digit number.',
                    number: 'Enter valid isbn'
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
    $("#year").ForceNumericOnly();
    $("#isbn").ForceNumericOnly();
</script>
<?php
if (isset($_POST['submit'])) {

    $e_bookname = $_POST['bookname'];
    $e_category = $_POST['category'];
    $e_publisher = $_POST['publisher'];
    $e_year = $_POST['year'];
    $e_image = $_FILES['image']['name'];
    $e_tmp_name = $_FILES['image']['tmp_name'];
    $e_isbn = $_POST['isbn'];
    $e_date = $_POST['date'];
    $e_status = $_POST['status'];

    if (empty($e_image)) {
        $e_image = $image;
    }

    $sql = "update books set bookname='$e_bookname', category='$e_category', publisher= '$e_publisher', year='$e_year',image='$e_image', isbn='$e_isbn', date='$e_date', status='$e_status' WHERE id='$id'";
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
                    window.location = "showbook.php";
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