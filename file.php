<!-- tempnam() //임시파일 생성 함수 -->
<!-- echo sys_get_temp_dir(); -->
<?php
// $_FILES의 배열 정리

if(isset($_FILES)){
     $error = $_FILES['realfilename']['error'];
     $name = $_FILES['realfilename']['name'];
     $type = $_FILES['realfilename']['type'];
     $size = $_FILES['realfilename']['size'];
     $temp_name = $_FILES['realfilename']['tmp_name'];
}
//$_SERVER['DOCUMENT_ROOT'];
//저장경로
$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/s/uploadFile/';
$upload_file = $upload_dir.basename($name);

//확장자
$allowed_ext=array('jpg','jpeg','jpe','png','bmp','gif');
    //$ext = array_pop(explode('.',$name));  //에러나서 밑에 2줄로 바꿈
    $ext = explode('.',$name);
    $ext = array_pop($ext);
    if(!in_array($ext, $allowed_ext)){
        echo '허용되지 않은 확장자';
    }

    if($error != UPLOAD_ERR_OK){
        switch ($error){
            case UPLOAD_ERR_INI_SIZE :
            case UPLOAD_ERR_FORM_SIZE : echo '파일이 너무 큽니다'; break;
            case UPLOAD_ERR_NO_FILE_SIZE : echo '파일이 없습니다';break;
        }
    }

    

    if (file_exists($upload_file)){
        $randnum = rand(00000,99999);
        $nameplus = $randnum.''.date('YmdH')."_".$name;
        if($name==''){
            $nameplus = null;
        }
        $upload_file = $upload_dir.basename($nameplus);
    }
        move_uploaded_file($temp_name, $upload_file);
    
//     echo "<h2> 파일명정보 </h2>
//            <ul>
//             <li>파일명: $name </li>
//             <li>확장자: $ext</li>
//             <li>파일형식: $type </li>
//             <li>파일크기: $size </li>
//             </ul>
//           ";
    
?>
