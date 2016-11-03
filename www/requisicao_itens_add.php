<?php require_once('Connections/conexao.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once('func_acessorestrito.php');

require_once('func_getsqlvaluestring.php'); 

$_SESSION['itemid'] = $_GET['itemid'];
 
mysql_select_db($database_conexao, $conexao);
$query_RsSomaQnt = "SELECT * FROM vw_estoqueitens WHERE est_itemqnt > 0 AND itemid=".$_SESSION['itemid'].""	;
$RsSomaQnt = mysql_query($query_RsSomaQnt, $conexao) or die(mysql_error());
$row_RsSomaQnt = mysql_fetch_assoc($RsSomaQnt);
$totalRows_RsSomaQnt = mysql_num_rows($RsSomaQnt);

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

<!-- /panel -->
  <div class="style2" data-role="header">
		<a href="index.php" class="ui-btn ui-shadow ui-corner-all ui-icon-home ui-btn-icon-notext"></a>
<h1>Início</h1>
        
	</div>
	<!-- /header -->

	<div role="main" class="ui-content">
    
    <p>Usuário: <?php echo $_SESSION['MM_usuid']; ?> | Seção: <?php echo $_SESSION['secid']; ?> | Requisição: <?php echo $_SESSION['reqid']; ?> | Item: <?php echo $_SESSION['itemid']; ?></p>

            <img src="../almox/imagens/itens_img/<?php echo $row_RsSomaQnt['itemimg']; ?>" width="60" border="0" />
            <h3><?php echo $row_RsSomaQnt['itemdesc'];?></h3>
            <p>Quant: <?php echo $row_RsSomaQnt['est_itemqnt'];?> <?php echo $row_RsSomaQnt['itemun'];?></p>

<form action="requisicao_itens.php" method="post">
<label for="number-pattern">Quantidade:</label>
<fieldset class="ui-field-contain">
<select name="itemqnt" id="itemqnt">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
    </select>

</fieldset>
<input name="form" type="hidden" id="form" value="">
<button type="submit" class="ui-btn ui-corner-all ui-btn-a">Enviar</button>
  

</form>
    
   
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
