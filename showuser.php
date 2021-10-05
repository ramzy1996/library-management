<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>
<?php
if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $sql = "delete from users where id='$del_id'";
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
    <title>Users</title>

</head>

<body>
    <div class="container body">
        <div class="row">
            <div class="col-md-12 main-datatable">
                <div class="card_body">
                    <div class="row d-flex">
                        <div class="col-sm-4 createSegment">
                            <a class="btn dim_button create_new" href="register.php"> <i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
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
                                    <th scope="col">Profile</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM users ";
                                $res = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $profile = $row['profile'];
                                    $first_name = $row['first_name'];
                                    $last_name = $row['last_name'];
                                    $email = $row['email'];
                                    $mobile = $row['mobile'];
                                    $role = $row['role'];
                                ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <?php if (!empty($profile)) : ?>
                                            <td><img src="images/<?php echo $profile ?>" height="70px" width="70px" style="border-radius: 50%;"></td>
                                        <?php else : ?>
                                            <td><img src="images/admin.png" height="70px" width="70px" style="border-radius: 50%;"></td>
                                        <?php endif ?>
                                        <td><?php echo $first_name ?></td>
                                        <td><?php echo $last_name ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $mobile ?></td>
                                        <td><?php echo $role ?></td>
                                        <td>
                                            <a href="update.php?updateid=<?php echo $id; ?>" class="btn btn-primary"><i class="far fa-edit"></i>
                                            </a>
                                            <?php if ($_SESSION['Librarian'] != $email) : ?>
                                                <a href="showuser.php?del=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                                </a>
                                            <?php endif ?>
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