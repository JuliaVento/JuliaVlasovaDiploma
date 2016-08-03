<?php
//This page display a topic
include('config.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn1 = mysqli_fetch_array(mysqli_query($conn, 'select count(t.id) as nb1, t.title, t.parent, count(t2.id) as nb2, c.name from topics as t, topics as t2, categories as c where t.id="'.$id.'" and t.id2=1 and t2.id="'.$id.'" and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">
        <div class="content">
<?php
if(isset($_SESSION['fusername']))
{
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn, 'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; <a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; Читать тему
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; <a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; Читать тему
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
<?php
if(isset($_SESSION['fusername']))
{
?>
	<a href="new_reply.php?id=<?php echo $id; ?>" class="button">Ответить</a>
<?php
}
$dn2 = mysqli_query($conn, 'select t.id2, t.authorid, t.message, t.timestamp, u.fusername as author, u.avatar from topics as t, users as u where t.id="'.$id.'" and u.id=t.authorid order by t.timestamp asc');
?>
<table class="messages_table">
	<tr>
    	<th class="author">Автор</th>
    	<th>Сообщение</th>
	</tr>
<?php
while($dnn2 = mysqli_fetch_array($dn2))
{
?>
	<tr>
    	<td class="author center"><?php
if($dnn2['avatar']!='')
{
	echo '<img src="'.htmlentities($dnn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
}
?><br /><a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo $dnn2['author']; ?></a></td>
    	<td class="left"><?php if(isset($_SESSION['fusername']) and ($_SESSION['fusername']==$dnn2['author'] or $_SESSION['fusername']==$admin)){ ?><div class="edit"><a href="edit_message.php?id=<?php echo $id; ?>&id2=<?php echo $dnn2['id2']; ?>"><img src="../images/edit.png" alt="Edit" /></a></div><?php } ?><div class="date">Дата: <?php echo date('Y/m/d H:i:s' ,$dnn2['timestamp']); ?></div>
        <div class="clean"></div>
    	<?php echo $dnn2['message']; ?></td>
    </tr>
<?php
}
?>
</table>
<?php
if(isset($_SESSION['fusername']))
{
?>
	<a href="new_reply.php?id=<?php echo $id; ?>" class="button">Ответить</a>
<?php
}
else
{
?>
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
	 </div>
<?php include ('include/footer.php'); ?>
<?php
}
else
{
	echo '<h2>Данная тема не существует</h2>';
}
}
else
{
	echo '<h2>Тема не определена</h2>';
}
?>