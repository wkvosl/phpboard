<?php


if(isset($_FILES)){
    $error = $_FILES['realfilename']['error'];
    $name = $_FILES['realfilename']['name'];
    $temp_name = $_FILES['realfilename']['tmp_name'];
    $size = $_FILES['realfilename']['size'];
    
}


$filesize = $_POST['filesize']; 

    if($size > $filesize ){
        echo "<script>alert('용량 초과 입니다. 제한용량 $filesize, 넘어온 용량 $size');</script>";
        echo "<script> history.go(-1);</script>";
        exit;
    }
    
    
    echo "<h2> 파일명정보 </h2>
           <ul>
            <li>에러: $error</li>
            <li>파일명: $name </li>
            <li>파일크기: $size </li>
            </ul>
          ";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>

</body>
</html>