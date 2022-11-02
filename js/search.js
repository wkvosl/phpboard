


function search(){
	var title = document.searchGetForm.t.value;
	var username = document.searchGetForm.u.value;
	var firstdate = document.searchGetForm.fd.value;
	var lastdate = document.searchGetForm.ld.value;
	
	if (title.trim()=='' && username.trim()=='' && firstdate.trim()=='' && lastdate.trim()==''){
		alert('검색 조건을 하나 이상 입력하세요.');
		location.reload(true);
		return false;
	}
	return true;
}

