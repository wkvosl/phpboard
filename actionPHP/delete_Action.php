<?php

include '../DB.php';
$id = $_GET['no'];
?>



<?php 
    $sql = "delete from board where bid=".$id;
    
    $result = mysqli_query($conn, $sql);
    
    if($result == false){
        echo '문제가 생겨 삭제하지 못했습니다.';
    }
    else {
        echo header("Location:../list.php");
    }
?>

<?php 
    mysqli_close($conn);
?>