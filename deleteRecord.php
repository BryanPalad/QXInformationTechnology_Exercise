<?php
include_once './app/config.php';

$id = $_POST['id'];

$delete = mysqli_query($conn,"DELETE FROM applicant_table WHERE id=$id");

?>

