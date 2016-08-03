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
	

		<div id="contactFormArea">
			<form action="submit.php" method="post" id="cForm">
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
			<td><p class="antispam">Для роботов (не заполняйте):
			<br /><input name="url" /></p></td>
			<td></td>
			</tr>

			<tr>
			<td><label for="posText"><b>Сообщение:</b></label></td>
			<td><textarea cols="30" rows="10" name="posText" id="posText"></textarea></td>
			</tr>

			
			</table>




			<br><label><input class="submit" type="submit" name="selfCC" id="selfCC" value=" Отправить " onclick="return validate(this.form)"/></label>
			</fieldset>
		
			</form>
		</div>
	<p>Мой e-mail:
	<script type="text/javascript">
		document.write('<a href="mailto:'+first + '@' + last+'">'+first + '@' + last+'<\/a>');
	</script>
	<noscript>
	Please enable javascript or use the contact form.
	</noscript>
	</p>
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