<?php
    require_once 'DB.php';
    $page = empty($_GET['page'])? $page = 1:$_GET['page'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>게시판</title>

<link rel="stylesheet" type="text/css" href="css/all.css">
<link rel="stylesheet" type="text/css" href="css/list.css">
<script type="text/javascript" src="js/search.js"></script>

</head>
<body>

	<h1>목록</h1>
	<hr>
	
	<div id="all_body_div">
	<div id="SearchDiv">
		<form action="search.php" method="get" id="SearchDiv_inForm" name="searchGetForm">&nbsp;
    		 제목 <input type="search" name="t">&nbsp;
    		 작성자 <input type="search" name="u">&nbsp;
    		 작성일 <input type="date" name="fd"> ~
    		 <input type="date" name="ld">&nbsp;
    		 <input type="submit" value="검색" onclick="return search()">&nbsp;
		 </form>
	</div>
	
		<?php 
		$paging = 10;
		$firstRownum = 0;
		$getpage =isset($_GET['page'])==false?"1":$_GET['page'];
		
		  $sql = "select bid, @rownum:=@rownum+1 rownum, count(@rownum) count 
                    from board board, (select @rownum:=0)r order by rownum";
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
			<th id="th_1">번호</th>
			<th id="th_2">구분</th>
			<th id="th_3">제목</th>
			<th id="th_4">첨부</th>
			<th id="th_5">작성일</th>
			<th id="th_6">작성자</th>
			<th id="th_7">조회수</th>
		</tr>
		<?php 
		
		$sql ="select @rownum:=@rownum+1 as rownum, b.* from
	           ( select board.* from test.board board, (select @rownum:=0) r order by writedate desc) b 
                order by rownum
                limit ".$firstRownum.",".$paging;
		
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
		    
		    $date = date_create($filter['writedate']);
		    $dateformat = date_format($date, "Y-m-d");
        ?>
		 <tr>
			<td><?=$filter['rownum']?></td>
			<td><?=$filter['boardtype']?></td>
			<td id="listTable_title_td" title="<?=$filter['title']?>"><a href='detail.php?no=<?=$filter['bid']?>&page=<?=$page?>'><?=$filter['title']?></a></td>
			<td><?=$filter['realfilename']!=NULL?'💾':''?></td>
			<td><?=$dateformat?></td>
			<td title="<?=$filter['username']?>"><?=$filter['username']?></td>
			<td><?=$filter['hit']?></td>
		</tr>
		<?php } ?>
	</table>
</div>	
		<form>
    		<div id="paging">
			
			<a href='list.php' id='paging_a'> << </a>  &nbsp;
			<a href='list.php?page=<?=$getpage-1==0?1:$getpage-1?>' id='paging_a'> < </a> 	 &nbsp;	
    		<?php 
    		for ($i = 1; $i <= $totalpage; $i++) {
    		    echo "<a href='list.php?page=$i' id='paging_a'>".$i."</a> &nbsp";
    		}
    		?>
    		<a href='list.php?page=<?=$getpage+1 > $totalpage? $totalpage:$getpage+1?>' id='paging_a'> > </a>  &nbsp;	
    		<a href="list.php?page=<?=$totalpage?>" id='paging_a'> >> </a>
    		
    		</div>
		</form>
			
		<div id="listToWrite_Btn_div">
			<button id="btn_size" onclick="location.href='newWrite.php'">등록</button>
		</div>
		
	</div>
	
</body>
</html>


<?php 
    mysqli_close($conn);
?>