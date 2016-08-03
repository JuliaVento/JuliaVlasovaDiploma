<?php
//This page displays a list of all registered members
include('config.php');
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; Список всех пользователей
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; Список всех пользователей
    </div>
	<div class="box_right">
    	<a href="signup.php">Зарегистрироваться</a> - <a href="login.php">Войти</a>
    </div>
    <div class="clean"></div>
</div>
<?php
}
?>
Это список всех пользователей:
<table>
    <tr>
    	<th>ID</th>
    	<th>Имя</th>
    	<th>E-mail</th>
    </tr>
<?php
$req = mysqli_query($conn,'select id, fusername, email from users');
while($dnn = mysqli_fetch_array($req))
{
?>
	<tr>
    	<td><?php echo $dnn['id']; ?></td>
    	<td><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['fusername'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
<?php
}
?>
</table>
		</div>
			 </div>
	 </div>
<?php include ('include/footer.php'); ?>