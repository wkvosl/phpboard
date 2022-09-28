

<?php 
    include 'DB.php';
    
    $id = $_GET['no'];
    $sql = "select * from board where bid=".$id;

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    //var_dump($row['usertype']);
    //var_dump(explode(",", $arr_usertype));
    
    
    
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
		<form action="actionPHP/newWrite_Action.php" method="post"
			name="newWrite_form">
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
				
					<?php 
					   $arr_usertype = explode(",", $row['usertype']);
					   
					   $checked ='';
					   for ($i = 0; $i < count($arr_usertype); $i++) {
					       
					       if($arr_usertype[$i]=="호스팅"){
					           $checked ='checked';
					          echo '<input type="checkbox" name="usertype[]" id="check_1" value="호스팅" '.$checked.'>';
					          echo '<label for="check_1" >호스팅</label>';
					       }
					       
					       if($arr_usertype[$i]=="유지보수"){
					           $checked ='checked';
					          echo '<input type="checkbox" name="usertype[]" id="check_1" value="유지보수" '.$checked.'>';
					          echo '<label for="check_1" >호스팅</label>';
					       }
					       if($arr_usertype[$i]=="서버임대"){
					           $checked ='checked';
					          echo '<input type="checkbox" name="usertype[]" id="check_1" value="서버임대" '.$checked.'>';
					          echo '<label for="check_1" >호스팅</label>';
					       }
					       if($arr_usertype[$i]=="기타"){
					           $checked ='checked';
					          echo '<input type="checkbox" name="usertype[]" id="check_1" value="기타" '.$checked.'>';
					          echo '<label for="check_1" >호스팅</label>';
					       }
					   }
					   
					?>
				</td>
			</tr>
			<tr>
				<th>제목(필수)</th>
				<td id="newWriteTable_td">
					<input id="newWriteTable_input_title" name="title" required>
				</td>
			</tr>
			<tr>
				<th>내용(필수)</th>
				<td id="newWriteTable_td">
					<textarea name="content" rows="10" cols="" required></textarea>
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
				<input id="btn_size" type="submit" value="저장" onclick="return check_radio()">
				<input id="btn_size" type="button" value="취소" onclick="location.replace('./list.php')">
			</div>
		</form>
	
	</div>

</body>
</html>