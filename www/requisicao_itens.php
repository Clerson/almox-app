<?php require_once('Connections/conexao.php'); ?>
<?php 

if (!isset($_SESSION)) {
  session_start();
}

require_once('func_acessorestrito.php');
require_once('func_getsqlvaluestring.php');


if(isset($_GET['acao'])) {  

	$_SESSION['secid'] = $_GET['secid'];
	$reqdata = date('Y-m-d H:i:s'); 
	$reqservico = "Diversos";
	$reqobservacao = "Requisicao solicitada atraves do Almox_mobile";
	$insertSQL = sprintf("INSERT INTO requisicao (reqdata, reqsolicitante, reqsecao, reqservico, reqobservacao, requsuario) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($reqdata, "text"),
                       GetSQLValueString($_SESSION['MM_usuid'], "text"),
                       GetSQLValueString($_SESSION['secid'], "text"),
                       GetSQLValueString($reqservico, "text"),
                       GetSQLValueString($reqobservacao, "text"),
                       GetSQLValueString($_SESSION['MM_usuid'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

  mysql_select_db($database_conexao, $conexao);
  $query_RequisicaoLista = "SELECT MAX(reqid) as reqid FROM requisicao";
  $RequisicaoLista = mysql_query($query_RequisicaoLista, $conexao) or die(mysql_error());
  $row_RequisicaoLista = mysql_fetch_assoc($RequisicaoLista); 
  
  $_SESSION['reqid'] = $row_RequisicaoLista['reqid'];

}


if(isset($_POST['form'])) {
	$itemqnt=$_POST['itemqnt'];
	$insertSQL = sprintf("INSERT INTO reqitens (req_id, reqitemid, reqitqnt) VALUES (%s, %s, %s)",
                       GetSQLValueString($_SESSION['reqid'], "text"),
                       GetSQLValueString($_SESSION['itemid'], "text"),
                       GetSQLValueString($itemqnt, "text"));

	mysql_select_db($database_conexao, $conexao);
	$Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
	
	}

 if ((isset($_GET['reqitid_del'])) && true) {
  $deleteSQL = sprintf("DELETE FROM reqitens WHERE req_id=".$_SESSION['reqid']." AND reqitid=%s",
                       GetSQLValueString($_GET['reqitid_del'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($deleteSQL, $conexao) or die(mysql_error());
  
}


mysql_select_db($database_conexao, $conexao);
$query_RsSomaQnt = "SELECT * FROM vw_estoqueitens WHERE est_itemqnt > 0"	;
$RsSomaQnt = mysql_query($query_RsSomaQnt, $conexao) or die(mysql_error());
$row_RsSomaQnt = mysql_fetch_assoc($RsSomaQnt);
$totalRows_RsSomaQnt = mysql_num_rows($RsSomaQnt);


 
 ;?>

<html>
<head>
	<title>Requisição</title>
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

<?php include('itensnatureza_lista.php');?>

<div class="style2" data-role="header">
		<a href="#mypanel" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Painel</a>
        <h1>Requisição</h1>
  </div>
	<!-- /header -->
    
<?php include_once 'painel_esquerdo.php';?>

<div data-role="panel" id="mypanel">

   <ul data-role="listview" data-count-theme="b" data-divider-theme="b" data-inset="true">
   		<li data-icon="home"><a href="index.php">Início</a></li>
   		<li data-icon="home"><a href="logout.php">Sair</a></li>
   </ul>
   
   </div>
   
	<div role="main" class="ui-content"> 

                   
    	<p>Usuário: <?php echo $_SESSION['MM_usuid']; ?> | Seção: <?php echo $_SESSION['secid']; ?> | Requisição: <?php echo $_SESSION['reqid']; ?></p>

<?php include_once 'requisicao_itens_lista.php';?>


        <ul data-role="listview" data-filter="true" data-filter-placeholder="Pesquisar itens..." data-inset="true">
			<?php do { ?>    
				<li><a href="requisicao_itens_add.php?itemid=<?php echo $row_RsSomaQnt['itemid'];?>"> 
						<h2><?php echo $row_RsSomaQnt['item']; ?></h2>
						<p><?php echo $row_RsSomaQnt['itemdesc']; ?></p>
					</a>
				</li>
  			<?php } while ($row_RsSomaQnt = mysql_fetch_assoc($RsSomaQnt)); ?>
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
mysql_free_result($RsSomaQnt);
?>

