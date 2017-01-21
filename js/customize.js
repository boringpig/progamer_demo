function ckemail(){
	//Regular expression Testing
	emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
	if ($('#email').val().length >=10) {
		var strEmail = $('#email').val();
		if(strEmail.search(emailRule)!= -1){	//檢查email格式
			$.ajax({
				url  : "checkemail.php",
				type : 'GET',
				dataType : 'HTML',
				data : 	{
					email: $('#email').val()
				},
				error: function(xhr,ajaxOptions, thrownError) {
					alert('Ajax request 發生錯誤');
					alert(xhr.status); 
					alert(thrownError); 
					},
					success: function(response) {
						if (response == 0) {
							document.getElementById('femail').className = "form-group form-group-lg has-success has-feedback col-xs-12 col-sm-6 col-md-8"
							document.getElementById('msg').className = "glyphicon glyphicon-ok form-control-feedback"
						}else {
							document.getElementById('femail').className = "form-group form-group-lg has-error has-feedback col-xs-12 col-sm-6 col-md-8"
							document.getElementById('msg').className = "glyphicon glyphicon-remove form-control-feedback"
						}
						//$('#msg').html(response);
						//$('#msg').fadeIn();
					}
				});
		} else {
			document.getElementById('femail').className = "form-group form-group-lg has-error has-feedback col-xs-12 col-sm-6 col-md-8"
			document.getElementById('msg').className = "glyphicon glyphicon-remove form-control-feedback"
		}
		
	} else {
		//$('#msg').html('');
		document.getElementById('femail').className = "form-group form-group-lg has-error has-feedback col-xs-12 col-sm-6 col-md-8"
		document.getElementById('msg').className = "glyphicon glyphicon-remove form-control-feedback"
	}
}

function ckpwd(){
	var vReg = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,}$/;
	var vTestStr = $('#pwd').val();
	if (vReg.test(vTestStr)) {
		document.getElementById('fpwd').className = "form-group form-group-lg has-success has-feedback col-xs-12 col-sm-6 col-md-8"
		document.getElementById('pwdmsg').className = "glyphicon glyphicon-ok form-control-feedback"
	} else {
		document.getElementById('fpwd').className = "form-group form-group-lg has-error has-feedback col-xs-12 col-sm-6 col-md-8"
		document.getElementById('pwdmsg').className = "glyphicon glyphicon-remove form-control-feedback"
	}
}

function forget_ckpwd(){
	var vReg = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,}$/;
	var vTestStr = $('#newpwd').val();
	if (vReg.test(vTestStr)) {
		document.getElementById('pwdmsg').className = "glyphicon glyphicon-ok form-control-feedback"
	} else {
		document.getElementById('pwdmsg').className = "glyphicon glyphicon-remove form-control-feedback"
	}
}

function samepwd(){
	pwd1 = document.getElementById('newpwd');
	pwd2 = document.getElementById('confirmpwd');
	
	if (pwd1.value == pwd2.value) {
		document.getElementById('confirmmsg').className = "glyphicon glyphicon-ok form-control-feedback"
	} else {
		document.getElementById('confirmmsg').className = "glyphicon glyphicon-remove form-control-feedback"
	}
	
}