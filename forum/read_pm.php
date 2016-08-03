<?php
//This page display a personnal message
include('config.php');
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">
<?php
if(isset($_SESSION['fusername']))
{
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$req1 = mysqli_query($conn, 'select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
$dn1 = mysqli_fetch_array($req1);
if(mysqli_num_rows($req1)==1)
{
if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
{
if($dn1['user1']==$_SESSION['userid'])
{
	mysqli_query($conn, 'update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	mysqli_query($conn, 'update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
$req2 = mysqli_query($conn, 'select pm.timestamp, pm.message, users.id as userid, users.fusername, users.avatar from pm, users where pm.id="'.$id.'" and users.id=pm.user1 order by pm.id2');
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysqli_real_escape_string($conn, nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	if(mysqli_query($conn, 'insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysqli_num_rows($req2))+1).'", "", "'.$_SESSION['userid'].'", "", "'.$message.'", "'.time().'", "", "")') and mysqli_query($conn, 'update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
	{
?>
<div class="message">Ваш ответ успешно отправлен<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Вернуться к почтовому ящику</a></div>
<?php
	}
	else
	{
?>
<div class="message">Произошла ошибка<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Вернуться к почтовому ящику</a></div>
<?php
	}
}
else
{
?>
<div class="content">
<?php
if(isset($_SESSION['fusername']))
{
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn, 'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_pm.php">Список ваших писем</a> &gt; Читать почту
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
<?php
}
else
{
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_pm.php">Список ваших писем</a> &gt; Читать почту
    </div>
	<div class="box_right">
    	<a href="signup.php">Зарегистрироваться</a> - <a href="login.php">Войти</a>
    </div>
    <div class="clean"></div>
</div>
<?php
}
?>
<h1><?php echo $dn1['title']; ?></h1>
<table class="messages_table">
	<tr>
    	<th class="author">Пользователь</th>
        <th>Сообщение</th>
    </tr>
<?php
while($dn2 = mysqli_fetch_array($req2))
{
?>
	<tr>
    	<td class="author center"><?php
if($dn2['avatar']!='')
{
	echo '<img src="'.htmlentities($dn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
}
?><br /><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo $dn2['fusername']; ?></a></td>
    	<td class="left"><div class="date">Дата отправки: <?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></div>
    	<?php echo $dn2['message']; ?></td>
    </tr>
<?php
}
?>
</table><br />
<h2>Ответить</h2>
<div class="center">
    <form action="read_pm.php?id=<?php echo $id; ?>" method="post">
    	<label for="message" class="center">Сообщение</label><br />
        <textarea cols="40" rows="5" name="message" id="message"></textarea><br />
        <input type="submit" value="Отправить" />
    </form>
</div>
</div>
<?php
}
}
else
{
	echo '<div class="message">У вас нет прав для этой страницы</div>';
}
}
else
{
	echo '<div class="message">Этого сообщения не существует</div>';
}
}
else
{
	echo '<div class="message">Сообщение не определено</div>';
}
}
else
{
?>
<div class="message">Чтобы иметь доступ к этой странице, вам нужно войти</div>
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
?>
			 </div>
	 </div>
<?php include ('include/footer.php'); ?>