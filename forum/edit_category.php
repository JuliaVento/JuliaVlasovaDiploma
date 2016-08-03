<?php
//This page let an administrator edit a category
include('config.php');
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysqli_fetch_array(mysqli_query($conn, 'select count(id) as nb1, name, description from categories where id="'.$id.'" group by id'));
if($dn1['nb1']>0)
{
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">
        <div class="content">
<?php
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn, 'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> &gt; Редактировать категорию
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
	$name = mysqli_real_escape_string($conn,$name);
	$description = mysqli_real_escape_string($conn,$description);
	if(mysqli_query($conn, 'update categories set name="'.$name.'", description="'.$description.'" where id="'.$id.'"'))
	{
	?>
	<div class="message">Категория успешно отредактирована<br />
	<a href="<?php echo $url_home; ?>">На главную страницу форума</a></div>
	<?php
	}
	else
	{
		echo 'Произошла ошибка';
	}
}
else
{
?>
<form action="edit_category.php?id=<?php echo $id; ?>" method="post">
	<label for="name">Название</label><input type="text" name="name" id="name" value="<?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?>" /><br />
	<label for="description">Описание</label>(Включен HTML)<br />
    <textarea name="description" id="description" cols="70" rows="6"><?php echo htmlentities($dn1['description'], ENT_QUOTES, 'UTF-8'); ?></textarea><br />
    <input type="submit" value="Edit" />
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
	echo '<h2>Чтобы иметь доступ к этой странице, вы должны зайти как администратор: <a href="login.php">Войти</a> - <a href="signup.php">Зарегистрироваться</a></h2>';
}
}
else
{
	echo '<h2>Данной категории не существует</h2>';
}
}
else
{
	echo '<h2>Категория не определена</h2>';
}
?>