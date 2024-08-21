<?php 
$host = 'localhost';
$user = 'root';
$passwd = '';
$db_name = 'mysql:dbname=loja';

$conn = new PDO("$db_name;$host", $user, $passwd);
?>