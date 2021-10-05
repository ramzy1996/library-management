<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>
<?php
if (isset($_GET['retid'])) {
    $del_id = $_GET['retid'];
    $sql = "delete from returnbooks where id='$del_id'";
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
    <title>Return</title>

</head>

<body>
    <div class="container body">

        <div class="row">
            <div class="col-md-12 main-datatable">
                <div class="card_body">
                    <div class="row d-flex">
                        <div class="col-sm-4 createSegment">
                            <a class="btn dim_button create_new" href="returnbooks.php"> <i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
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
                                    <th scope="col">Lended ID</th>
                                    <th scope="col">Return Date</th>
                                    <th scope="col">Lended Date</th>
                                    <th scope="col">Free lending period</th>
                                    <th scope="col">Aditional Days</th>
                                    <th scope="col">Fine Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM returnbooks ";
                                $res = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $lendingid = $row['lendingid'];
                                    $returndate = $row['returndate'];
                                    $lendingdate = $row['lendingdate'];
                                    $freedays = $row['freedays'];
                                    $addays = $row['addays'];
                                    $amount = $row['amount'];
                                    $query1 = "SELECT * FROM lendingbooks where id='$lendingid'";
                                    $res1 = mysqli_query($connect, $query1);
                                    $row1 = mysqli_fetch_assoc($res1);
                                    $lencode = $row1['code'];
                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $lencode ?></td>
                                        <td><?php echo $returndate ?></td>
                                        <td><?php echo $lendingdate ?></td>
                                        <td><?php echo $freedays ?></td>
                                        <td><?php echo $addays ?></td>
                                        <td><?php echo $amount ?></td>
                                        <td>
                                            <a href="returnbookupdate.php?retuid=<?php echo $id; ?>" class="btn btn-primary"><i class="far fa-edit"></i>
                                            </a>
                                            <a href="showreturn.php?retid=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
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

</html>