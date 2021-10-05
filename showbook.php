<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>
<?php
if (isset($_GET['dbid'])) {
    $del_id = $_GET['dbid'];
    $sql = "delete from books where id='$del_id'";
    $res = mysqli_query($connect, $sql);
    if ($res == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Deleted success!",
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
    <title>Show Books</title>
</head>

<body>
    <div class="container body">
        <div class="row">
            <div class="col-md-12 main-datatable">
                <div class="card_body">
                    <div class="row d-flex">
                        <div class="col-sm-4 createSegment">
                            <a class="btn dim_button create_new" href="addbooks.php"> <i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
                        </div>
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
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Publisher</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM books ";
                                $res = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $image = $row['image'];
                                    $bookname = $row['bookname'];
                                    $category = $row['category'];
                                    $publisher = $row['publisher'];
                                    $year = $row['year'];
                                    $isbn = $row['isbn'];
                                    $date = $row['date'];
                                    $status = $row['status'];
                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <?php if (!empty($image)) : ?>
                                            <td><img src="images/<?php echo $image ?>" height="70px" width="70px" style="border-radius: 50%;"></td>
                                        <?php else : ?>
                                            <td><img src="images/books.jpg" height="70px" width="70px" style="border-radius: 50%;"></td>
                                        <?php endif ?>
                                        <td><?php echo $bookname ?></td>
                                        <td><?php echo $category ?></td>
                                        <td><?php echo $publisher ?></td>
                                        <td><?php echo $year ?></td>
                                        <td><?php echo $isbn ?></td>
                                        <td><?php echo $date ?></td>
                                        <td><?php echo $status ?></td>

                                        <td>
                                            <a href="bookupdate.php?ubid=<?php echo $id; ?>" class="btn btn-primary"><i class="far fa-edit"></i>
                                            </a>
                                            <a href="showbook.php?dbid=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                            </a>
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
</body>
<script>
    $(document).ready(function() {
        var dataTable = $('#filtertable').DataTable({
            "pageLength": 6,
            aoColumnDefs: [{
                "aTargets": [9],
                "bSortable": false
            }],
            "dom": '<"top">ct<"top"p><"clear">'
        });
        $("#filterbox").keyup(function() {
            dataTable.search(this.value).draw();
        });
    });
</script>


</html>