<?php require_once('Connections/conexao.php'); ?>
<?php

mysql_select_db($database_conexao, $conexao);

$query_RsItemNatureza = "SELECT itnatid, it_tipo_material, itemid, itemnatureza, item, count(*) as totalitemnatureza FROM vw_estoqueitens  WHERE itnatid=itemnatureza AND itnatid <=9 GROUP BY itemnatureza ";
$RsItemNatureza = mysql_query($query_RsItemNatureza, $conexao) or die(mysql_error());
$row_RsItemNatureza = mysql_fetch_assoc($RsItemNatureza);
$totalRows_RsItemNatureza = mysql_num_rows($RsItemNatureza);

?>


<div data-role="panel" id="mypanel">

   <ul data-role="listview" data-count-theme="b" data-inset="true">
   <li data-icon="home"><a href="index.php">Início</a></li>
   <?php do { ?>
   <li><a href="?itemnatureza=<?php echo $row_RsItemNatureza['itnatid']; ?>"><?php echo $row_RsItemNatureza['it_tipo_material'];  ?> <span class="ui-li-count"><?php echo $row_RsItemNatureza['totalitemnatureza'];?></span> </a>
   </li>
   <?php } while ($row_RsItemNatureza = mysql_fetch_assoc($RsItemNatureza)); ?>
   </ul>

</div>