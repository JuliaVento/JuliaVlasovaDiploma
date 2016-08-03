<?php
//На этой странице отображается список персональных сообщений пользователя
include('config.php');
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">
        <div class="content">
<?php
if(isset($_SESSION['fusername']))
{
$req1 = mysqli_query($conn, 'select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.fusername from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req2 = mysqli_query($conn, 'select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.fusername from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn, 'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; Список ваших личных сообщений
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
Список ваших личных сообщений:<br />
<a href="new_pm.php" class="button">Новое личное сообщение</a><br />
<h3>Непрочитанные сообщения(<?php echo intval(mysqli_num_rows($req1)); ?>):</h3>
<table class="list_pm">
	<tr>
    	<th class="title_cell">Название</th>
        <th>Ответы</th>
        <th>Участник</th>
        <th>Дата отправки</th>
    </tr>
<?php
while($dn1 = mysqli_fetch_array($req1))
{
?>
	<tr>
    	<td class="left"><a href="read_pm.php?id=<?php echo $dn1['id']; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dn1['reps']-1; ?></td>
    	<td><a href="profile.php?id=<?php echo $dn1['userid']; ?>"><?php echo htmlentities($dn1['fusername'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo date('d/m/Y H:i:s' ,$dn1['timestamp']); ?></td>
    </tr>
<?php
}
if(intval(mysqli_num_rows($req1))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">У вас нет непрочитанных сообщений</td>
    </tr>
<?php
}
?>
</table>
<br />
<h3>Читать сообщения(<?php echo intval(mysqli_num_rows($req2)); ?>):</h3>
<table class="list_pm">
	<tr>
    	<th class="title_cell">Название</th>
        <th>Ответы</th>
        <th>Участник</th>
        <th>Дата отправки</th>
    </tr>
<?php
while($dn2 = mysqli_fetch_array($req2))
{
?>
	<tr>
    	<td class="left"><a href="read_pm.php?id=<?php echo $dn2['id']; ?>"><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dn2['reps']-1; ?></td>
    	<td><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo htmlentities($dn2['fusername'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo date('d/m/Y H:i:s' ,$dn2['timestamp']); ?></td>
    </tr>
<?php
}
if(intval(mysqli_num_rows($req2))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">У вас нет непрочитанных сообщений</td>
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
<h2>Чтобы иметь доступ к этой странице, вам нужно войти:</h2>
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