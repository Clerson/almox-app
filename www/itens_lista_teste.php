<?php require_once('Connections/conexao.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

require_once 'func_acessorestrito.php';

mysql_select_db($database_conexao, $conexao);

$query_RsItemNatureza = "SELECT itnatid, it_tipo_material, itemid, itemnatureza, item, count(*) as totalitemnatureza FROM vw_estoqueitens  WHERE itnatid=itemnatureza AND itnatid <=9 GROUP BY itemnatureza ";
$RsItemNatureza = mysql_query($query_RsItemNatureza, $conexao) or die(mysql_error());
$row_RsItemNatureza = mysql_fetch_assoc($RsItemNatureza);
$totalRows_RsItemNatureza = mysql_num_rows($RsItemNatureza);

if(isset($_GET['itemnatureza'])) {
	$itemnatureza=$_GET['itemnatureza'];
	$query_RsItensLista = "SELECT * FROM vw_itensnatureza WHERE itemnatureza=".$itemnatureza.""	;
$RsItensLista = mysql_query($query_RsItensLista, $conexao) or die(mysql_error());
$row_RsItensLista = mysql_fetch_assoc($RsItensLista);
$totalRows_RsItensLista= mysql_num_rows($RsItensLista);
	
	} else {
$query_RsItensLista = "SELECT * FROM vw_itensnatureza"	;}
$RsItensLista = mysql_query($query_RsItensLista, $conexao) or die(mysql_error());
$row_RsItensLista = mysql_fetch_assoc($RsItensLista);
$totalRows_RsItensLista= mysql_num_rows($RsItensLista);
	
?>
<html>
<head>
	<title>ITENS</title>
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

<div data-role="panel" id="mypanel">

   <ul data-role="listview" data-count-theme="b" data-inset="true">
   <li data-icon="home"><a href="index.php">Início</a></li>
   <li data-icon="home"><a href="itens_lista_teste.php">Itens</a></li>
   </ul>

</div>
<!-- /panel -->

  <div class="style2" data-role="header">
		<a href="#mypanel" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Painel</a>
        
<h1>ITENS LISTA</h1>
        
	</div>
	<!-- /header -->

	<div role="main" class="ui-content">
    
       <ul data-role="listview" data-count-theme="b" data-inset="true">
   <?php do { ?>
   <li><a href="?itemnatureza=<?php echo $row_RsItemNatureza['itnatid']; ?>"><?php echo $row_RsItemNatureza['it_tipo_material'];  ?> <span class="ui-li-count"><?php echo $row_RsItemNatureza['totalitemnatureza'];?></span> </a>
   </li>
   <?php } while ($row_RsItemNatureza = mysql_fetch_assoc($RsItemNatureza)); ?>
   </ul>
   
   
<?php if(isset($_GET['itemnatureza'])) { ;?>
    <ul data-role="listview" data-filter="true" data-filter-placeholder="Pesquisar itens..." data-inset="true">

<?php do { ?>    
<li>
<a href="itens_det.php?itemid=<?php echo $row_RsItensLista['itemid'];?>"> <img src="../almox/imagens/itens_img/<?php echo $row_RsItensLista['itemimg']; ?>" width="80" border="0" /> 
<h3><?php echo $row_RsItensLista['item']; ?></h3>
<p><?php echo $row_RsItensLista['itemdesc']; ?></p>
</a>
</li>
  <?php } while ($row_RsItensLista = mysql_fetch_assoc($RsItensLista)); ?>
</ul>

<?php } ;?>

    </div>
    <div data-role="footer">
<h4>SIGDados - CBMGO/9º BBM</h4>
</div>
</div>
<!-- /pagina two -->
</body>
</html>
<?php
mysql_free_result($RsItensLista);

mysql_free_result($RsItemNatureza);
?>
