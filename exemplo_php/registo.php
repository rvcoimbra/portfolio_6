<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registo de utilizadores</title>
</head>

<body>


<form id="formregisto" action="insereregisto.php" method="post">
<h1>Registo de Utilizador </h1>
<p><label for="nome">Nome:</label><input type="text" id="nome" name="nome" maxlength="80" size="80"/></p>
<p><label for="email">Email:</label><input type="text" id="email" name="email" maxlength="80" size="80" /></p>
<p><label for="senha">Password:</label><input type="password" id="senha" name="senha" maxlength="80" size="80" /> (min. 8 chars)</p>
<p><label for="data_nascimento">Data de Nascimento:</label><input type="date" id="data_nascimento" name="data_nascimento" maxlength="10" size="10"/>DD/MM/AAAA</p>

<p><span id="genero">Género</span><input type="radio" id="masculino" name="genero" value="M"/> <label for="masculino">Masculino</label><input type="radio" id="feminino" name="genero" value="F"/> <label for="feminino">Feminino</label></p>
<p><input type="submit" id="btsubmit" name="btsubmit" value="Efectuar registo" /></p>
</form>

<a href="index.php">Voltar à home page</a>
<script>

function validar () {
	var erro=false;
	if (document.getElementById("nome").value=="") {
		erro=true;
		document.getElementById("nome").style.backgroundColor="#f00";
	}

	
	if (document.getElementById("email").value=="") {
		erro=true;
		document.getElementById("email").style.backgroundColor="#f00";
	}

	
	if (document.getElementById("senha").value=="") {
		erro=true;
		document.getElementById("senha").style.backgroundColor="#f00";
	}
	var email = document.getElementById('email');
	var filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filtro.test(email.value)) {
		erro=true;
		document.getElementById("email").style.backgroundColor="#f00";
	}
	
	if (!document.getElementById("masculino").checked && !document.getElementById("feminino").checked) {
		erro=true;
		document.getElementById("genero").style.backgroundColor="#f00";
	}
	
	
	if (erro==true) {
		alert("Tem de preencher todos os campos assinalados a vermelho!");
		return false;
	} else {
		return true;
	}
}
	
	
	
document.getElementById("formregisto").onsubmit=validar;
document.getElementById("nome").onkeyup=function() {
	if(this.value!="") {
		this.style.backgroundColor="#fff";
	} else {
		this.style.backgroundColor="#f00";
	}
}

document.getElementById("email").onkeyup=function() {
	if(this.value!="") {
		this.style.backgroundColor="#fff";
	} else {
		this.style.backgroundColor="#f00";
	}
}

document.getElementById("senha").onkeyup=function() {
	if(this.value!="") {
		this.style.backgroundColor="#fff";
	} else {
		this.style.backgroundColor="#f00";
	}
}

document.getElementById("masculino").onclick=function () {
	document.getElementById("genero").style.backgroundColor="#fff";
}

document.getElementById("feminino").onclick=function () {
	document.getElementById("genero").style.backgroundColor="#fff";
}
</script>
</body>
</html>