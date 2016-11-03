<?php 
if (!isset($_SESSION)) {
  session_start();
}
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

<div data-role="panel" id="mypanel">

   <ul data-role="listview" data-count-theme="b" data-divider-theme="b" data-inset="true">
   <li data-icon="home"><a href="index.php">Início</a></li>
      <li data-icon="home"><a href="#" id="sair">Sair</a></li>

   </ul>

</div><!-- /panel -->

	<div class="style2" data-role="header">
		<a href="#mypanel" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Painel</a>
<h1>Início</h1>
        
	</div>
	<!-- /header -->

	<div role="main" class="ui-content">
    <p>Seja bem vindo, <?php echo $_SESSION['MM_postgrad'];?> <?php echo $_SESSION['MM_nomeguerra'] ;?></p>
		<p>Escolha qual Sistema deseja acessar</p>

        <ul data-role="listview">
    		<li><a href="requisicao_lista.php">
 			 	<h2>Requisição</h2>
    			<p>Requisição de Materiais de Consumo</p></a>
    		</li>
		
    		<li><a href="itens_lista.php">
      			<h2>Itens</h2>
    			<p>Lista Geral de Itens Cadastrados</p></a>
   			</li>
   		</ul>
	</div><!-- /content -->

	<div data-role="footer">
		<h4>SIGDados - CBMGO/9º BBM</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>