<?php
//This page display the profile of an user
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="users.php">Список пользователей</a> &gt; Профиль пользователя
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="users.php">Список пользователей</a> &gt; Профиль пользователя
    </div>
	<div class="box_right">
    	<a href="signup.php">Зарегистрироваться</a> - <a href="login.php">Войти</a>
    </div>
    <div class="clean"></div>
</div>
<?php
}
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn = mysqli_query($conn, 'select fusername, email, avatar, signup_date from users where id="'.$id.'"');
	if(mysqli_num_rows($dn)>0)
	{
		$dnn = mysqli_fetch_array($dn);
?>
Это профиль "<?php echo htmlentities($dnn['fusername']); ?>" :
<?php
if($_SESSION['userid']==$id)
{
?>
<br /><div class="center"><a href="edit_profile.php" class="button">Редактировать мой профиль</a></div>
<?php
}
?>
<table style="width:500px;">
	<tr>
    	<td><?php
if($dnn['avatar']!='')
{
	echo '<img src="'.htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8').'" alt="Avatar" style="max-width:100px;max-height:100px;" />';
}
else
{
	echo 'У пользователя не установлен аватар';
}
?></td>
    	<td class="left"><h1><?php echo htmlentities($dnn['fusername'], ENT_QUOTES, 'UTF-8'); ?></h1>
    	E-mail: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br />
        Этот пользователь присоединился к сайту <?php echo date('Y/m/d',$dnn['signup_date']); ?></td>
    </tr>
</table>
<?php
if(isset($_SESSION['fusername']) and $_SESSION['fusername']!=$dnn['fusername'])
{
?>
<br /><a href="new_pm.php?recip=<?php echo urlencode($dnn['fusername']); ?>" class="big">Отправить MP "<?php echo htmlentities($dnn['fusername'], ENT_QUOTES, 'UTF-8'); ?>"</a>
<?php
}
	}
	else
	{
		echo 'This user doesn\'t exist.';
	}
}
else
{
	echo 'The ID of this user is not defined.';
}
?>
		</div>
			 </div>
	 </div>
<?php include ('include/footer.php'); ?>