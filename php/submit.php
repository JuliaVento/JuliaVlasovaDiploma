<?php

// if the url field is empty

//http://www.nfriedly.com/techblog/2009/11/how-to-build-a-spam-free-contact-forms-without-captchas/
if(isset($_POST['url']) && $_POST['url'] == ''){

	// put your email address here
	$youremail = 'cherrygarden@live.ru';

	// prepare a "pretty" version of the message
	// Important: if you added any form fields to the HTML, you will need to add them here also
	$body = "This is the form that was just submitted:
	Name:  $_POST[posName]
	E-Mail: $_POST[posEmail]
	Message: $_POST[posText]";

	// Use the submitters email if they supplied one
	// (and it isn't trying to hack your form).
	// Otherwise send from your email address.
	if( $_POST['posEmail'] && !preg_match( "/[\r\n]/", $_POST['posEmail']) ) {
	  $headers = "From: $_POST[posEmail]";
	} else {
	  $headers = "From: $youremail";
	}

	// finally, send the message
	mail($youremail, 'Contact Form', $body, $headers );

}

// otherwise, let the spammer think that they got their message through

?>
<!DOCTYPE HTML>
<html>

<head>
<title>Обратная связь</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, inicial-scale = 1.0">
<link rel="stylesheet" type="text/css" href="../css/styleside.css">
<meta name="keywords" lang="ru" content=""/>
<meta name="description" content=""/>
<link rel="icon" type="image/png" href="../images/favicon.png" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="../js/stickMenu.js" type="text/javascript"></script>
<script src="../js/feedValidate.js" type="text/javascript"></script>
<script type="text/javascript">
		// split your email into two parts and remove the @ symbol
		var first = "cherrygarden";
		var last = "live.ru";
	</script>
	<script src="../js/adaptive.js" type="text/javascript"></script>
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
		<li><a href="index.php"><div class="menu_circle1 icon"> <p>Главная</p><img alt="главная" src="../images/main.png"></div></a></li>
		<li><a href="../CMS/?action=homepageNews"><div class="menu_circle2 icon"><p>Новости</p><img alt="новости" src="../images/news.png"></div></a></li>
		<li><a href="../CMS/?action=homepage"><div class="menu_circle3 icon"><p>Статьи</p><img alt="статьи" src="../images/articles.png"></div></a></li>
		<li><a href="../forum/index.php"><div class="menu_circle4 icon"><p>Форум</p><img alt="форум" src="../images/forum.png"></div></a></li>
		
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
				<li>
					<a href="thaichi_schools.php">Школы тайцзи</a>
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
					<a href="cigun_styles.php">Виды цигуна</a>
				</li>
			</ul>
		
		</li>
		<li><a href="technics.php">Упражнения</a>
		<ul>
				<li>
					<a href="thaichi_tech.php">Упражнения тайцзи</a>
				</li>
				<li>
					<a href="cigun_tech.php">Упражнения цигуна</a>
				</li>
				
			</ul>
		
		
		</li>
		<li><a href="china.php">О Китае</a></li>
</ul>
	<div class="sideMenHidden"></div>	
	
<!-- Боковое меню -->
<!-- Верхнее меню -->
<!-- Содержание -->	
	<div class="article">
	<div class="content_block">
		<h2>Обратная связь</h2>
<br><br>
<h3>Благодарю за письмо!</h3>
<p>Я свяжусь с вами как можно скорее!</p>

</div>	
		</div>

	<div class="footer">
		<p><a href="sitemap.php">Карта сайта</a><br>
		<a href="feedback.php" class="active">Обратная связь</a><br>
		@2015 Юлия Власова
		</p>
	</div>

	<!-- Содержание -->	
	
</div>

</body>
</html>