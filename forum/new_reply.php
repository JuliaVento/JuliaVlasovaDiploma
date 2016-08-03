<?php
//This page let reply to a topic
include('config.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
if(isset($_SESSION['fusername']))
{
	$dn1 = mysqli_fetch_array(mysqli_query($conn, 'select count(t.id) as nb1, t.title, t.parent, c.name from topics as t, categories as c where t.id="'.$id.'" and t.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; <a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; Add a reply
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['message']) and $_POST['message']!='')
{
	include('bbcode_function.php');
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysqli_real_escape_string($conn, bbcode_to_html($message));
	if(mysqli_query($conn,'insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$dn1['parent'].'", "'.$id.'", max(id2)+1, "", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics where id="'.$id.'"') and mysqli_query($conn, 'update topics set timestamp2="'.time().'" where id="'.$id.'" and id2=1'))
	{
	?>
	<div class="message">Сообщение успешно отправлено<br />
	<a href="read_topic.php?id=<?php echo $id; ?>">Вернуться к теме</a></div>
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
<form action="new_reply.php?id=<?php echo $id; ?>" method="post">
    <label for="message">Сообщение</label><br />
    <div class="message_buttons">
        <input type="button" value="Жирный" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Курсив" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Подчеркивание" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Изображение" onclick="javascript:insert('[img]', '[/img]', 'message');" /><!--
        --><input type="button" value="Ссылка" onclick="javascript:insert('[url]', '[/url]', 'message');" /><!--
        --><input type="button" value="Слева" onclick="javascript:insert('[left]', '[/left]', 'message');" /><!--
        --><input type="button" value="По центру" onclick="javascript:insert('[center]', '[/center]', 'message');" /><!--
        --><input type="button" value="Справа" onclick="javascript:insert('[right]', '[/right]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea><br />
    <input type="submit" value="Отправить" />
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
	echo '<h2>Данной темы не существует</h2>';
}
}
else
{
?>
<h2>Чтобы иметь доступ к станице, вам нужно войти</h2>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="fusername">Имя</label><input type="text" name="fusername" id="fusername" /><br />
		<label for="fpassword">Пароль</label><input type="fpassword" name="fpassword" id="fpassword" /><br />
        <label for="memorize">Запомнить</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
	        <input type="submit" value="Login" /> <input type="button" onclick="javascript:document.location='signup.php';" value="Sign Up" />
        </div>
    </form>
</div>
<?php
}
}
else
{
	echo '<h2>Тема не определена</h2>';
}
?>