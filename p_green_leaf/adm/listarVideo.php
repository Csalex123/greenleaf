<?php 
require ('../conexao.php');

if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
$id_adm = $_SESSION['id_adm'];


$query =  mysqli_query($conexao, "SELECT  nivel FROM administrador WHERE id_adm = '$id_adm'  LIMIT 1");
$resultado = mysqli_fetch_assoc($query);

$_SESSION['nivel'] = $resultado['nivel'];


$nivel = $_SESSION['nivel'];


// Verifica se é administrador geral
if ($nivel != 2 ) {


	echo "<script>alert('Só para administradores com nível de acesso Geral'); location.href='inicioADM.php';</script>"; exit;

}

$consulta = "SELECT * FROM video";
$con = mysqli_query($conexao,$consulta);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Green leaf</title>
	<meta charset="utf-8">
	<title>Gren leaf</title>
	<link rel="icon"  href="../img/fav.jpg">
	<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1" media="all">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" media="all"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="all">

	<script src="jquery.js"></script>

</head>
<body >
	<style type="text/css">

	.fonte{
		font-size: 1.4em;
		font-family: 'Bree Serif', serif;
		color: #3A5FCD;
	}

	
	.fonte2{
		font-family: 'Bree Serif', serif;
	}

	
	.hover:hover{

		
		background-color: #00BFFF;
	}

	a:hover{
		color: red;
	}

</style>
<h1 align="center" class="fonte" style="font-size: 3em">Lista de todos os Vídeos</h1>
<a href="video.php"><button  class="btn btn-default hover" style="float: right; margin-right: 4px;">Publicar um Vídeo</button></a>
<a href="inicioADM.php"><button  class="btn btn-default hover" style="float: right; margin-right: 4px;">Voltar para página inicial</button></a>

<br><br><br>

<table class="table table-hover">
	<tr>
		<td class="fonte">ID</td>
		<td class="fonte">Título</td>
		<td class="fonte">Categoria</td>
		<td class="fonte">Vídeo</td>

		<td class="fonte">Ação</td>
	</tr>

	<?php while($dado = $con->fetch_array()){ ?>

	<tr>
		<td class="fonte2"><?php  echo utf8_encode($dado["id_video"]); ?></td>
		<td class="fonte2"><?php echo utf8_encode($dado["titulo"]); ?></td>
		<td class="fonte2"><?php echo utf8_encode($dado["categoria"]); ?></td>

		
		<td class="fonte2">

			<?php $video = $dado['link_video'];?> 

			<?php echo "<iframe width='250' height='100' src=' $video ' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>" ;?>

		</td>



		<td class="fonte2">

			<a style="margin-left: 2px;" href="javascript: if(confirm('Tem certeza que deseja deletar o vídeo? 
			')) 
			location.href='deletarvideo.php?p=excluir&video=<?php echo $dado['id_video']; ?>';">Excluir</a> 

		</td>
	</tr>

	<?php } ?>
</table>

</body>
</html>



