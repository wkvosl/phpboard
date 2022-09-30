<?php
include 'DB.php';

$upload_dir="uploadFile";
$allowed_ext=array('jpg','jpeg','jpe','png','bmp','gif');

    $error = $_FILES['realfilename']['error'];
     $name = $_FILES['realfilename']['name'];
     
     //$ext = array_pop(explode('.',$name));  //에러나서 밑에 2줄로 바꿈
     $ext = explode('.',$name);
     $ext = strtolower(array_pop($ext));

    if($error != UPLOAD_ERR_OK){
        switch ($error){
            case UPLOAD_ERR_INI_SIZE :
            case UPLOAD_ERR_FORM_SIZE : echo '파일이 너무 큽니다'; break;
            case UPLOAD_ERR_NO_FILE_SIZE : echo '파일이 없습니다';break;
        }
    }

    if(!in_array($ext, $allowed_ext)){
        echo '허용되지 않은 확장자';
    }

   // move_uploaded_file(['realfilename']['tmp_name'], $upload_dir/$name);
    move_uploaded_file($name, $upload_dir.$name);
    
    echo "<h2> 파일명정보 </h2>
           <ul>
            <li>파일명: $name </li>
            <li>확장자: $ext</li>
            <li>파일형식: {$_FILES['realfilename']['type']} </li>
            <li>파일크기: {$_FILES['realfilename']['size']} </li>
            </ul>
          ";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<!-- <script src="js/js.js"></script> -->
</head>
<body>
<!--  <input type="file" name="realfilename" accept="image/*" onchange="setPreview(event);"> -->
<!--  <div id="imgPreview"></div> -->
</body>
</html>