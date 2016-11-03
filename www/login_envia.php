<?php 

require_once('Connections/conexao.php');
require_once('func_getsqlvaluestring.php');

if (!isset($_SESSION)) {
  session_start();
} 


if (isset($_GET['usuario'])) {
  $loginUsername=$_GET['usuario'];
  $password=$_GET['senha'];
  
  mysql_select_db($database_conexao, $conexao);
  	
  $LoginRS__query=sprintf("SELECT * FROM vw_efetpostgrad WHERE efetrg=%s AND efetsenha=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'efetnivel');
  	$login  = mysql_result($LoginRS,0,'efetrg');
  	$usuid  = mysql_result($LoginRS,0,'efetid');
  	$nome  = mysql_result($LoginRS,0,'efetnome');
  	$status  = mysql_result($LoginRS,0,'efetstatus');
  	$usuimg  = mysql_result($LoginRS,0,'efetimg');
  	$postgrad  = mysql_result($LoginRS,0,'postograd');
  	$nomeguerra  = mysql_result($LoginRS,0,'efetnomeguerra');
	
	
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	
  	$_SESSION['MM_usuid'] = $usuid;
  	$_SESSION['MM_usunome'] = $nome;
  	$_SESSION['MM_status'] = $status;
  	$_SESSION['MM_usuimg'] = $usuimg;
  	$_SESSION['MM_postgrad'] = $postgrad;
  	$_SESSION['MM_nomeguerra'] = $nomeguerra;
	      

    
?>