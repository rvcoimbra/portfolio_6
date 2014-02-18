
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inserir registo</title>
</head>

<body>
<?php
$conn = mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");

// testar se o endereço de email já existe na tabela
$query="SELECT * FROM utilizadores WHERE email='".$_POST['email']."'";
$resultado=mysqli_query($conn,$query);
if (mysqli_num_rows($resultado)==0) {
	$query="INSERT INTO utilizadores(nome,email,senha,data_nascimento,genero) VALUES('".$_POST['nome']."','".$_POST['email']."','".sha1($_POST['senha'])."','".$_POST['data_nascimento']."','".$_POST['genero']."')";
	$resultado=mysqli_query($conn,$query);

	if (mysqli_affected_rows($conn)==1) {
		echo "<p>Os seus dados foram registados na base de dados</p>";
	} else {
		echo "<p>Erro na inserção do registo</p>";
	}
} else {
	echo "<p>Já existe um registo com o email fornecido</p>";
}
?>

<script>
</body>
</html>