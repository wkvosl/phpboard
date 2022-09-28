

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
						<option value="" >선택해주세요</option>
						<option value="유지보수">유지보수</option>
						<option value="문의사항">문의사항</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>작성자(필수)</th>
				<td id="newWriteTable_td">
					<input name="username" required>
				</td>
			</tr>
			<tr>
				<th>분류(필수)</th>
				<td id="newWriteTable_td">
					<input type="radio" name="boardcategory" id="radio_1" value="홈페이지">
					<label for="radio_1">홈페이지</label>
					
					<input type="radio" name="boardcategory" id="radio_2" value="네트워크">
					<label for="radio_2">네트워크</label>
					
					<input type="radio" name="boardcategory" id="radio_3" value="서버">
					<label for="radio_3">서버</label>
				</td>
			</tr>
			<tr>
				<th>고객유형</th>
				<td id="newWriteTable_td">
					<input type="checkbox" name="usertype[]" id="check_1" value="호스팅">
					<label for="check_1" >호스팅</label>
					
					<input type="checkbox" name="usertype[]" id="check_2" value="유지보수">
					<label for="check_2" >유지보수</label>
					
					<input type="checkbox" name="usertype[]" id="check_3" value="서버임대">
					<label for="check_3" >서버 임대</label>
					
					<input type="checkbox" name="usertype[]" id="check_4" value="기타">
					<label for="check_4" >기타</label>
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