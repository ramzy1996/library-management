<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>

<?php
if (isset($_POST["submit"])) {

    $bookname = $_POST['bookname'];
    $category = $_POST['category'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];



    $query = "INSERT INTO books (bookname,category,publisher,year,isbn,date,status,image) VALUES('$bookname', '$category', '$publisher', '$year', '$isbn','$date', '$status','$image')";
    $res = mysqli_query($connect, $query);

    if ($res) {
        move_uploaded_file($tmp_name, "images/$image");
        echo '
        <script type="text/javascript">
        $(document).ready(function(){
            swal({
                title: "Success!",
                text: "Book added successfully!",
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
                text: "Book added failed!",
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
    <title>Add Books</title>
</head>

<body>

    <?php
    date_default_timezone_set("Asia/Colombo")
    ?>

    <div class="container body">
        <h2 class="text-center">Add Books</h2>
        <br><br>
        <div class="text-center">
            <img id="profilePicture" style="width:150px;height:150px; object-fit:cover;border-radius: 15px;" src="images/books.jpg">
        </div>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bookname" class="form-label">Book Name</label>
                        <input type="text" name="bookname" id="bookname" class="form-control" placeholder="Enter book Name">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="" selected disabled>--Select Category--</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Business">Business</option>
                            <option value="Science fiction">Science fiction</option>
                            <option value="Geological">Geological</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Periodical">Periodical</option>
                            <option value="Novels">Novels</option>
                            <option value="General">General</option>
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
                        <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Enter publisher name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" name="year" id="year" class="form-control" placeholder="Enter year">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN No</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Enter ISBN number">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input name="date" id="date" class="form-control" value="<?php echo date("y-m-d")   ?>" placeholder="Enter date" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Available">Available</option>
                            <option value="UnAvailable">UnAvailable</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">AddBook</button>
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
                category: {
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
                category: 'Please enter book name.',
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

</html>