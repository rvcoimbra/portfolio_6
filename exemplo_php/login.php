<?php
session_start();
if (isset($_POST['btsubmit'])) {
	//a página foi submita


$conn = mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");
$query="SELECT * FROM utilizadores WHERE email='".$_POST['email']."' AND senha='".sha1($_POST['senha'])."'";
$resultado=mysqli_query($conn,$query);
if (mysqli_num_rows($resultado)==0) {
		echo "<p>Não existe nenhum utilizador com os dados fornecidos</p>";
	} else {
		$registo=mysqli_fetch_assoc($resultado);
		$_SESSION['id']=$registo['id_utilizador'];
		$_SESSION['nome']=$registo['nome'];
		//echo"<p>Bem-vindo, ".$registo['nome']."</p>";
		header ("Location: index.php");
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<h1>Login</h1>
<form id="formlogin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p><label for="email">Email:</label><input type="text" id="email" name="email" maxlength="80" size="80" /></p>
<p><label for="senha">Password:</label><input type="password" id="senha" name="senha" maxlength="80" size="80" /> (min. 8 chars)</p>
<p><input type="submit" id="btsubmit" name="btsubmit" value="Efectuar login" /></p>
</form>


<script>
function validar () {
	if (document.getElementById("email").value=="" || document.getElementById("senha").value=="") {
		alert("Todos os campos são de preenchimento obrigatório!");
		return false;
	}
}
document.getElementById("formlogin").onsubmit=validar;
	</script>
	
<a href="index.php">Voltar à home page</a>
</body>
</html>