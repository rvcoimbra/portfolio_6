<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Artigo</title>
</head>

<body>
<?php
if (isset($_GET['codigo']) && is_numeric($_GET['codigo'])){
	$conn = mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");
	mysqli_set_charset($conn, "utf8");
	mysqli_query($conn, "SET NAMES utf8");
	$comando="SELECT * FROM artigos WHERE id_artigo=".$_GET['codigo'];
	$resultado=mysqli_query($conn,$comando);	
	if(mysqli_num_rows($resultado)==0){
	echo "<p>Não existe o artigo na BD</p>";
}else{
	$registo=mysqli_fetch_assoc($resultado);
	echo "<p><img src='fotos/".$registo['foto_artigo']."'></p>";
	echo "<p><strong>Nome_artigo:</strong>".$registo['nome_artigo']."</p>";
	echo "<p><strong>Descrição:</strong>".$registo['descricao_artigo']."</p>";
	echo "<p><strong>Preço:</strong>".$registo['preco_artigo']."</p>";			
	}
	}else{
	echo "<p>Erro no processamento do artigo</p>";	
	}
?>

</body>
</html>
