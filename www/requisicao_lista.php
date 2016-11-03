<?php require_once('Connections/conexao.php'); ?>
<?php require('func_getsqlvaluestring.php');

if (!isset($_SESSION)) {
  session_start();
}
require_once('func_acessorestrito.php');


mysql_select_db($database_conexao, $conexao);
$query_RsRequisicao = "SELECT * FROM vw_requisicao WHERE reqsolicitante=".$_SESSION['MM_usuid']."";
$RsRequisicao = mysql_query($query_RsRequisicao, $conexao) or die(mysql_error());
$row_RsRequisicao = mysql_fetch_assoc($RsRequisicao);
$totalRows_RsRequisicao = mysql_num_rows($RsRequisicao);

$_SESSION['secid'] = $row_RsRequisicao['secid']; 
?>
<html>
<head>
	<title>Início</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		<a href="#mypanel" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Painel</a>
        <h2>Requisição</h2>
  </div>
	<!-- /header -->
    
<?php include_once 'painel_esquerdo.php';?>

	<div role="main" class="ui-content">
    
    <!-- INICIO POP UP -->
    <a href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-b">Adiciona</a>
<div data-role="popup" id="popupDialog" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
    <div data-role="header" data-theme="a">
    <h1>Requisição</h1>
    </div>
    <div role="main" class="ui-content">
        <h3 class="ui-title">Tem certeza que deseja criar Requisição?</h3>
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
        <a href="requisicao.php" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">Sim</a>
    </div>
</div>
<!-- FIM DO POP UP -->

	  <ul data-role="listview" data-count-theme="b" data-divider-theme="b" data-inset="true">
      <?php do { ?>
        <li data-icon="home"><a href="requisicao_det.php?reqid=<?php echo $row_RsRequisicao['reqid']; ?>"><?php echo $row_RsRequisicao['reqid']; ?> - <?php echo $row_RsRequisicao['reqdata']; ?></a></li>
        <?php } while ($row_RsRequisicao = mysql_fetch_assoc($RsRequisicao)); ?>
   
   </ul>
</div><!-- /content -->

	<div data-role="footer">
		<h4>SIGDados - CBMGO/9º BBM</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>