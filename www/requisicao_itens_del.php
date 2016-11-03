<?php require_once('Connections/conexao.php'); ?>
<?php

if (!isset($_SESSION)) {
  session_start();
}
require_once('func_acessorestrito.php');

require_once('func_getsqlvaluestring.php'); 

if ((isset($_GET['reqitid_del'])) && ($_GET['reqitid_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM reqitens WHERE req_id=".$_SESSION['reqid']." AND reqitid=%s",
                       GetSQLValueString($_GET['reqitid_del'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($deleteSQL, $conexao) or die(mysql_error());
}
 
 
mysql_select_db($database_conexao, $conexao);
$query_RsRequisicaoItens = "SELECT * FROM vw_reqitens WHERE req_id=".$_SESSION['reqid']."";
$RsRequisicaoItens = mysql_query($query_RsRequisicaoItens, $conexao) or die(mysql_error());
$row_RsRequisicaoItens = mysql_fetch_assoc($RsRequisicaoItens);
$totalRows_RsRequisicaoItens = mysql_num_rows($RsRequisicaoItens);
 
?>
<html>
<head>
	<title>Requisi��o</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="charset=utf-8" />
	<link rel="stylesheet" href="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="jquery.mobile-1.4.5/jquery.js"></script>
	<script src="jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
  
  <style type="text/css">
<!--
.style2 {font-weight: bold}
-->
</style>	  
    

</head>

<body>

<div data-role="page">

  <div class="style2" data-role="header">
<h1>In�cio</h1>
        
	</div>
	<!-- /header -->

	<div role="main" class="ui-content">
    <h3>Item excluido com sucesso!</h3>
    <p><a href="requisicao_itens.php">Clique aqui para adicionar mais itens a sua Requisi��o</a></p>
  </div>
 
 
<div role="main" class="ui-content"> 
  <ul data-role="listview" data-split-icon="delete" data-theme="a" data-split-theme="b" data-inset="true">
   <?php do { ?>
   <li>
   <a href="#"><?php echo $row_RsRequisicaoItens['itemdesc'];  ?> <span class="ui-li-count"><?php echo $row_RsRequisicaoItens['reqitqnt'];?></span></a>
   <a href="?reqitid_del=<?php echo $row_RsRequisicaoItens['reqitid'];  ?>" data-position-to="window" >Purchase album</a>
   </li>
   <?php } while ($row_RsRequisicaoItens = mysql_fetch_assoc($RsRequisicaoItens)); ?>
   </ul>
   
</div>   
<!-- /content -->
<div data-role="footer">
<h4>SIGDados - CBMGO/9� BBM</h4>
</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
<?php
$mysql_free_result($RsRequisicaoItens);
?>

  
