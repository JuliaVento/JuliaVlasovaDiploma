<?php
//This page let delete a category
include('config.php');
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysqli_fetch_array(mysqli_query($conn,'select count(id) as nb1, name, position from categories where id="'.$id.'" group by id'));
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
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?> &gt; Удалить категорию
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['confirm']))
{
	if(mysqli_query($conn,'delete from categories where id="'.$id.'"') and mysqli_query($conn,'delete from topics where parent="'.$id.'"') and mysqli_query($conn,'update categories set position=position-1 where position>"'.$dn1['position'].'"'))
	{
	?>
	<div class="message">Категория вместе с темами успешно удалена<br />
	<a href="<?php echo $url_home; ?>">Вернуться на главную страницу форума</a></div>
	<?php
	}
	else
	{
		echo 'Произошла непредвиденная ошибка';
	}
}
else
{
?>
<form action="delete_category.php?id=<?php echo $id; ?>" method="post">
	Вы уверены, что хотите удалить эту категорию вместе со всеми ее темами?
    <input type="hidden" name="confirm" value="true" />
    <input type="submit" value="Да" /> <input type="button" value="Нет" onclick="javascript:history.go(-1);" />
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
	echo '<h2>Чтобы иметь доступ к этой странице, вы должны войти как администратор: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>Категория, которую вы хотите удалить, не существует</h2>';
}
}
else
{
	echo '<h2>Категория не определена</h2>';
}
?>