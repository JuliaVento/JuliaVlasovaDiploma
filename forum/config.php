<?php
/******************************************************
------------------Required Configuration---------------
Please edit the following variables so the forum can
work correctly.
******************************************************/

//We log to the DataBase

$host = 'localhost'; // адрес сервера 
$database = 'tforum'; // имя базы данных
$user = 'root'; // имя пользователя
$fpassword = 'root'; // пароль
$conn = mysqli_connect($host,$user,$fpassword,$database);
//mysql_connect('localhost', 'root', 'root');
//mysql_select_db('tforum');

//Username of the Administrator
$admin='JuliaVento';

/******************************************************
-----------------Optional Configuration----------------
******************************************************/

//Forum Home Page
$url_home = 'index.php';

//Design Name
//$design = 'default';


/******************************************************
----------------------Initialization-------------------
******************************************************/
include('init.php');
?>