<?php
//This page let delete a topic
include('config.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
if(isset($_SESSION['fusername']))
{
	$dn1 = mysqli_fetch_array(mysqli_query($conn, 'select count(t.id) as nb1, t.title, t.parent, c.name from topics as t, categories as c where t.id="'.$id.'" and t.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
if($_SESSION['fusername']==$admin)
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; <a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; Удалить тему
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['confirm']))
{
	if(mysqli_query($conn, 'delete from topics where id="'.$id.'"'))
	{
	?>
	<div class="message">Тема успешно удалена<br />
	<a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>">Вернуться на "<?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?>"</a></div>
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
<form action="delete_topic.php?id=<?php echo $id; ?>" method="post">
	Вы уверены, что хотите удалить эту тему?
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
	echo '<h2>У вас нет прав для удаления этой темы</h2>';
}
}
else
{
	echo '<h2>Тема, которую вы хотите удалить, не существует.</h2>';
}
}
else
{
	echo '<h2>Чтобы иметь доступ к этой странице, вы должны войти как администратор: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>Тема не определена</h2>';
}
?>