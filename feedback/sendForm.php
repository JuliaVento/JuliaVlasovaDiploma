 <?php
session_start();
include('kcaptcha/kcaptcha.php');

require_once("config.php");


if ($_POST['act']== "y")
{
if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['keystring'])
{

if (isset($_POST['posName']) && $_POST['posName'] == "")
{
$statusError = "$errors_name";
}
elseif (isset($_POST['posEmail']) && $_POST['posEmail'] == "")
{
$statusError = "$errors_mailfrom";
}
elseif(isset($_POST['posEmail']) && !preg_match("/^([a-z,._,0-9])+@([a-z,._,0-9])+(.([a-z])+)+$/", $_POST['posEmail']))
{
$statusError = "$errors_incorrect";

unset($_POST['posEmail']);
}
elseif (isset($_POST['posRegard']) && $_POST['posRegard'] == "")
{
$statusError = "$errors_subject";
}
elseif (isset($_POST['posText']) && $_POST['posText'] == "")
{
$statusError = "$errors_message";
}

elseif (!empty($_POST))
{
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: $content  charset=$charset\r\n";
$headers .= "Date: ".date("Y-m-d (H:i:s)",time())."\r\n";
$headers .= "From:".$_POST['posName']." ".$_POST['posEmail'];
$headers .= "X-Mailer: My Send E-mail\r\n";

mail("$mailto","$subject","$message","$headers");

unset($name, $posText, $mailto, $subject, $posRegard, $message);

$statusSuccess = "$send";
}

}else{
$statusError = "$captcha_error";
unset($_SESSION['captcha_keystring']);
}
}
?>





<!DOCTYPE HTML>
<html>

<head>
<title>Обратная связь</title>
<meta HTTP-EQUIV=”Content-Type” content="text/html" charset="utf-8">
<meta name="viewport" content="width=device-width, inicial-scale = 1.0">
<link rel="stylesheet" type="text/css" href="../css/styleside.css">
<meta name="keywords" lang="ru" content=""/>
<meta name="description" content=""/>
<link rel="icon" type="image/png" href="../images/favicon.png" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="../js/stickMenu.js" type="text/javascript"></script>
<script src="../js/feedValidate.js" type="text/javascript"></script>

</head>


<body>

<div class="wrapper">
<div class="logo">
<img src="../images/logo.png" alt="тайцзи логотип">
</div>
	<div class="header">
		<h1>Серебряная нить тайцзи</h1>
		
	</div>
	
<!-- Верхнее меню -->			
	
		<ul class="main_menu">
		<li><a href="index.php"><div class="menu_circle1 icon"> <p>Главная</p><img src="../images/main.png"></div></a></li>
		<li><a href="../CMS/?action=homepageNews"><div class="menu_circle2 icon"><p>Новости</p><img src="../images/news.png"></div></a></li>
		<li><a href="../CMS/?action=homepage"><div class="menu_circle3 icon"><p>Статьи</p><img src="../images/articles.png"></div></a></li>
		<li><a href="../forum/index.php"><div class="menu_circle4 icon"><p>Форум</p><img src="../images/forum.png"></div></a></li>
		
		</ul>
		<div class="crutch"></div>


<!-- Боковое меню -->	
	
	<ul class="side_menu" id="menu">
		<li class="firstli"><a href="thaichi.php" >Тайцзи</a>
			<ul>
				<li>
					<a href="thaichi_history.php">История</a>
				</li>
				<li>
					<a href="thaichi_media.php">Медиатека</a>
				</li>
				<li>
					<a href="thaichi_styles.php">Стили тайцзи</a>
				</li>
			</ul>
		
		
		</li>
		<li><a href="cigun.php">Цигун</a>
		<ul>
				<li>
					<a href="cigun_history.php">История </a>
				</li>
				<li>
					<a href="cigun_media.php">Медиатека</a>
				</li>
				<li>
					<a href="cigun_styles.php">Виды цигун</a>
				</li>
			</ul>
		
		</li>
		<li><a href="technics.php">Техника</a>
		<ul>
				<li>
					<a href="thaichi_tech.php">Техника тайцзи</a>
				</li>
				<li>
					<a href="cigun_tech.php">Техника цигун</a>
				</li>
				
			</ul>
		
		
		</li>
		<li><a href="china.php">О Китае</a></li>
</ul>
		
	
<!-- Боковое меню -->
<!-- Верхнее меню -->
<!-- Содержание -->	
	<div class="article">
	<div class="content_block">
		<h2>Обратная связь</h2>
		
<p id="emailSuccess">
<strong style="color:green;"><?php echo "$statusSuccess" ?></strong>
</p>
<p id="emailError"><strong style="color:red;"><?php echo "$statusError" ?></strong></p>

<div id="contactFormArea">
<form action="./" method="post" id="cForm">
<input type="hidden" name="act" value="y" />
<fieldset>

<table>
<tr>
<td><label for="posName"><b>Ваше имя:</b></label></td>
<td><input class="text" type="text" size="25" name="posName" id="posName" /></td>
</tr>

<tr>
<td><label for="posEmail"><b>Ваш E-mail адрес:</b></label></td>
<td><input class="text" type="text" size="25" name="posEmail" id="posEmail" /></td>
</tr>

<tr>
<td><label for="posRegard"><b>Тема сообщения:</b></label></td>
<td><input class="text" type="text" size="25" name="posRegard" id="posRegard" /></td>
</tr>

<tr>
<td><label for="posText"><b>Сообщение:</b></label></td>
<td><textarea cols="40" rows="10" name="posText" id="posText"></textarea></td>
</tr>

<tr>
<td><label for="posCaptcha">
<center><b>Текст на изображении (цифры)</b>:<br>
</label><img src="kcaptcha?<?php echo session_name()?>=<?php echo session_id()?>" ></center></td>
<td><input class="text" type="text" size="25" name="keystring" id="keystring" /></td>
</tr>
</table>




<br><label><input class="submit" type="submit" name="selfCC" id="selfCC" value=" Отправить " onclick="return validate(this.form)"/></label>
</fieldset>
<?php include 'kcaptcha/kcaptcha_rand.php' ?>
</form>
</div>

</div>	
		</div>

	<div class="footer">
		<p><a href="sitemap.php">Карта сайта</a><br>
		<a href="#" class="active">Обратная связь</a><br>
		@2015 Юлия Власова
		</p>
	</div>

	<!-- Содержание -->	
	
</div>

</body>
</html>