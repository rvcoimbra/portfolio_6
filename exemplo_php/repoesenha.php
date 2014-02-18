<?php
if (isset($_GET['email'])&&isset($_GET['token'])) {
	$conn = mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");
	$query="SELECT * FROM utilizadores WHERE email='".$_GET['email']."' AND token='".$_GET['token']."'";
//echo $query;
	$resultado=mysqli_query($conn,$query);
} else {
	header ("Location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<h1>Repor senha</h1>
<!--http://www.alquimiadacor.pt/repoesenha.php?email=rvcoimbra@gmail.com&token=0f4d4813910840081a99a45648eeb623be95b3a2-->
<?php
		if (mysqli_num_rows($resultado)==0) {
		echo "<p>Não existe nenhum utilizador com o email ou token fornecidos</p>";
			} else {
?>
<form id="alterapassword" method="post" action="alterasenha.php">
<p><label for="senha">Nova senha:</label><input type="password" id="senha" name="senha" maxlength="80" size="80" /></p>
<p><label for="repetirsenha">Repetir nova senha:</label><input type="password" id="repetirsenha" name="repetirsenha" maxlength="80" size="80" /></p>
<input type="hidden" id="email" name="email" value="<?php echo $_GET['email'];?>" />
<input type="hidden" id="token" name="token" value="<?php echo $_GET['token'];?>" />
<p><input id="btsubmit" name="btsubmit" type="submit" value="Alterar senha" /></p>
</form>
<?php
	} 
?>
<script>

function validar () {
	var erro=false;
	
	if (document.getElementById("senha").value=="") {
		erro=true;
		document.getElementById("senha").style.backgroundColor="#f00";
	}
		
	if (document.getElementById("repetirsenha").value=="") {
	erro=true;
	document.getElementById("repetirsenha").style.backgroundColor="#f00";
	}
	if (erro==true) {
		alert("Tem de preencher todos os campos assinalados a vermelho!");
		return false;
	} else {
		
		if (document.getElementById("senha").value.length<8||document.getElementById("repetirsenha").value.length<8) {
			alert("A nova senha tem de possuir no mínimo 8 caracteres!");
		return false;
		}else{
		
			if (document.getElementById("senha").value!=document.getElementById("repetirsenha").value) {
				alert("Os valores dos dois campos têm de ser iguais!");
			return false;
			}
		}
	}
	
}
	
document.getElementById("alterapassword").onsubmit=validar;

document.getElementById("senha").onkeyup=function() {
	if(this.value!="") {
		this.style.backgroundColor="#fff";
	} else {
		this.style.backgroundColor="#f00";
	}
}

document.getElementById("repetirsenha").onkeyup=function() {
	if(this.value!="") {
		this.style.backgroundColor="#fff";
	} else {
		this.style.backgroundColor="#f00";
	}
}

</script>
</body>
</html>