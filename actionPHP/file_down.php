<?php
include '../DB.php';

$id = mysqli_real_escape_string($conn, $_GET['no']);
$sql = 'select * from board where bid = '.$id;

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$filename = basename($row['realfilename']);
//$filename = urldecode($filename);

// $filePath = $_SERVER['DOCUMENT_ROOT']."/uploadFile/".$filename;
$filePath = '../uploadFile/'.$filename;

if(!file_exists($filePath) ) {
    echo "파일이 없습니다.";
    exit;
}

if(is_file($filePath)){  //파일명
    $filesize = filesize($filePath);  
}

    ob_clean();
    $name = urlencode($filename);
    
if(file_exists($filePath)){
    header("Content-Type:application/octet-stream");
    header("Content-Disposition:attachment;filename=".$name);
    header("Content-Transfer-Encoding:binary");
    header("Content-Length:".$filesize);
    header("Cache-Control:cache,must-revalidate");
    header("Pragma:no-cache");
    header('Expires:0');
}
    flush();  //출력 버퍼에 쌓여있는 내용을 곧바로 전송
    readfile($filePath);

// $fp = fopen($filePath, "rb");
//     fpassthru($fp);
//     fclose($fp);

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