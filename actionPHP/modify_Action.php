
<?php

include '../DB.php';
include '../file.php';


//DB 칼럼을 나눔... 
// $usertype_arr =  $_POST[ "usertype" ] ;
// $implode_usertype = implode( ", ", $usertype_arr );

// echo $usertype_arr;
// echo $implode_usertype;
// file_put_contents('data/'.$_POST['title']);


 $filter_modify = array(
     'bid' => mysqli_real_escape_string($conn, $_POST['bid']),
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
 
 $sql="update board set username ='".$filter_modify['username']."', title ='".$filter_modify['title'].
 "', boardtype='".$filter_modify['boardtype']."', boardcategory='".$filter_modify['boardcategory'].
 "', usertype1='".$filter_modify['usertype1']."', usertype2='".$filter_modify['usertype2']."', usertype3='".$filter_modify['usertype3'].
 "', usertype4='".$filter_modify['usertype4']."', content='".$filter_modify['content']."', realfilename='".$filter_modify['realfilename'].
 "'  where bid=".$filter_modify['bid'];

 

 $result = mysqli_query($conn, $sql);

 if($result==false){
     echo  '저장 중 에러발생, 저장되지 않았습니다.';
     error_log(mysqli_error($conn));
 }else{
//      echo '<script>confirm("수정하시겠습니까");</script>';
     echo header("Location: ../detail.php?no=".$filter_modify['bid']);
 }
 
 mysqli_close($conn);
?>