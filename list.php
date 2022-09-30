<?php
    include 'DB.php';
   
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>게시판</title>

<link rel="stylesheet" type="text/css" href="css/all.css">
<link rel="stylesheet" type="text/css" href="css/list.css">

</head>
<body>

	<h1>목록</h1>
	<hr>
	
	<div id="all_body_div">
	<div id="SearchDiv">
		<form action="action_search_Action" method="post" id="SearchDiv_inForm">&nbsp;
    		 제목 <input name="SearchForTitle">&nbsp;
    		 작성자 <input name="SearchForUsername">&nbsp;
    		 작성일 <input type="date" name="SearchForFirstDate"> ~
    		 <input type="date" name="SearchForLastDate">&nbsp;
    		 <input type="submit" value="검색">&nbsp;
		 </form>
	</div>
	
		<?php 
		  $sql = "select bid count from board";
		  $result = mysqli_query($conn, $sql);
		  $count = mysqli_num_rows($result);
		?>
	<p id="listCount_Ptag">Total : <?=$count?></p>	
	
	<table id="listTable">
		<tr id="listTable_Title_tr">
			<th>제목</th>
			<th>구분</th>
			<th>제목</th>
			<th>첨부</th>
			<th>작성일</th>
			<th>작성자</th>
			<th>조회수</th>
		</tr>
		<?php 
		//$sql = "select * from board";
		$sql ="select @rownum:=@rownum+1 as rownum, board.* from board board, (select @rownum:=0) r order by rownum";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result)){
       $filter=array(
        'rownum'=> htmlspecialchars($row['rownum']),
        'bid'=> htmlspecialchars($row['bid']),
        'boardtype'=> htmlspecialchars($row['boardtype']),
        'title'=> htmlspecialchars($row['title']),
        'realfilename'=> htmlspecialchars($row['realfilename']),
        'writedate'=> htmlspecialchars($row['writedate']),
        'username'=> htmlspecialchars($row['username']),
        'hit'=> htmlspecialchars($row['hit'])
       );
        ?>
		 <tr>
			<td><?=$filter['rownum']?></td>
			<td><?=$filter['boardtype']?></td>
			<td id="listTable_title_td"><a href='detail.php?no=<?=$filter['bid']?>'><?=$filter['title']?></a></td>
			<td><?=$filter['realfilename']?></td>
			<td><?=$filter['writedate']?></td>
			<td><?=$filter['username']?></td>
			<td><?=$filter['hit']?></td>
		</tr>
		<?php } ?>
	</table>
		<div id="listToWrite_Btn_div">
			<button id="btn_size" onclick="location.href='newWrite.php'">등록</button>
		</div>
		
	</div>
	
	
	
</body>
</html>


<?php 
    mysqli_close($conn);
?>