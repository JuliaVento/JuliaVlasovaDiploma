<?php
//This page let initialize the forum by checking for example if the user is logged
session_start();
header('Content-type: text/html;charset=UTF-8');
if(!isset($_SESSION['fusername']) and isset($_COOKIE['fusername'], $_COOKIE['fpassword']))
{
	$cnn = mysqli_query($conn, 'select fpassword,id from users where fusername="'.mysqli_real_escape_string($conn, $_COOKIE['fusername']).'"');
	$dn_cnn = mysqli_fetch_array($cnn);
	if(sha1($dn_cnn['fpassword'])==$_COOKIE['fpassword'] and mysqli_num_rows($cnn)>0)
	{
		$_SESSION['fusername'] = $_COOKIE['fusername'];
		$_SESSION['userid'] = $dn_cnn['id'];
	}
}
?>