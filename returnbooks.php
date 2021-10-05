<?php
include('./header.php');
include('./links.php');
include('./connection.php');
include('./restrict.php');
?>

<?php
if (isset($_POST["returnbooks"])) {

    $lendingid = $_POST['lendingid'];
    $returndate = $_POST['returndate'];
    $lendingdate = $_POST['lendingdate'];
    $freedays = $_POST['freedays'];
    $addays = $_POST['addays'];
    $amount = $_POST['amount'];


    $query = "INSERT INTO returnbooks(lendingid,returndate,lendingdate,freedays,addays,amount) VALUES('$lendingid', '$returndate', '$lendingdate', '$freedays', '$addays', '$amount')";
    $res = mysqli_query($connect, $query);

    if ($res == true) {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Return book added successfully!",
                    icon: "success",
                    buttons: false,
                    timer: 1500,
                  }).then(function() {
                    window.location = "showreturn.php";
                });
            });
            </script>';
    } else {
        echo '
            <script type="text/javascript">
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Return book Failed!",
                    icon: "error",
                  });
            });
            </script>';
    }
}
?>

<?php
function fill_returnbooks($connect)
{
    $output = '';
    $query = "SELECT * FROM lendingbooks";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<option value="' . $row["id"] . '">' . $row["code"] . '</option>';
    }
    return $output;
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
    <title>Return Books</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="col-md-12">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 shadow-sm" style="margin-top: 100px;">
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <h3 class="text-center my-3">Book Return Register</h3>
                        <div class="row">
                            <label>Select lending code</label>
                            <select class="form-control" name="lendingid" id="lendingid">
                                <option disabled selected>Select lending code</option>
                                <?php echo fill_returnbooks($connect); ?>
                            </select>
                        </div>

                        <div class="row">
                            <label>Return Date</label>
                            <input name="returndate" id="date2" value="<?php echo date("Y-m-d"); ?>" class="form-control my-2" placeholder="Enter date" autocomplete="off" readonly>
                        </div>

                        <div class="row">
                            <label>Lended Date</label>
                            <input id="date" name="lendingdate" class="form-control my-2" readonly>
                        </div>


                        <div class="row">
                            <label>Free lending period</label>
                            <input id="days" name="freedays" class="form-control my-2" readonly>

                            <label>Aditional days</label>
                            <input type="text" name="addays" id="addition" class="form-control my-2" placeholder="Enter aditional amount" readonly>


                            <label>Amount</label>
                            <input type="text" name="amount" id="addAmount" class="form-control my-2" placeholder="Enter fine amount" readonly>



                            <div class="col-md-6">
                                <input type="submit" name="returnbooks" class="btn btn-primary btn-block" value="Add">
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-success btn-block" href="showreturn.php">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="" style="margin-top: 30px;"></div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#lendingid').select2();
    });
</script>
<style>
    .error {
        color: red;
    }
</style>

<script>
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                lendingid: {
                    required: true
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    $('#lendingid').change(function() {
        var id = $(this).find(":selected").val();
        var dataString = 'lid=' + id;
        $.ajax({
            url: "loaddate.php",
            dataType: "json",
            data: dataString,
            cache: false,
            success: function(data) {
                var lendingDate = $('#date').val(data.date);
                var days = $('#days').val(data.days);
                var returnDate = $('#date2').val();

                $("#lendingid").blur();
            }
        });
    });
    $('#lendingid').blur(function() {
        var lendingDate = $('#date').val();
        var returnDate = $('#date2').val();
        var days = $('#days').val();

        var startDay = new Date(returnDate);
        var endDay = new Date(lendingDate);

        var millisBetween = startDay.getTime() - endDay.getTime();
        var Getdays = Math.round(Math.abs(millisBetween / (1000 * 3600 * 24))) - days;
        if (Getdays < 0) {
            $('#addition').val(0);
            $('#addAmount').val(0);

        } else {
            $('#addition').val(Getdays);
            $('#addAmount').val(Getdays * 50);
        }
    });
</script>