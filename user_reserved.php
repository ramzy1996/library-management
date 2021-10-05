<?php
include('./header.php');
include('./restrict.php');
include('./connection.php');
include('./links.php');

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
    <title>Users</title>
</head>

<body>
    <div class="container p-30 body">
        <div>
            <h2 class="text-center">Student Reserved Book Details</h2>
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
                                        <th>User Name</th>
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
                                    $sql = "select * from reservation";
                                    $res = mysqli_query($connect, $sql);


                                    while ($row = mysqli_fetch_array($res)) {

                                        $id = $row['id'];
                                        $date = $row['date'];
                                        $user = $row['UID'];
                                        $book = $row['BID'];
                                        $status = $row['status'];

                                        // user
                                        $sqlusr = "select * from users where id='$user'";
                                        $resusr = mysqli_query($connect, $sqlusr);
                                        $rowusr = mysqli_fetch_array($resusr);
                                        $usrname = $rowusr['first_name'];
                                        $usrlname = $rowusr['last_name'];


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
                                            <td><?php echo $usrname . " " . $usrlname ?></td>
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
                                                    <a href="accept_reservation.php?accept=<?php echo $id; ?>" class="btn btn-success"><i class="fas fa-check"></i>
                                                    </a>
                                                    <a href="user_reserved.php?cancel=<?php echo $id; ?>" onclick="return confirm('Are you sure to cancel?')" class="btn btn-danger"><i class="fas fa-times"></i>
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
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var dataTable = $('#filtertable').DataTable({
                "pageLength": 6,
                aoColumnDefs: [{
                    "aTargets": [7],
                    "bSortable": false
                }],
                "dom": '<"top">ct<"top"p><"clear">'
            });
            $("#filterbox").keyup(function() {
                dataTable.search(this.value).draw();
            });
        });
    </script>
</body>

</html>