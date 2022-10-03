

function check_radio(){
	
	if(document.newWrite_form.boardtype.value.length==0){
		newWrite_form.boardtype.focus();
		return false;
	}
	if(document.newWrite_form.username.value.length==0){
		newWrite_form.username.focus();
		return false;
	}
	if(!radio_1.checked && !radio_2.checked && !radio_3.checked){
		alert('분류를 하나 이상 선택하세요.');
		newWrite_form.radio_1.focus();
		return false;
	}
	if(document.newWrite_form.title.value.length==0){
		newWrite_form.title.focus();
		return false;
	}
	if(document.newWrite_form.content.value.length==0){
		newWrite_form.content.focus();
		return false;
	}
	
	alert('저장 하였습니다.');
	return true;
}



function setPreview(event){
	var reader = new FileReader();
	var imgpreview = document.querySelector("div#imgPreview");
	
	reader.onload = function(event){
		var img = document.createElement("img");
			img.setAttribute('src',event.target.result);
			img.setAttribute('class','imgV');
			imgpreview.appendChild(img);
	};
	reader.readAsDataURL(event.target.files[0]);
}


