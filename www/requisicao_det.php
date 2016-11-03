<?php require_once('Connections/conexao.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

require_once('func_acessorestrito.php');

if(isset($_GET['reqid'])) { 
$_SESSION['reqid'] = $_GET['reqid'];

mysql_select_db($database_conexao, $conexao);
$query_RsRequisicao = "SELECT * FROM vw_requisicao WHERE reqid=".$_SESSION['reqid']."";
$RsRequisicao = mysql_query($query_RsRequisicao, $conexao) or die(mysql_error());
$row_RsRequisicao = mysql_fetch_assoc($RsRequisicao);
$totalRows_RsRequisicao = mysql_num_rows($RsRequisicao);
}
 
mysql_select_db($database_conexao, $conexao);
$query_RsRequisicaoItens = "SELECT * FROM vw_reqitens WHERE req_id=".$_SESSION['reqid']."";
$RsRequisicaoItens = mysql_query($query_RsRequisicaoItens, $conexao) or die(mysql_error());
$row_RsRequisicaoItens = mysql_fetch_assoc($RsRequisicaoItens);
$totalRows_RsRequisicaoItens = mysql_num_rows($RsRequisicaoItens);

if(isset($_GET['reqitid_del'])) {
	if(NULL($row_RsRequisicao['reqdataentrega']))
	 { 
	 
	 header("Location:requisicao_itens_del.php?reqitid_del=".$_GET['reqitid_del'].""); 
	 
	 } else {
	 
	 echo "<script>alert('Esta Requisição já foi fechada!')</script>" ; }
	 

}
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

<div data-role="panel" id="mypanel">

   <ul data-role="listview" data-count-theme="b" data-divider-theme="b" data-inset="true">
   <li data-icon="home"><a href="index.php">Início</a></li>
   <li data-icon="home"><a href="requisicao.php">Requisicao</a></li>

   
   </ul>

</div><!-- /panel -->

  <div class="style2" data-role="header">
		<a href="#mypanel" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Painel</a>
<h1>Requisição ID: <?php echo $row_RsRequisicao['reqid']; ?> </h1>
        
	</div>
	<!-- /header -->

	<div role="main" class="ui-content">
		<p>Requisição ID: <?php echo $row_RsRequisicao['reqid']; ?> | Data da Requisição: <?php echo $row_RsRequisicao['reqdata']; ?> | Qnt de Itens: <?php echo $totalRows_RsRequisicaoItens; ?> | Entregue em: <?php echo $row_RsRequisicao['reqdataentrega']; ?></p>
        
        <a href="requisicao_itens.php?reqid=".."" class="ui-btn ui-icon-plus ui-btn-inline ui-btn-icon-left">Adicionar Item</a>
        
        <?php if ($totalRows_RsRequisicaoItens > 0) { // Mostra se o registro não estiver vazio ?>
        
  <ul data-role="listview" data-split-icon="delete" data-theme="a" data-split-theme="b" data-inset="true">
    <?php do { ?>
      <li><a href=""><?php echo $row_RsRequisicaoItens['itemdesc']; ?></a>
        <a href="?reqitid_del=<?php echo $row_RsRequisicaoItens['reqitid'];  ?>" data-position-to="window" >Purchase album</a>
      </li>
      
      <?php } while ($row_RsRequisicaoItens = mysql_fetch_assoc($RsRequisicaoItens)); ?>
  </ul>
  
  <?php } // Mostra se o registro não estiver vazio ?>
  
    </div>
<!-- /content -->
<div data-role="footer">
<h4>SIGDados - CBMGO/9º BBM</h4>
</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
<?php
mysql_free_result($RsRequisicao);
mysql_free_result($RsRequisicaoItens);
?>