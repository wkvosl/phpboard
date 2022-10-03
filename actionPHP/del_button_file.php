<?php
include '../DB.php';

$id = $_GET['no'];

$sql = 'update board set realfilename = NULL where bid ='.mysqli_real_escape_string($conn, $id);


$result = mysqli_query($conn, $sql);

header("Location:../modify.php?no=".$id);

mysqli_close($conn);

?>

