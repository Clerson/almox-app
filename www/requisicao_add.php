<?php require_once('Connections/conexao.php'); ?>
<?php require('func_getsqlvaluestring.php');

if (!isset($_SESSION)) {
  session_start();
}
require_once('func_acessorestrito.php');

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
  $query_RequisicaoLista = "SELECT reqid FROM requisicao ORDER BY reqid DESC";
  $RequisicaoLista = mysql_query($query_RequisicaoLista, $conexao) or die(mysql_error());
  $row_RequisicaoLista = mysql_fetch_assoc($RequisicaoLista); 
  
  $_SESSION['reqid'] = $row_RequisicaoLista['reqid'];
   ;?>
   
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
	<div role="main" class="ui-content">

        <ul data-role="listview" data-inset="false">
    <li><a href="requisicao_itens.php">
  <h2>Requisição criada com sucesso!</h2>
    	<p>Clique aqui para adicionar itens</p></a>
    </li>
   
</ul>
	</div><!-- /content -->

	<div data-role="footer">
		<h4>SIGDados - CBMGO/9º BBM</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>

