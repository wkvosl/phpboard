

<?php 
    include 'DB.php';
    
    $id = $_GET['no'];
    $sql = "select * from board where bid=".$id;

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
<script src="js/js.js"></script>
</head>
<body>

	<h1>등록</h1>
	<hr>
	
	<div id="all_body_div">
		<form action="actionPHP/modify_Action.php" method="post"
			name="newWrite_form">
			<input type="hidden" name="bid" value="<?=$_GET['no']?>">
		<table id="newWriteTable">
			<tr>
				<th>구분(필수)</th>
				<td id="newWriteTable_td">
					<select name="boardtype" required>
						<option value="유지보수" <?=$row['boardtype']=="유지보수"?"checked":""?>>유지보수</option>
						<option value="문의사항" <?=$row['boardtype']=="문의사항"?"checked":""?>>문의사항</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>작성자(필수)</th>
				<td id="newWriteTable_td">
					<input name="username" value="<?=$row['username']?>">
				</td>
			</tr>
			<tr>
				<th>분류(필수)</th>
				<td id="newWriteTable_td">
					<input type="radio" name="boardcategory" id="radio_1" value="홈페이지"
					       <?=$row['boardcategory']=="홈페이지"?"checked":""?>>
					<label for="radio_1">홈페이지</label>
					
					<input type="radio" name="boardcategory" id="radio_2" value="네트워크"
							<?=$row['boardcategory']=="네트워크"?"checked":""?>>
					<label for="radio_2">네트워크</label>
					
					<input type="radio" name="boardcategory" id="radio_3" value="서버"
							<?=$row['boardcategory']=="서버"?"checked":""?>>
					<label for="radio_3">서버</label>
				</td>
			</tr>
			<tr>
			<th>고객유형</th>
					<td id="newWriteTable_td">
    					<input type="checkbox" name="usertype1" id="check_1" value="호스팅" <?=$row["usertype1"]=="호스팅"?"checked":""?>>
    					<label for="check_1" >호스팅</label>
    					
    					<input type="checkbox" name="usertype2" id="check_2" value="유지보수" <?=$row["usertype2"]=="유지보수"?"checked":""?>>
    					<label for="check_2" >유지보수</label>
    					
    					<input type="checkbox" name="usertype3" id="check_3" value="서버임대" <?=$row["usertype3"]=="서버임대"?"checked":""?>>
    					<label for="check_3" >서버 임대</label>
    					
    					<input type="checkbox" name="usertype4" id="check_4" value="기타" <?=$row["usertype4"]=="기타"?"checked":""?>>
    					<label for="check_4" >기타</label>
				</td>
			</tr>
			<tr>
				<th>제목(필수)</th>
				<td id="newWriteTable_td">
					<input id="newWriteTable_input_title" name="title" value="<?=$row["title"]?>" required>
				</td>
			</tr>
			<tr>
				<th>내용(필수)</th>
				<td id="newWriteTable_td">
					<textarea name="content" rows="10" cols="" required><?=$row["content"]?></textarea>
				</td>
			</tr>
			<tr>
				<th>첨부파일</th>
				<td id="newWriteTable_td">
					<input name="realfilename">
					<button>찾아보기</button> //미구현, 나중에 하기
				</td>
			</tr>
		</table>
		
			<div id="newWrite_button_div">
				<input id="btn_size" type="submit" value="저장" onclick="return check_radio(); ">
				<input id="btn_size" type="button" value="취소" onclick="location.replace('./list.php')">
			</div>
		</form>
	
	</div>

</body>
</html>

<?php 
    mysqli_close($conn);
?>