<?php
//This page let create a new personnal message
include('config.php');
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">
<?php
if(isset($_SESSION['fusername']))
{
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		$title = mysqli_real_escape_string($conn, $otitle);
		$recip = mysqli_real_escape_string($conn, $orecip);
		$message = mysqli_real_escape_string($conn, nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		$dn1 = mysqli_fetch_array(mysqli_query($conn, 'select count(id) as recip, id as recipid, (select count(*) from pm) as npm from users where fusername="'.$recip.'"'));
		if($dn1['recip']==1)
		{
			if($dn1['recipid']!=$_SESSION['userid'])
			{
				$id = $dn1['npm']+1;
				if(mysqli_query($conn, 'insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['userid'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
				{
	?>
	<div class="message">Сообщение успешно отправлено<br />
	<a href="list_pm.php">Список ваших личных сообщений</a></div>
	<?php
					$form = false;
				}
				else
				{
					$error = 'An error occurred while sending the PM.';
				}
			}
			else
			{
				$error = 'Вы не можете послать письмо себе';
			}
		}
		else
		{
			$error = 'Получатель скрылся в неизвестном направлении';
		}
	}
	else
	{
		$error = 'Поле не заполнено';
	}
}
elseif(isset($_GET['recip']))
{
	$orecip = $_GET['recip'];
}
if($form)
{
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
?>
<div class="content">
<?php
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn, 'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; <a href="list_pm.php">Список ваших писем</a> &gt; Новое письмо
    </div>
	<div class="box_right">
     	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
	<h1>Новое личное сообщение</h1>
    <form action="new_pm.php" method="post">
		Заполните эту форму, чтобы отправить письмо:<br />
        <label for="title">Название</label><input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" name="title" /><br />
        <label for="recip">Получатель<span class="small">(Имя пользователя)</span></label><input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" name="recip" /><br />
        <label for="message">Сообщение</label><textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea><br />
        <input type="submit" value="Отправить" />
    </form>
</div>
<?php
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