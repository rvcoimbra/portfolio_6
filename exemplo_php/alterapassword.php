<?php
session_start();
if (!isset($_SESSION['id'])) {
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
<h1>Alterar senha</h1>
<?php
if(isset($_POST['btsubmit'])){
	$conn= mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");
	$query="SELECT * FROM utilizadores WHERE id_utilizador=".$_SESSION['id'];
	$resultado=mysqli_query($conn,$query);
	$registo=mysqli_fetch_assoc($resultado);

	if(sha1($_POST['senhaactual'])!=$registo['senha']){
		echo"<p>A senha actual não está correcta</p>";
	}else{
		$query="UPDATE utilizadores SET senha='".sha1($_POST['senha'])."'WHERE id_utilizador=".$_SESSION['id'];
		$resultado=mysqli_query($conn,$query);
		if(mysqli_affected_rows($conn)!=1){
			echo "<p>Ocorreu um problema na alteração da senha. Tente alterar a senha outra vez. Caso ocorra o mesmo erro contacte o suporte técnico!</p>";	
		} else {
			echo"<p>A senha foi alterada com sucesso!</p>";
		}
	}
}
?>
<form id="alterapassword" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p><label for="senhaactual">Senha actual:</label><input type="password" id="senhaactual" name="senhaactual" maxlength="80" size="80" /></p>
<p><label for="senha">Nova senha:</label><input type="password" id="senha" name="senha" maxlength="80" size="80" /></p>
<p><label for="repetirsenha">Repetir nova senha:</label><input type="password" id="repetirsenha" name="repetirsenha" maxlength="80" size="80" /></p>
<p><input id="btsubmit" name="btsubmit" type="submit" value="Alterar senha" /></p>
</form>

<a href="index.php">Voltar à home page</a>

<script>

function validar () {
	var erro=false;
	
	if (document.getElementById("senhaactual").value=="") {
		erro=true;
		document.getElementById("senhaactual").style.backgroundColor="#f00";
	}
		
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

document.getElementById("senhaactual").onkeyup=function() {
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