<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexao = "sql108.byethost9.com";
$database_conexao = "b9_18777122_almox";
$username_conexao = "b9_18777122";
$password_conexao = "cbm6916";
$conexao = @mysql_connect($hostname_conexao, $username_conexao, $password_conexao) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
