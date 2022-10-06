<?php
    include 'DB.php';
    
    $s_title = empty($_GET['t'])==TRUE?'':$_GET['t'];        //SearchForTitle
    $s_username = empty($_GET['u'])==TRUE?'':$_GET['u'];  //SearchForUsername
    $s_firstdate = empty($_GET['fd'])==TRUE?'':$_GET['fd'];   //SearchForFirstDate
    $s_lastdate = empty($_GET['ld'])==TRUE?'':$_GET['ld'];    //SearchForLastDate

    $per_username = '+'.$s_username.'*';
    $per_title = '+'.$s_title.'*';
    
    $per_username = empty($s_username)?'':$per_username;
    $per_title= empty($s_title)?'':$per_title;
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
	<div id="SearchDiv_search"></div>
	
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
		
		$per_title = mysqli_real_escape_string($conn, $per_title);
		$per_username = mysqli_real_escape_string($conn, $per_username);
		$s_firstdate = mysqli_real_escape_string($conn, $s_firstdate);
		$s_lastdate = mysqli_real_escape_string($conn, $s_lastdate);
		
		//전체 검색 결과
		if(!empty($per_title) || !empty($per_username)){
		$sql = " select @rownum:=@rownum+1 rownum, board.*, count(@rownum) count 
        from test.board board, (select @rownum:=0)r
        where 
			match(title,username)against('$per_title $per_username' in boolean mode) and
            board.writedate between '$s_firstdate' and '$s_lastdate'
		order by rownum";
		}
		if(empty($per_title) && empty($per_username)){
		    $sql = " select @rownum:=@rownum+1 rownum, board.*, count(@rownum) count
        from test.board board, (select @rownum:=0)r
        where
            board.writedate between '$s_firstdate' and '$s_lastdate'
		order by rownum";
		}
		
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
		
		//전체 검색 결과 페이징
		if(!empty($per_title) || !empty($per_username)){
		    $sql = " select @rownum:=@rownum+1 rownum,  b.* from (select board.* 
        from test.board board, (select @rownum:=0) r
        where
			match(title,username)against('$per_title $per_username' in boolean mode) and
            board.writedate between '$s_firstdate' and '$s_lastdate'
        order by writedate desc) b 
		order by rownum limit $firstRownum,$paging";
		}
		if(empty($per_title) && empty($per_username)){
		    $sql = " select @rownum:=@rownum+1 rownum,  b.* from (select board.* 
        from test.board board, (select @rownum:=0) r
        where
            board.writedate between '$s_firstdate' and '$s_lastdate'
        order by writedate desc) b 
		order by rownum limit $firstRownum,$paging";
		}

        
		
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
			<td id="listTable_title_td" title="<?=$filter['title']?>"><a href='detail.php?no=<?=$filter['bid']?>'><?=$filter['title']?></a></td>
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
			
    		<?php
    		//검색페이지의 페이징은 검색어를 들고다녀야 함..
    		$prevPage = $getpage-1==0?1:$getpage-1;
    		$nextPage = $getpage+1 > $totalpage? $totalpage:$getpage+1;
    		$carrydata = "t=$s_title&u=$s_username&fd=$s_firstdate&ld=$s_lastdate";
    		
    		echo "<a href='search.php?$carrydata' id='paging_a'> << </a> &nbsp";
    		echo "<a href='search.php?page=$prevPage&$carrydata' id='paging_a'> < </a> &nbsp";	
    	for ($i = 1; $i <= $totalpage; $i++) {
    		echo "<a href='search.php?page=$i&$carrydata' id='paging_a'>".$i."</a> &nbsp";
    	}

    		echo "<a href='search.php?page=$nextPage&$carrydata'id='paging_a'> > </a> &nbsp";	
    		echo "<a href='search.php?page=$totalpage&$carrydata' id='paging_a'> >> </a>";
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