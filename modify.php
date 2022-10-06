

<?php 
    include 'DB.php';
    
    $id = mysqli_real_escape_string($conn,$_GET['no']);
    $sql = "select * from board where bid=".$id;

    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_array($result)){
        $filter=array(
            'bid'=> htmlspecialchars($row['bid']),
            'username'=> htmlspecialchars($row['username']),
            'boardtype'=> htmlspecialchars($row['boardtype']),
            'title'=> htmlspecialchars($row['title']),
            'boardcategory'=> htmlspecialchars($row['boardcategory']),
            'content'=> htmlspecialchars($row['content']),
            'realfilename'=> htmlspecialchars($row['realfilename']),
            'writedate'=> htmlspecialchars($row['writedate']),
            'usertype1'=> htmlspecialchars($row['usertype1']),
            'usertype2'=> htmlspecialchars($row['usertype2']),
            'usertype3'=> htmlspecialchars($row['usertype3']),
            'usertype4'=> htmlspecialchars($row['usertype4']),
            'hit'=> htmlspecialchars($row['hit'])
        );
    }
    
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="css/all.css">
<link rel="stylesheet" type="text/css" href="css/newWrite.css">
    <script>
    function del_file(){
    	if (confirm("첨부파일을 삭제 하시겠습니까??") == true){    
    		location.replace('actionPHP/del_button_file.php?no=<?=$filter['bid']?>');
    		  return true;
    	}else{  
    		alert('취소하였습니다.');
    	    return false;
    	}
    		
    }
    </script>
</head>
<body>

	<h1>수정</h1>
	<hr>
	
	<div id="all_body_div">
		<form action="actionPHP/modify_Action.php" method="post" name="newWrite_form" enctype="multipart/form-data">
<!-- 		<form action="filecheck.php" method="post" name="newWrite_form" enctype="multipart/form-data"> -->
			<input type="hidden" name="bid" value="<?=$id?>">
		<table id="newWriteTable">
			<tr>
				<th id="modify_th">구분(필수)</th>
				<td id="newWriteTable_td">
					<select name="boardtype" required>
						<option value="유지보수" <?=$filter['boardtype']=="유지보수"?"checked":""?>>유지보수</option>
						<option value="문의사항" <?=$filter['boardtype']=="문의사항"?"checked":""?>>문의사항</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>작성자(필수)</th>
				<td id="newWriteTable_td">
					<input name="username" value="<?=$filter['username']?>" readonly title="작성자칸은 수정 할 수 없습니다.">
				</td>
			</tr>
			<tr>
				<th>분류(필수)</th>
				<td id="newWriteTable_td">
					<input type="radio" name="boardcategory" id="radio_1" value="홈페이지"
					   <?=$filter['boardcategory']=="홈페이지"?"checked":""?>>
					<label for="radio_1">홈페이지</label>
					
					<input type="radio" name="boardcategory" id="radio_2" value="네트워크"
					   <?=$filter['boardcategory']=="네트워크"?"checked":""?>>
					<label for="radio_2">네트워크</label>
					
					<input type="radio" name="boardcategory" id="radio_3" value="서버"
					   <?=$filter['boardcategory']=="서버"?"checked":""?>>
					<label for="radio_3">서버</label>
				</td>
			</tr>
			<tr>
			<th>고객유형</th>
					<td id="newWriteTable_td">
    					<input type="checkbox" name="usertype1" id="check_1" value="호스팅" <?=$filter["usertype1"]=="호스팅"?"checked":""?>>
    					<label for="check_1" >호스팅</label>
    					
    					<input type="checkbox" name="usertype2" id="check_2" value="유지보수" <?=$filter["usertype2"]=="유지보수"?"checked":""?>>
    					<label for="check_2" >유지보수</label>
    					
    					<input type="checkbox" name="usertype3" id="check_3" value="서버임대" <?=$filter["usertype3"]=="서버임대"?"checked":""?>>
    					<label for="check_3" >서버 임대</label>
    					
    					<input type="checkbox" name="usertype4" id="check_4" value="기타" <?=$filter["usertype4"]=="기타"?"checked":""?>>
    					<label for="check_4" >기타</label>
				</td>
			</tr>
			<tr>
				<th>제목(필수)</th>
				<td id="newWriteTable_td">
					<input id="newWriteTable_input_title" name="title" value="<?=$filter["title"]?>" required>
				</td>
			</tr>
			<tr>
				<th>내용(필수)</th>
				<td id="newWriteTable_td">
					<textarea name="content" rows="10" cols="" required><?=$filter["content"]?></textarea>
				</td>
			</tr>
			<tr>
				<th>첨부파일</th>
				<td id="newWriteTable_td">
					<input type="file" name="realfilename" onclick="locaion.href='rweenfile.php?no='<?=$filter["bid"]?>"> 
					<?=$filter['realfilename']?> 
					<!--<?=empty($filter['realfilename'])==FALSE?"<button type='button' onclick='location.href=\"actionPHP/del_button_file.php?no=".$filter["bid"]."\"'>삭제</button>":""?>-->
					<?=empty($filter['realfilename'])==FALSE?"<button type='button' onclick='return del_file();'>삭제</button>":""?>
				</td>
			</tr>
		</table>
		
			<div id="newWrite_button_div">
				<input id="btn_size" type="submit" value="저장" onclick="return check_radio(); ">
				<input id="btn_size" type="button" value="취소" onclick="location.href='detail.php?no=<?=$filter["bid"]?>';">
			</div>
		</form>
	
	</div>

</body>
</html>

<?php 
    mysqli_close($conn);
?>