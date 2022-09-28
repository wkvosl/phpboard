
<?php
    include 'DB.php';
    
    $id = $_GET['no'];
    $sql="select * from board where bid=".$id;
    
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
</head>
<body>

	<h1>등록</h1>
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
					<?=$row['usertype']; ?>
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
				<input id="btn_size" type="button" value="수정" onclick="location.replace('modify.php?no=<?=$row['bid']?>')">
				<input id="btn_size" type="button" value="삭제">
				<input id="btn_size" type="button" value="목록" onclick="location.replace('./list.php')">
			</div>
	
	</div>

</body>
</html>

<?php 
    mysqli_close($conn);
?>