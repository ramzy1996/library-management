<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>
<?php
if (isset($_GET['lenid'])) {
    $del_id = $_GET['lenid'];
    $sql = "delete from lendingbooks where id='$del_id'";
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
    <title>Lending</title>
</head>

<body>

    <div class="container body">


        <div class="row">
            <div class="col-md-12 main-datatable">
                <div class="card_body">
                    <div class="row d-flex">
                        <div class="col-sm-4 createSegment">
                            <a class="btn dim_button create_new" href="lendingbooks.php"> <i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
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
                                    <th scope="col">ID</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Student</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Free lending period</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM lendingbooks ";
                                $res = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $code = $row['code'];
                                    $book = $row['book'];
                                    $student = $row['student'];
                                    $date = $row['date'];
                                    $days = $row['days'];
                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $code ?></td>
                                        <td><?php echo $book ?></td>
                                        <td><?php echo $student ?></td>
                                        <td><?php echo $date ?></td>
                                        <td><?php echo $days ?></td>
                                        <td>
                                            <a href="lendingupdate.php?lenuid=<?php echo $id; ?>" class="btn btn-primary"><i class="far fa-edit"></i>
                                            </a>
                                            <a href="showlending.php?lenid=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
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
                "aTargets": [6],
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