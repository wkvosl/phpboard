<!-- echo sys_get_temp_dir(); -->
<?php


    if(isset($_FILES)){
         $error = $_FILES['realfilename']['error'];
         $name = $_FILES['realfilename']['name'];
         $temp_name = $_FILES['realfilename']['tmp_name'];
         $size = $_FILES['realfilename']['size'];
    }
    
    $filesize = $_POST['filesize'];
    
    $filesizeM = floor($filesize / 1024 / 1024)."MB" ;
    $sizeM = floor($size / 1024 / 1024 )."MB" ;
    
    
    if(!empty($name)){
//      코드 미포함 powerpoint 확장자
        $allowed_ext=array('jpg','jpeg','jpe','png','bmp','gif','csv','xls','xlsx','pptx','ppt','pdf');
        $ext = explode(".", $name);
        $ext = array_pop($ext);
        
        if(!in_array($ext, $allowed_ext)){
            echo "<script> alert('허용되지 않은 확장자');</script>";
            echo "<script> history.go(-1);</script>";
//             header('location:'.$_SERVER['HTTP_REFERER']);
            exit;
        }
        
        if($size > $filesize){
            echo "<script>alert('용량 초과 입니다. 제한용량 $filesizeM, 넘어온 용량 $sizeM');</script>";
            echo "<script>history.go(-1);</script>";
            exit;
        }
    }
        
        $upload_dir = $_SERVER['DOCUMENT_ROOT'].'/s_v2/uploadFile/';
        $upload_file = $upload_dir.basename($name);
        $randnum = rand(1111,9999);
        if($name==''){
            $nameplus = null;
        }
        else{
        $nameplus = $randnum.''.date('ymdH')."_".$name;
        }


    $upload_file = $upload_dir.$nameplus;
    move_uploaded_file($temp_name, $upload_file);

?>