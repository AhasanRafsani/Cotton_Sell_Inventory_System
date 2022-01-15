<?php
class Database
{

protected function dbConnection()
{
	$hostName='localhost';
	$userName="root";
	$password="";
	$dbName='sell';

$link=mysqli_connect($hostName,$userName,$password,$dbName);
return $link;
}
}
?>