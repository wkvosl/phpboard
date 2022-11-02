create table test.board(
bid int auto_increment,
username varchar(100) not null,
title varchar(100) not null,
boardtype varchar(20) not null,
boardcategory varchar(20) not null,
usertype varchar(20),
content text not null,
writedate date,
realfilename varchar(100),
hit int,
primary key (bid)
);

insert into test.board (username, title, boardtype, boardcategory, content)
values ('홍길동','테스트1','유지보수','호스팅','살려주세요');

insert into test.board (username, title, boardtype, boardcategory, content, writedate)
values ('홍길동','테스트2','유지보수','호스팅','살려주세요', sysdate());

select * from test.board;
select * from test.board where bid =55;
select * from test.board where realfilename ='896822022100508_고양이.jpg';

update test.board set realfilename = NULL where bid = 12;


alter table test.board modify column writedate datetime;
ALTER TABLE test.board MODIFY COLUMN hit int default 0;
commit;

/*체크박스 가져오는게 힘들다. 기존에 있는 4가지 종류가 모두 나오면서
그중에서 체크한 값으로 체크된 상태를 보여준다.
이건... usertype의 배열 문자열 방식을 
usertype 1,2,3,4로 나누는게 답이다.. 아무리 해도 안된다...*/
alter table test.board rename column usertype to usertype1;
alter table test.board add column usertype4  varchar(20);

select @rownum:=@rownum+1 as rownum, board.* from test.board board, (select @rownum:=0) r order by rownum;

update test.board set hit =  hit+ 1 where bid = 14;


select main.*, @rownum:=@rownum+1 as rownum 
from test.board as main, (select @rownum:=0) as rownum 
order by rownum
limit 10,10; 

select @rownum:=@rownum+1 as rownum , count(@rownum) 
 from test.board board, (select @rownum:=0) r order by rownum;
 
 
 select  board.* , @rownum:=@rownum+1 rownum
        from test.board board, (select @rownum:=0)r 
        where
			board.title like '' or
            board.username like '' or
            board.writedate between "2022-09-28" and "2022-09-29"
		order by rownum;


create FULLTEXT index search on test.board(title,username);	
      
 select  board.* , @rownum:=@rownum+1 rownum
        from test.board board, (select @rownum:=0)r 
        where
			match(title,username)against('' in boolean mode) and
            board.writedate between "2022-10-04" and "2022-10-05"
		order by rownum;
        
select @rownum:=@rownum+1 as rownum, b.* from
	( select board.* 
     from test.board board, (select @rownum:=0) r order by writedate desc) b 
order by rownum;

select @rownum:=@rownum+1 rownum,  b.* from (select board.* 
        from test.board board, (select @rownum:=0) r
        where
            board.writedate between  "2022-10-04" and "2022-10-05"
            order by writedate desc) b 
		order by rownum;
               