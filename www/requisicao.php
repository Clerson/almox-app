<?php require_once('Connections/conexao.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}



mysql_select_db($database_conexao, $conexao);
$query_RsSecao = "SELECT secid, secdesc FROM secao";
$RsSecao = mysql_query($query_RsSecao, $conexao) or die(mysql_error());
$row_RsSecao = mysql_fetch_assoc($RsSecao);
$totalRows_RsSecao = mysql_num_rows($RsSecao);

mysql_select_db($database_conexao, $conexao);
$query_RsRequisicao = "SELECT * FROM vw_requisicao WHERE reqsolicitante=".$_SESSION['MM_usuid']."";
$RsRequisicao = mysql_query($query_RsRequisicao, $conexao) or die(mysql_error());
$row_RsRequisicao = mysql_fetch_assoc($RsRequisicao);
$totalRows_RsRequisicao = mysql_num_rows($RsRequisicao);

?>
<html>
<head>
<style type="text/css">
<!--
.style2 {font-weight: bold}
-->
</style>	

    <title>Requisição</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="charset=utf-8" />
	<link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="jquery.mobile-1.4.5/jquery.js"></script>
	<script src="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
    
    

</head>

<body>

<div data-role="page">

<div class="style2" data-role="header">
		<a href="#mypanel" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Painel</a>
        <h1>Requisição</h1>
  </div>
	<!-- /header -->
    
<?php include_once 'painel_esquerdo.php';?>

	<div role="main" class="ui-content">
		<p>Selecione a Seção:</p>
		<ul data-role="listview" data-inset="false">
			<?php do { ?>
  				<li><a href="requisicao_itens.php?acao=add&secid=<?php echo $row_RsSecao['secid']; ?>"><?php echo $row_RsSecao['secdesc']; ?> </a></li>
        	<?php } while ($row_RsSecao = mysql_fetch_assoc($RsSecao)); ?>
        </ul>
    </div>
<!-- /content -->
<div data-role="footer">
<h4>SIGDados - CBMGO/9º BBM</h4>
</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
<?php
mysql_free_result($RsSecao);
mysql_free_result($RsRequisicao);
?>