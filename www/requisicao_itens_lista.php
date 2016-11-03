<?php 
if (!isset($_SESSION)) {
  session_start();
}
mysql_select_db($database_conexao, $conexao);
$query_RsRequisicaoItensLista = "SELECT * FROM vw_reqitens WHERE req_id=".$_SESSION['reqid']." ORDER BY reqitid DESC";
$RsRequisicaoItensLista = mysql_query($query_RsRequisicaoItensLista, $conexao) or die(mysql_error());
$row_RsRequisicaoItensLista = mysql_fetch_assoc($RsRequisicaoItensLista);
$totalRows_RsRequisicaoItensLista = mysql_num_rows($RsRequisicaoItensLista);


 ;?>
<?php if ($totalRows_RsRequisicaoItensLista > 0) { // Show if recordset not empty ?>
  <ul data-role="listview" data-split-icon="delete" data-theme="a" data-split-theme="b" data-inset="true">
    <?php do { ?>
      <li><a href=""><?php echo $row_RsRequisicaoItensLista['itemdesc']; ?></a>
        <a href="?reqitid_del=<?php echo $row_RsRequisicaoItensLista['reqitid'];?>" data-position-to="window" >Purchase album</a>
      </li>
      
      <?php } while ($row_RsRequisicaoItensLista = mysql_fetch_assoc($RsRequisicaoItensLista)); ?>
  </ul>
  <?php } // Show if recordset not empty ?>
