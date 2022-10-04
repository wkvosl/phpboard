<?php

include '../DB.php';
include '../file.php';

//DB 칼럼을 나눔... 
// $usertype_arr =  $_POST[ "usertype[]" ] ;
// $implode_usertype = implode( ", ", $usertype_arr );
// echo $usertype_arr;
// echo $implode_usertype;
// file_put_contents('data/'.$_POST['title']);

 $filter_newWrite = array(
     'username' => mysqli_real_escape_string($conn, $_POST['username']),
     'title' => mysqli_real_escape_string($conn, $_POST['title']),
     'boardtype' => mysqli_real_escape_string($conn, $_POST['boardtype']),
     'boardcategory' => mysqli_real_escape_string($conn, $_POST['boardcategory']),
     'usertype1' => mysqli_real_escape_string($conn, $_POST['usertype1']),
     'usertype2' => mysqli_real_escape_string($conn, $_POST['usertype2']),
     'usertype3' => mysqli_real_escape_string($conn, $_POST['usertype3']),
     'usertype4' => mysqli_real_escape_string($conn, $_POST['usertype4']),
     'content' => mysqli_real_escape_string($conn, $_POST['content']),
     'realfilename' => $name
 );

 $sql="insert into board (username, title, boardtype, boardcategory, usertype1,usertype2,usertype3,usertype4, content, writedate, realfilename)
 values ('{$filter_newWrite['username']}','{$filter_newWrite['title']}',
 '{$filter_newWrite['boardtype']}','{$filter_newWrite['boardcategory']}',
 '{$filter_newWrite['usertype1']}','{$filter_newWrite['usertype2']}','{$filter_newWrite['usertype3']}','{$filter_newWrite['usertype4']}',
 '{$filter_newWrite['content']}',now(),
 '{$filter_newWrite['realfilename']}')";
  
 $result = mysqli_query($conn, $sql);

 if($result==false){
     echo  '저장 중 에러발생, 저장되지 않았습니다.';
     error_log(mysqli_error($conn));
 }else{
     header("Location: ../list.php");
 }

?>

<?php 
    mysqli_close($conn);
?>