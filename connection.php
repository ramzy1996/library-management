<?php

$connect = mysqli_connect("localhost", "root", "","login_sample");

if (mysqli_connect_errno()) {
    echo 'Failed to connect ' . mysqli_connect_error();
}
