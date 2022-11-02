<?php

require_once '../DB.php';

$id = mysqli_real_escape_string($conn, $_GET['no']);

$sql="select * from board where bid = ".$id;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$name = $row['realfilename'];

$upload_file = $_SERVER['DOCUMENT_ROOT'].'/s/uploadFile/'.$name;

?>


<?php 
    $sql = "delete from board where bid=".$id;
    
    $result = mysqli_query($conn, $sql);
    
    if($result == false){
        echo '문제가 생겨 삭제하지 못했습니다.';
    }
    else {
        unlink($upload_file);
        echo header("Location:../list.php");
    }
?>

<?php 
    mysqli_close($conn);
?>