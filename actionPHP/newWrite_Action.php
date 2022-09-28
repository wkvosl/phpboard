<?php

include '../DB.php';



$usertype_arr =  $_POST[ "usertype" ] ;
$implode_usertype = implode( ", ", $usertype_arr );

// echo $usertype_arr;
// echo $implode_usertype;
// file_put_contents('data/'.$_POST['title']);


 $filter_newWrite = array(
     'username' => mysqli_real_escape_string($conn, $_POST['username']),
     'title' => mysqli_real_escape_string($conn, $_POST['title']),
     'boardtype' => mysqli_real_escape_string($conn, $_POST['boardtype']),
     'boardcategory' => mysqli_real_escape_string($conn, $_POST['boardcategory']),
     'usertype' => mysqli_real_escape_string($conn, $implode_usertype),
     'content' => mysqli_real_escape_string($conn, $_POST['content']),
     'realfilename' => mysqli_real_escape_string($conn, $_POST['realfilename'])
 );

 $sql="insert into board (username, title, boardtype, boardcategory, usertype, content, writedate, realfilename)
 values ('{$filter_newWrite['username']}','{$filter_newWrite['title']}',
 '{$filter_newWrite['boardtype']}','{$filter_newWrite['boardcategory']}',
 '{$filter_newWrite['usertype']}','{$filter_newWrite['content']}',now(),
 '{$filter_newWrite['realfilename']}')";
  
 $result = mysqli_query($conn, $sql);

 if($result==false){
     echo  '저장 중 에러발생, 저장되지 않았습니다.';
     error_log(mysqli_error($conn));
 }else{
     header("Location: ../list.php");
 }

?>
