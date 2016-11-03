<?php 
mysql_select_db($database_conexao, $conexao);
$query_RsRequisicao_painel = "SELECT * FROM vw_requisicao WHERE reqsolicitante=".$_SESSION['MM_usuid']."";
$RsRequisicao_painel = mysql_query($query_RsRequisicao_painel, $conexao) or die(mysql_error());
$row_RsRequisicao_painel = mysql_fetch_assoc($RsRequisicao_painel);
$totalRows_RsRequisicao_painel = mysql_num_rows($RsRequisicao_painel);
?>

<div data-role="panel" id="mypanel">

   <ul data-role="listview" data-count-theme="b" data-divider-theme="b" data-inset="true">
   		<li data-icon="home"><a href="index.php">Início</a></li>
   		<li data-icon="home"><a href="requisicao.php">Requisicao</a></li>
        <li data-role="list-divider">Minhas Requisições</li>
      <?php do { ?>
      <li data-icon="home"><a href="requisicao_det.php?reqid=<?php echo $row_RsRequisicao_painel['reqid']; ?>"><?php echo $row_RsRequisicao_painel['reqid']; ?></a></li>
	<?php } while ($row_RsRequisicao_painel = mysql_fetch_assoc($RsRequisicao_painel)); ?>
   
   </ul>

</div><!-- /panel -->
