<?php

include '../DB.php';

$s_title = $_POST['SearchForTitle'];
$s_username = $_POST['SearchForUsername'];
$s_firstdate = $_POST['SearchForFirstDate'];
$s_lastdate = $_POST['SearchForLastDate'];

$per_username = '%'.$s_username.'%';

$sql = " select @rownum:=@rownum+1 rownum, board.*
        from test.board board, (select @rownum:=0)r
        where
			board.title like '$s_title' or
            board.username like '$per_username' or
            board.writedate between '$s_firstdate' and '$s_lastdate'
		order by rownum";

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>

</body>
</html>