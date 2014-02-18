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
<h1>Perfil </h1>
<?php
//$_SESSION['id']
$conn= mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");
$query="SELECT * FROM utilizadores WHERE id_utilizador=".$_SESSION['id'];
$resultado=mysqli_query($conn,$query);
$registo=mysqli_fetch_assoc($resultado);
echo "<p><strong>Nome:</strong> ".$registo['nome']."</p>";
echo "<p><strong>Email:</strong> ".$registo['email']."</p>";
echo "<p><strong>Data de nascimento:</strong> ".$registo['datanascimento']."</p>";
echo "<p><strong>Género:</strong> ";
if($registo['genero']=="M"){
	echo "Masculino";
}else{
	echo"Feminino";
}
	echo"</p>";
/*echo "<p><strong>Género:</strong> ".($registo['genero']=="M"?"Masculino":"Feminino")."</p>";*/
?>

<p><a href="alteraperfil.php">Alterar dados do perfil</a>
<p><a href="alterapassword.php">Alterar senha</a>
</p><a href="index.php">Voltar à página principal</a>
</body>
</html>