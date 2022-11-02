<!-- echo sys_get_temp_dir(); -->
<?php
    if(isset($_FILES)){
         $error = $_FILES['realfilename']['error'];
         $name = $_FILES['realfilename']['name'];
         $type = $_FILES['realfilename']['type'];
         $size = $_FILES['realfilename']['size'];
         $temp_name = $_FILES['realfilename']['tmp_name'];
    }
    
    
    if(!empty($name)){
        
        $allowed_ext=array('jpg','jpeg','jpe','png','bmp', 'gif');
        $ext = explode(".", $name);
        $ext = array_pop($ext);
        
        if(!in_array($ext, $allowed_ext)){
            echo "<script> alert('허용되지 않은 확장자');</script>";
            echo "<script> history.go(-1);</script>";
//             header('location:'.$_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    
    
        $upload_dir = $_SERVER['DOCUMENT_ROOT'].'/s_v2/uploadFile/';
        $upload_file = $upload_dir.basename($name);
        $randnum = rand(00000,99999);
        if($name==''){
            $nameplus = null;
        }
        else{
        $nameplus = $randnum.''.date('YmdH')."_".$name;
        }
        

    
    if($error != UPLOAD_ERR_OK){
        switch ($error){
            case UPLOAD_ERR_INI_SIZE : echo 'ini_size에러'; break;
            case UPLOAD_ERR_FORM_SIZE : echo '파일이 너무 큽니다'; break;
        }
    }

    $upload_file = $upload_dir.basename($nameplus);
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
