

<?php

    include 'DB.php';

    session_start();
    
    $id = $_GET['no'];
    $sql="select * from board where bid=".mysqli_real_escape_string($conn, $id);
    
     $result = mysqli_query($conn, $sql);
        
     $row = mysqli_fetch_array($result);
     
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="css/all.css">
<link rel="stylesheet" type="text/css" href="css/newWrite.css">

    <script>
        function del(){
        	if (confirm("정말 삭제하시겠습니까??") == true){    
        		location.replace('actionPHP/delete_Action.php?no=<?=$row['bid']?>');
        		  return true;
        	}else{  
        		alert('취소하였습니다.');
        	    return false;
        	}
        		
        }
    </script>
    
</head>
<body>

	<h1>조회</h1>
	<hr>
	
	<div id="all_body_div">
		<table id="newWriteTable">
			<tr>
				<th>구분(필수)</th>
				<td id="newWriteTable_td">
					<?=$row['boardtype']; ?>
				</td>
			</tr>
			<tr>
				<th>작성자(필수)</th>
				<td id="newWriteTable_td">
					<?=$row['username']; ?>
				</td>
			</tr>
			<tr>
				<th>분류(필수)</th>
				<td id="newWriteTable_td">
					<?=$row['boardcategory']; ?>
				</td>
			</tr>
			<tr>
				<th>고객유형</th>
				<td id="newWriteTable_td">
				<?php 
				$usertype1 = empty($row['usertype1'])?"":$row['usertype1'];
				$usertype2 = empty($row['usertype2'])?"":$row['usertype2'];
				$usertype3 = empty($row['usertype3'])?"":$row['usertype3'];
				$usertype4 = empty($row['usertype4'])?"":$row['usertype4'];
				
				$usertype_arr =  array($usertype1, $usertype2, $usertype3, $usertype4) ;
				
				$arr_filter = array_filter($usertype_arr);
				$comma_arr = implode(", ", $arr_filter);
				echo $comma_arr;

				?>
				
				</td> 
			</tr>
			<tr>
				<th>제목(필수)</th>
				<td id="newWriteTable_td">
					<?=$row['title']; ?>
				</td>
			</tr>
			<tr>
				<th>내용(필수)</th>
				<td id="newWriteTable_td" >
					<p class="textArea_tag_value"><?=$row['content']; ?></p>
				</td>
			</tr>
			<tr>
				<th>첨부파일</th>
				<td id="newWriteTable_td">
					<?=$row['realfilename']; ?>
					<button>다운로드</button> //미구현, 나중에 하기
				</td>
			</tr>
		</table>
		
			<div id="newWrite_button_div">
				<input id="btn_size" type="button" value="수정" onclick="location.replace('modify.php?no=<?=$row['bid']?>');">
				<input id="btn_size" type="button" value="삭제" onclick="return del();">
				<input id="btn_size" type="button" value="목록" onclick="location.replace('./list.php')">
			</div>
	
	</div>

</body>
</html>

<?php 


    $sql = "update board set hit=".mysqli_real_escape_string($conn, $row['hit'])."+1 where bid=".mysqli_real_escape_string($conn, $row['bid']);
    if ($_SESSION['name'] != null){
    $result = mysqli_query($conn, $sql);
   
    $_SESSION['name']='user';
}

?>

<?php 
    mysqli_close($conn);
?>