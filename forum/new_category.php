<?php
//This page let create a new category
include('config.php');
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">	
        <div class="content">
<?php
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">На главную форума</a> &gt; Новая категория
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['name'], $_POST['description']) and $_POST['name']!='')
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	if(get_magic_quotes_gpc())
	{
		$name = stripslashes($name);
		$description = stripslashes($description);
	}
	$name = mysqli_real_escape_string($conn, $name);
	$description = mysqli_real_escape_string($conn, $description);
	if(mysqli_query($conn,'insert into categories (id, name, description, position) select ifnull(max(id), 0)+1, "'.$name.'", "'.$description.'", count(id)+1 from categories'))
	{
	?>
	<div class="message">Категория успешно создана!<br />
	<a href="<?php echo $url_home; ?>">Вернуться на главную страницу форума</a></div>
	<?php
	}
	else
	{
		echo 'При создании категории была допущена ошибка';
	}
}
else
{
?>
<form action="new_category.php" method="post">
	<label for="name">Название</label><input type="text" name="name" id="name" /><br />
	<label for="description">Описание</label>(можно использовать HTML)<br />
    <textarea name="description" id="description" cols="70" rows="6"></textarea><br />
    <input type="submit" value="Создать" />
</form>
<?php
}
?>
		</div>
 </div>
	 </div>
<?php include ('include/footer.php'); ?>
<?php
}
else
{
	echo '<h2>Чтобы войти на эту страницу, вы должны быть администратором: <a href="login.php">Войти</a> - <a href="signup.php">Зарегистрироваться</a></h2>';
}
?>