<!DOCTYPE HTML>
<html>

<head>
<title>Статьи - <?php echo htmlspecialchars( $results['article']->title )?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, inicial-scale = 1.0">
<link rel="stylesheet" type="text/css" href="../css/styleside.css">
<meta name="keywords" lang="ru" content=""/>
<meta name="description" content=""/>
<link rel="icon" type="image/png" href="../images/favicon.png" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="../js/stickMenu.js" type="text/javascript"></script>
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
		<li><a href="../php/index.php"><div class="menu_circle1 icon"> <p>Главная</p><img src="../images/main.png"></div></a></li>
		<li><a href="../CMS/?action=homepageNews"><div class="menu_circle2 icon"><p>Новости</p><img src="../images/news.png"></div></a></li>
		<li><a href="../CMS/?action=homepage" class="active"><div class="menu_circle3 icon"><p>Статьи</p><img src="../images/articles.png"></div></a></li>
		<li><a href="../forum/index.php"><div class="menu_circle4 icon"><p>Форум</p><img src="../images/forum.png"></div></a></li>
		
		</ul>
		<div class="crutch"></div>


<!-- Боковое меню -->	
	
	<ul class="side_menu" id="menu">
		<li class="firstli"><a href="../php/thaichi.php">Тайцзи</a>
			<ul>
				<li>
					<a href="../php/thaichi_history.php">История</a>
				</li>
				<li>
					<a href="../php/thaichi_media.php">Медиатека</a>
				</li>
				<li>
					<a href="../php/thaichi_styles.php">Стили тайцзи</a>
				</li>
				<li>
					<a href="../php/thaichi_schools.php">Школы тайцзи</a>
				</li>
			</ul>
		
		
		</li>
		<li><a href="../php/cigun.php">Цигун</a>
		<ul>
				<li>
					<a href="../php/cigun_history.php">История </a>
				</li>
				<li>
					<a href="../php/cigun_media.php">Медиатека</a>
				</li>
				<li>
					<a href="../php/cigun_styles.php">Виды цигуна</a>
				</li>
			</ul>
		
		</li>
		<li><a href="../php/technics.php">Упражнения</a>
		<ul>
				<li>
					<a href="../php/thaichi_tech.php">Упражнения тайцзи</a>
				</li>
				<li>
					<a href="../php/cigun_tech.php">Упражнения цигуна</a>
				</li>
				
			</ul>
		
		
		</li>
		<li><a href="../php/china.php">О Китае</a></li>
</ul>
<div class="sideMenHidden"></div>