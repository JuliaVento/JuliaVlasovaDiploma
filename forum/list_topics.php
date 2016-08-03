<?php
//This page let display the list of topics of a category
include('config.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
	$dn1 = mysqli_fetch_array(mysqli_query($conn, 'select count(c.id) as nb1, c.name,count(t.id) as topics from categories as c left join topics as t on t.parent="'.$id.'" where c.id="'.$id.'" group by c.id'));
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
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_topics.php?parent=<?php echo $id; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_topics.php?parent=<?php echo $id; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
    </div>
	<div class="box_right">
    	<a href="signup.php">Зарегистрироваться</a> - <a href="login.php">Войти</a>
    </div>
	<div class="clean"></div>
</div>
<?php
}
if(isset($_SESSION['fusername']))
{
?>
	<a href="new_topic.php?parent=<?php echo $id; ?>" class="button">Новая тема</a>
<?php
}
$dn2 = mysqli_query($conn,'select t.id, t.title, t.authorid, u.fusername as author, count(r.id) as replies from topics as t left join topics as r on r.parent="'.$id.'" and r.id=t.id and r.id2!=1  left join users as u on u.id=t.authorid where t.parent="'.$id.'" and t.id2=1 group by t.id order by t.timestamp2 desc');
if(mysqli_num_rows($dn2)>0)
{
?>
<table class="topics_table">
	<tr>
    	<th class="forum_tops">Тема</th>
    	<th class="forum_auth">Автор</th>
    	<th class="forum_nrep">Ответы</th>
<?php
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
?>
    	<th class="forum_act">Action</th>
<?php
}
?>
	</tr>
<?php
while($dnn2 = mysqli_fetch_array($dn2))
{
?>
	<tr>
    	<td class="forum_tops"><a href="read_topic.php?id=<?php echo $dnn2['id']; ?>"><?php echo htmlentities($dnn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo htmlentities($dnn2['author'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dnn2['replies']; ?></td>
<?php
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
?>
    	<td><a href="delete_topic.php?id=<?php echo $dnn2['id']; ?>"><img src="../images/delete.png" alt="Delete" /></a></td>
<?php
}
?>
    </tr>
<?php
}
?>
</table>
<?php
}
else
{
?>
<div class="message">В этой категории нет тем</div>
<?php
}
if(isset($_SESSION['fusername']))
{
?>
	<a href="new_topic.php?parent=<?php echo $id; ?>" class="button">Новая тема</a>
<?php
}
else
{
?>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="fusername">Имя</label><br><input type="text" name="fusername" id="fusername" /><br />
		<label for="fpassword">Пароль</label><br><input type="fpassword" name="fpassword" id="fpassword" /><br />
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
	echo '<h2>Данная категория не существует</h2>';
}
}
else
{
	echo '<h2>Номер категории не определен</h2>';
}
?>