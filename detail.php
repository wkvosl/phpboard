

<?php
    require_once 'DB.php';
    $page = empty($_GET['page'])? $page = 1:$_GET['page'];
    
    
    $id = mysqli_real_escape_string($conn,$_GET['no']);
    $sql="select * from board where bid=". $id;
    
    
     $result = mysqli_query($conn, $sql);
        
     while($row = mysqli_fetch_array($result)){
         $filter=array(
             'bid'=> htmlspecialchars($row['bid']),
             'boardtype'=> htmlspecialchars($row['boardtype']),
             'title'=> htmlspecialchars($row['title']),
             'boardcategory'=> htmlspecialchars($row['boardcategory']),
             'content'=> htmlspecialchars($row['content']),
             'realfilename'=> htmlspecialchars($row['realfilename']),
             'writedate'=> htmlspecialchars($row['writedate']),
             'username'=> htmlspecialchars($row['username']),
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
        function del(){
        	if (confirm("정말 삭제하시겠습니까??") == true){    
		       	location.replace('actionPHP/delete_Action.php?no=<?=$filter['bid']?>');
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
				<th id="detail_th">구분(필수)</th>
				<td id="newWriteTable_td">
					<?=$filter['boardtype'] ?>
				</td>
			</tr>
			<tr>
				<th>작성자(필수)</th>
				<td id="newWriteTable_td">
					<?=$filter['username']; ?>
				</td>
			</tr>
			<tr>
				<th>분류(필수)</th>
				<td id="newWriteTable_td">
					<?=$filter['boardcategory']; ?>
				</td>
			</tr>
			<tr>
				<th>고객유형</th>
				<td id="newWriteTable_td">
				<?php 
				$usertype1 = empty($filter['usertype1'])?"":$filter['usertype1'];
				$usertype2 = empty($filter['usertype2'])?"":$filter['usertype2'];
				$usertype3 = empty($filter['usertype3'])?"":$filter['usertype3'];
				$usertype4 = empty($filter['usertype4'])?"":$filter['usertype4'];
				
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
					<?=$filter['title']; ?>
				</td>
			</tr>
			<tr>
				<th>내용(필수)</th>
				<td id="newWriteTable_td" >
					<p class="textArea_tag_value"><?=nl2br($filter['content']); ?></p>
				</td>
			</tr>
			<tr>
				<th>첨부파일</th>
				<td id="newWriteTable_td">
<!-- 				파일명 : substr로 난수와 날짜붙인것을 떼어내어 보여줌. -->
					<?=empty($filter['realfilename'])==TRUE?'첨부파일 없음':substr($filter['realfilename'],13)?> 
					<?php if(empty($filter['realfilename'])==FALSE){ ?>
					<button onclick="location.href='actionPHP/file_down.php?no=<?=$filter['bid'];?>'">다운로드</button>
					<?php }?>
				</td>
			</tr>
		</table>

			<div id="newWrite_button_div">
				<input id="btn_size" type="button" value="수정" onclick="location.replace('modify.php?no=<?=$filter['bid']?>');">
				<input id="btn_size" type="button" value="삭제" onclick="return del();">
				<input id="btn_size" type="button" value="목록" onclick="location.replace('list.php?page=<?=$page?>')">
			</div>
	</div>
</body>
</html>

<?php 
$sql = "update board set hit=".mysqli_real_escape_string($conn, $filter['hit'])."+1 where bid=".mysqli_real_escape_string($conn, $filter['bid']);
    $result = mysqli_query($conn, $sql);
?>

<?php
    mysqli_close($conn);
?>