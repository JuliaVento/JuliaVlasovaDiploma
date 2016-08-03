<!DOCTYPE HTML>
<html>

<head>
<title>Форум</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, inicial-scale = 1.0">
<link rel="stylesheet" type="text/css" href="../css/styleside.css">
<meta name="keywords" lang="ru" content=""/>
<meta name="description" content=""/>
<link rel="icon" type="image/png" href="../images/favicon.png" />
<script src="../js/form.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../js/appearingForms.js" type="text/javascript"></script>
<script src="../js/adaptive.js" type="text/javascript"></script>


</head>


<body>
<noscript>
Вероятно, у вас отключен JavaScript.
</noscript>
<div class="wrapper">
<div class="logo">
<img alt="" src="../images/logo.png" alt="тайцзи логотип">
</div>
	<div class="header">
		<h1>Серебряная нить тайцзи</h1>
		
	</div>
	
<!-- Верхнее меню -->			
	
		<ul class="main_menu">
		<li><a href="index.php"><div class="menu_circle1"> <p>Главная</p><img alt="" src="../images/main.png"></div></a></li>
		<li><a href="../CMS/?action=homepageNews"><div class="menu_circle2"><p>Новости</p><img alt="" src="../images/news.png"></div></a></li>
		<li><a href="../CMS/?action=homepage"><div class="menu_circle3"><p>Статьи</p><img alt="" src="../images/articles.png"></div></a></li>
		<li><a href="#" class="active"><div class="menu_circle4"><p>Форум</p><img alt="" src="../images/forum.png"></div></a></li>
		
		</ul>
	


<!-- Боковое меню -->	
	
	<ul class="side_menu" id="menu">
		<li class="firstli"><a href="thaichi.php">Тайцзи</a>
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
<p class="enter">Войти на форум!</p>
<p class="registrate">Регистрация</p>

<div id="form_enter">
		<form name="Form1" onsubmit="check();">
			<p>Вход на тайцзи-форум</p>
				<p>Логин: <input type="text" name="yourlogin"  /> <span id="e_login" style="display: none; color: #c00;">Логин введён неправильно</span></p>
<p>Пароль: <input type="password" name="pas"  /> <span id="e_pas" style="display: none; color: #c00;">Пароль введён неправильно</span></p>				
					
				<input type="button" value="Войти" onclick="check()" />	
			
			
		</form>
	</div>

	<div id="form_reg">
		<form name="myForm" onsubmit="return validate(this); ">
			<table>
			<tr><td colspan="3" align="center"><h3>Регистрация для участия в тайцзи-форуме</h3></td></tr>

				<tr><td>Имя *</td><td><input type="text" name="username" maxlength = "16" ></td></tr>	
				<tr><td>Фамилия *</td><td><input type="text" name="surname" maxlength = "16" ></td></tr>
				<tr><td>Логин *</td><td><input type="text" name="login" maxlength = "10" ></td></tr>	
				<tr><td>Пароль *</td><td><input type="password" name="pass1" maxlength = "10"></td></tr>	
				<tr><td>Повторите пароль *</td><td><input type="password" name="pass2" maxlength = "10"></td></tr>	
				<tr><td>E-mail *</td><td><input type="text" name="mail" maxlength = "24"></td></tr>	
				<tr><td></td><td><input  type="submit"  value="Зарегистрироваться"></td></tr>	
			
			</table>
		</form>
	</div>
		</div>	
		</div>

		

			<div class="footer">
	<p>@2015 Юлия Власова</p>
	</div>


	<!-- Содержание -->	
	
</div>

</body>
</html>