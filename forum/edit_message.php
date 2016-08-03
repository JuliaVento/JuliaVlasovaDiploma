<?php
//This page let an user edit a message
include('config.php');
if(isset($_GET['id'], $_GET['id2']))
{
	$id = intval($_GET['id']);
	$id2 = intval($_GET['id2']);
if(isset($_SESSION['fusername']))
{
	$dn1 = mysqli_fetch_array(mysqli_query($conn, 'select count(t.id) as nb1, t.authorid, t2.title, t.message, t.parent, c.name from topics as t, topics as t2, categories as c where t.id="'.$id.'" and t.id2="'.$id2.'" and t2.id="'.$id.'" and t2.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
if($_SESSION['userid']==$dn1['authorid'] or $_SESSION['fusername']==$admin)
{
include('bbcode_function.php');
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; <a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; Редактировать ответ
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['message']) and $_POST['message']!='')
{
	if($id2==1)
	{
		if($_SESSION['fusername']==$admin and isset($_POST['title']) and $_POST['title']!='')
		{
			$title = $_POST['title'];
			if(get_magic_quotes_gpc())
			{
				$title = stripslashes($title);
			}
			$title = mysqli_real_escape_string($conn, $dn1['title']);
		}
		else
		{
			$title = mysqli_real_escape_string($conn, $dn1['title']);
		}
	}
	else
	{
		$title = '';
	}
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysqli_real_escape_string($conn, bbcode_to_html($message));
	if(mysqli_query($conn, 'update topics set title="'.$title.'", message="'.$message.'" where id="'.$id.'" and id2="'.$id2.'"'))
	{
	?>
	<div class="message">Сообщение успешно отредактировано<br />
	<a href="read_topic.php?id=<?php echo $id; ?>">Вернуться к теме</a></div>
	<?php
	}
	else
	{
		echo 'An error occurred while editing the message.';
	}
}
else
{
?>
<form action="edit_message.php?id=<?php echo $id; ?>&id2=<?php echo $id2; ?>" method="post">
<?php
if($_SESSION['fusername']==$admin and $id2==1)
{
?>
	<label for="title">Название</label><input type="text" name="title" id="title" value="<?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?>" />
<?php
}
?>
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
    <textarea name="message" id="message" cols="70" rows="6"><?php echo html_to_bbcode($dn1['message']); ?></textarea><br />
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
	echo '<h2>У вас нет прав для редактирования этого сообщения</h2>';
}
}
else
{
	echo '<h2>Сообщения не существует</h2>';
}
}
else
{
?>
<h2>Чтобы иметь доступ к этой странице, вам нужно войти</h2>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="fusername">Имя</label><input type="text" name="fusername" id="fusername" /><br />
		<label for="fpassword">Пароль</label><input type="fpassword" name="fpassword" id="fpassword" /><br />
        <label for="memorize">Запомнить</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
	        <input type="submit" value="Войти" /> <input type="button" onclick="javascript:document.location='signup.php';" value="Зарегистрироваться" />
        </div>
    </form>
</div>
<?php
}
}
else
{
	echo '<h2>Сообщение не определено</h2>';
}
?>