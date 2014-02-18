<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<h1>Dilsabel, Moda e Companhia</h1>
<?php 
if (isset($_SESSION['nome'])) {
	echo"<p>Bem-vindo, ".$_SESSION['nome']."</p>";
	echo'<p><a href="perfil.php">Perfil</a></p>';
	echo'<p><a href="logout.php">Logout</a></p>';

} else {
	echo'<p><a href="login.php">Login</a></p>';
	echo'<p><a href="esquecime.php">Esqueci-me da senha</a></p>';
}
?>
<p><a href="registo.php">Registo</a></p>
<h2>Produtos disponíveis</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="formpesquisa" method="post">
<p><label for="pesquisa">Pesquisa:</label> <input type="text" id="pesquisa" name="pesquisa" /> <input type="submit" id="btpesquisa" name="btpesquisa" value="Pesquisar"/></p>
</form>


<?php
if (isset($_POST['pesquisa']) && $_POST['pesquisa']!="") {
	$palavras=split (" ",$_POST['pesquisa']);
	//se a pesquisa for "fogao gas miele"
	//entao vou obter um array com 3 elementos
	$condicao=" WHERE nome_artigo LIKE '%".$palavras[0]."%'";
	$numpalavras=count($palavras);
	for($posicao=1;$posicao<$numpalavras;$posicao++){
		$condicao.=" OR nome_artigo LIKE '%".$palavras[$posicao]."%'";
	}
	$comando="SELECT * FROM artigos".$condicao;
	/*}else{
	$comando="SELECT * FROM artigos";*/
$conn = mysqli_connect("localhost", "root", "", "loja") or trigger_error("Erro na ligação");
mysqli_set_charset($conn,"utf8");
mysqli_query($conn,"SET NAMES utf8");
$resultado=mysqli_query($conn,$comando);
	if(mysqli_num_rows($resultado)==0){
		echo "<p>Não há artigos disponíveis</p>";
	}else{
		echo '<table border="1">';
		echo '<tr><th>Nome do Artigo</th><th>Descrição</th><th>Preço</th><th>Foto</th></tr>';
		while ($registo=mysqli_fetch_assoc($resultado)) {
			echo "<tr>";
			echo "<td><a href='artigo.php?codigo=".$registo['id_artigo']."'>".$registo['nome_artigo']."</a></td>";
			echo "<td>".$registo['descricao_artigo']."</td>";
			echo "<td>&euro;".$registo['preco_artigo']."</td>";
			echo "<td><img src='fotos/".$registo['foto_artigo']."'></td>";
			//echo "<td>".$registo['foto_artigo']."</td>";
			echo "</tr>";
			}
		echo '</table>';
	}
	}
	//mysqli_close($conn);
?>

<script>
document.getElementById("formpesquisa").onsubmit=function() {
	if (document.getElementById("pesquisa").value=="") {
		alert ("Tem de preencher o campo de pesquisa!");
		return false;
	}
}
</script>
</body>
</html>