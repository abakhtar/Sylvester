<?php
$connection = mysqli_connect('localhost', 'root', 'abcd123');
if (!$connection){
    die("Connection to database failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'test');
if (!$select_db){
    die("Database selection failed" . mysqli_error($connection));
}
