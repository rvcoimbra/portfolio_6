<?php
if(!isset($_POST['email'])||!isset($_POST['token'])|!isset($_POST['senha'])){
	header ("Location: index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Altera senha</title>
</head>

<body>
<?php
echo "<p>".$_POST['senha']."</p>";
//echo "<p>".$_POST['repetirsenha']."</p>";
echo "<p>".$_POST['email']."</p>";
echo "<p>".$_POST['token']."</p>";
//Substituir na base de dados o valor da senha no registo que possui o email e o token fornecidos - UPDATE
//limpar o token
$conn= mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");
$query="UPDATE utilizadores SET senha='".sha1($_POST['senha'])."',token=''WHERE email='".$_POST['email']."' AND token='".$_POST['token']."'";
//"UPDATE utilizadores SET senha=''";
//"UPDATE utilizadores SET senha='".."'";
//"UPDATE utilizadores SET senha='".$_POST['senha']."'";
$resultado=mysqli_query($conn,$query);
if(mysqli_affected_rows($conn)!=1){
			echo "<p>Ocorreu um problema na alteração da senha. Tente alterar a senha outra vez. Caso ocorra o mesmo erro contacte o suporte técnico!</p>";	
		} else {
			echo"<p>A senha foi alterada com sucesso!</p>";
		}

?>
<p><a href="index.php">Voltar à página principal</a></p>
</body>
</html>