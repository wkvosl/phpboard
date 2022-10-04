<?php
    include 'DB.php';
    
    $s_title = empty($_GET['t'])==false?'':$_GET['t'];        //SearchForTitle
    $s_username = empty($_POST['u'])==FALSE?'':$_GET['u'];  //SearchForUsername
    $per_username = '%'.$s_username.'%';
    $s_firstdate = empty($_POST['fd'])==FALSE?'':$_GET['fd'];   //SearchForFirstDate
    $s_lastdate = empty($_POST['ld'])==FALSE?'':$_GET['ld'];    //SearchForLastDate

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

	<h1>검색</h1>
	<hr>
	
	<div id="all_body_div">
	
		<?php 
		$paging = 10;
		$firstRownum = 0;
		$getpage =isset($_GET['page'])==false?"1":$_GET['page'];
		
		if (empty($s_firstdate)==true) {
		    $s_firstdate = '20000101' ;
		}
		if (empty($s_lastdate)==true) {
		    $s_lastdate = date("Ymd");
		}
		
		$sql = " select @rownum:=@rownum+1 rownum, board.*, count(@rownum) count 
        from test.board board, (select @rownum:=0)r
        where
			board.title like '$s_title' or
            board.username like '$per_username' and
            board.writedate between '$s_firstdate' and '$s_lastdate'
		order by rownum";
		
		  $result = mysqli_query($conn, $sql);
		  $row = mysqli_fetch_array($result);
		  $count = $row['count'];
		  $totalpage = ceil($count/$paging);
		  
		  if(isset($_GET['page'])==TRUE){
		      for ($i = 0; $i < $totalpage+1; $i++) {
		          if ($getpage==$i) {
		              $firstRownum = (($_GET['page']-1) * $paging);
		          }
		      }
		  }
		?>
		
	<p id="listCount_Ptag">Total : <?=$count?> &nbsp;   page : <?=$getpage?>/<?=$totalpage?></p>	
	
<div id="table_div">
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
		
		$sql = " select @rownum:=@rownum+1 rownum, board.*
        from test.board board, (select @rownum:=0)r
        where
			board.title like '$s_title' or
            board.username like '$per_username' and
            board.writedate between '$s_firstdate' and '$s_lastdate'
		order by rownum
        limit $firstRownum,$paging";
		
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
			<td><?=$filter['realfilename']!=NULL?'💾':''?></td>
			<td><?=$filter['writedate']?></td>
			<td><?=$filter['username']?></td>
			<td><?=$filter['hit']?></td>
		</tr>
		<?php } ?>
	</table>
</div>	
		<form>
    		<div id="paging">
			
    		<?php
    		//검색페이지의 페이징은 검색어를 들고다녀야 함..
    		$prevPage = $getpage-1==0?1:$getpage-1;
    		$nextPage = $getpage+1 > $totalpage? $totalpage:$getpage+1;
    		
    		echo "<a href='search.php?t=$s_title&u=$s_username&fd=$s_firstdate&ld=$s_lastdate' id='paging_a'> << </a>  &nbsp";
    		echo "<a href='search.php?page=$prevPage&t=$s_title&u=$s_username&fd=$s_firstdate&ld=$s_lastdate' id='paging_a'> < </a> &nbsp";	
    		for ($i = 1; $i <= $totalpage; $i++) {
    		    echo "<a href='search.php?page=$i&t=$s_title&u=$s_username&fd=$s_firstdate&ld=$s_lastdate' id='paging_a'>".$i."</a> &nbsp";
    		}

    		echo "<a href='search.php?page=$nextPage&t=$s_title&u=$s_username&fd=$s_firstdate&ld=$s_lastdate'id='paging_a'> > </a>  &nbsp";	
    		echo "<a href='search.php?page=$totalpage&t=$s_title&u=$s_username&fd=$s_firstdate&ld=$s_lastdate' id='paging_a'> >> </a>";
    		?>
    		
    		</div>
		</form>
			
		<div id="listToWrite_Btn_div">
			<button id="btn_size" onclick="location.href='list.php'">목록가기</button>
		</div>
		
	</div>
	
</body>
</html>


<?php 
    mysqli_close($conn);
?>