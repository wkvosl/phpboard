<?php
include '../DB.php';

$id = $_GET['no'];

$sql="select * from board where bid = ".mysqli_real_escape_string($conn, $id);
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$name = $row['realfilename'];

$upload_file = $_SERVER['DOCUMENT_ROOT'].'/s/uploadFile/'.$name;
unlink($upload_file);

$sql = 'update board set realfilename = NULL where bid='.mysqli_real_escape_string($conn, $id);
$result = mysqli_query($conn, $sql);
header("Location:../modify.php?no=".$id);
mysqli_close($conn);

?>

