<?php
if (isset($_POST['btSubmit'])) {
	$conn = mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");
$query="SELECT * FROM utilizadores WHERE email='".$_POST['email']."'";
$resultado=mysqli_query($conn,$query);
if (mysqli_num_rows($resultado)==0) {
		echo "<p>Não existe nenhum utilizador com o email fornecido</p>";
	} else {
		//gerar token e inserir na bd
		$var="ABCDEFGHIJKLMNOKQRSTUVWXYZ";
		$segredo="";
		for($contador=1;$contador<=15;$contador++){
		$aleatorio=rand(0, 25);
		$segredo.=$var[$aleatorio];
		}
		//echo sha1($segredo);
		$query="UPDATE utilizadores SET token='".sha1($segredo)."' WHERE email='".$_POST['email']."'";
		$resultado=mysqli_query($conn,$query);
		if (mysqli_affected_rows($conn)==0) {
		echo "<p>Ocorreu um erro no pedido de alteração da senha</p>";
		} else {
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: premoaldo@gmail.com' . "\r\n";
			$mensagem='<html><head><title>Recuperação de senha</title></head><body><p>Para alterar a sua senha clique no seguinte link: <a href="http://www.alquimiadacor.pt/repoesenha.php?email='.$_POST['email'].'&token='.sha1($segredo).'">http://www.alquimiadacor.pt/repoesenha.php?email='.$_POST['email'].'&token='.sha1($segredo).'</a></p></body>';
			if (mail($_POST['email'], 'Criação de nova senha', $mensagem, $headers)) {
				header("Location: mailenviado.php");
			} else {
				echo "<p>Ocorreu um erro no envio do email</p>";				
			}
		//echo "<p>Vai receber um email com instruções para alterar a sua senha</p>";
		if (mail($_POST['email'], 'Criação de nova senha', 'Para alterar a sua senha clique no seguinte link:')){
		header ("Location: emailenviado.php");
		}else{
		echo "<p>Ocorreu um erro no envio de email</p>";
			}
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Esqueci-me da senha</title>
</head>

<body>
<h1>Solicitar alteração da senha por esquecimento</h1>
<form id="formesquecime" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p><label for="email">E-mail </label><input type="text" id="email" name="email" maxlenth="80" size="80" /></p>
<p><input type="submit" id="btSubmit" name="btSubmit" value="Solicitar alteração da senha" /></p>
</form>

<a href="index.php">Voltar à página principal</a>

<script>
	document.getElementById("formesquecime").onsubmit=function () {
	if (document.getElementById("email").value.trim=="") {
		alert("tem de fornecer um email");
		return false;
		} else {
	var email = document.getElementById('email');
	var filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filtro.test(email.value)) {
		alert("este email não tem um formato correcto");
		return false;
		}
	}
}
	</script>

</body>



</html>