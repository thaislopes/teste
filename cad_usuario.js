function checarEmail(){
	if (document.forms[0].email.value==""
	|| document.forms[0].email.value.indexOf('@')==-1
	||document.forms[0].email.value.indexOf('.')==-1)
	{
		alert("Por favor, insira um E-mail válido! ");
		return false;
	}
}
