<?php require_once('Connections/conexao.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}


mysql_select_db($database_conexao, $conexao);

$query_RsItemNatureza = "SELECT itnatid, it_tipo_material, itemid, itemnatureza, item, count(*) as totalitemnatureza FROM vw_itensnatureza GROUP BY itemnatureza ";
$RsItemNatureza = mysql_query($query_RsItemNatureza, $conexao) or die(mysql_error());
$row_RsItemNatureza = mysql_fetch_assoc($RsItemNatureza);
$totalRows_RsItemNatureza = mysql_num_rows($RsItemNatureza);

if(isset($_GET['itemid'])) {
$itemid=$_GET['itemid'];
$query_RsItensLista = "SELECT * FROM vw_itensnatureza WHERE itemid=".$itemid.""	;
$RsItensLista = mysql_query($query_RsItensLista, $conexao) or die(mysql_error());
$row_RsItensLista = mysql_fetch_assoc($RsItensLista);
$totalRows_RsItensLista= mysql_num_rows($RsItensLista);
	}
?>
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

<div data-role="panel" id="mypanel">
   <p><a href="index.php">Início</a></p>
   <?php do { ?>
   <p><a href="itens_lista.php?itemnatureza=<?php echo $row_RsItemNatureza['itnatid']; ?>"><?php echo $row_RsItemNatureza['it_tipo_material'];  ?> (<?php echo $row_RsItemNatureza['totalitemnatureza'];?>) </a>
   </p>
   <?php } while ($row_RsItemNatureza = mysql_fetch_assoc($RsItemNatureza)); ?>

</div>
<!-- /panel -->
  <div class="style2" data-role="header">
		<a href="#mypanel" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Painel</a>
<h1>Início</h1>
        
	</div>
	<!-- /header -->

	<div role="main" class="ui-content">
       
        <ul data-role="listview" data-inset="true">

<li>
<a href="#"> <img src="../almox/imagens/itens_img/<?php echo $row_RsItensLista['itemimg']; ?>" width="80" border="0" /> 
<h2><?php echo $row_RsItensLista['item']; ?></h2>
<p><?php echo $row_RsItensLista['itemdesc']; ?></p>
</a>
</li>

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
mysql_free_result($RsItensLista);

mysql_free_result($RsItemNatureza);
?>
