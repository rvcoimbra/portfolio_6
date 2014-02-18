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

if (isset($_POST['btsubmit'])) {

$query="UPDATE utilizadores SET nome='".$_POST['nome']."', email='".$_POST['email']."', data_nascimento='".$_POST['data_nascimento']."', genero='".$_POST['genero']."'WHERE id_utilizador=".$_SESSION['id'];
		$resultado=mysqli_query($conn,$query);
		if(mysqli_affected_rows($conn)!=1){
			echo "<p>Ocorreu um problema na alteração da senha. Tente alterar a senha outra vez. Caso ocorra o mesmo erro contacte o suporte técnico!</p>";	
		} else {
			echo"<p>A senha foi alterada com sucesso!</p>";
		}

}
$query="SELECT * FROM utilizadores WHERE id_utilizador=".$_SESSION['id'];
$resultado=mysqli_query($conn,$query);
$registo=mysqli_fetch_assoc($resultado);

$query="UPDATE utilizadores SET nome='".$registo['nome']."'WHERE id_utilizador=".$_SESSION['id'];
$resultado=mysqli_query($conn,$query);





?>
<form id="alterapassword" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p><label for="nome">Nome:</label><input type="text" id="nome" name="nome" maxlength="80" size="80" value="<?php echo $registo['nome'] ?>"/></p>
<p><label for="email">Email:</label><input type="text" id="email" name="email" maxlength="80" size="80" value="<?php echo $registo['email'] ?>"/></p>
<p><label for="data_nascimento">Data de Nascimento:</label><input type="date" id="data_nascimento" name="data_nascimento" maxlength="10" size="10" value="<?php echo $registo['data_nascimento'] ?>"/>DD/MM/AAAA</p>
<p><span id="genero">Género</span><input type="radio" id="masculino" name="genero" value="M"<?php if($registo['genero']=="M") echo"checked"; ?>/> <label for="masculino">Masculino</label><input type="radio" id="feminino" name="genero" value="F"<?php if($registo['genero']=="F") echo"checked"; ?>/> <label for="feminino">Feminino</label></p>
<p><input id="btsubmit" name="btsubmit" type="submit" value="Alterar perfil" /></p>
</form>

<a href="index.php">Voltar à home page</a>
</body>
</html>