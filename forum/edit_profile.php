<?php
//This page let an user edit his profile
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; Редактировать мой профиль
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
    <div class="clean"></div>
</div>
<?php
	if(isset($_POST['fusername'], $_POST['fpassword'], $_POST['passverif'], $_POST['email'], $_POST['avatar']))
	{
		if(get_magic_quotes_gpc())
		{
			$_POST['fusername'] = stripslashes($_POST['fusername']);
			$_POST['fpassword'] = stripslashes($_POST['fpassword']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			$_POST['email'] = stripslashes($_POST['email']);
			$_POST['avatar'] = stripslashes($_POST['avatar']);
		}
		if($_POST['fpassword']==$_POST['passverif'])
		{
			if(strlen($_POST['fpassword'])>=6)
			{
				if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
				{
					$fusername = mysqli_real_escape_string($conn, $_POST['fusername']);
					$fpassword = mysqli_real_escape_string($conn, sha1($_POST['fpassword']));
					$email = mysqli_real_escape_string($conn, $_POST['email']);
					$avatar = mysqli_real_escape_string($conn, $_POST['avatar']);
					$dn = mysqli_fetch_array(mysqli_query($conn, 'select count(*) as nb from users where fusername="'.$fusername.'"'));
					if($dn['nb']==0 or $_POST['fusername']==$_SESSION['fusername'])
					{
						if(mysqli_query($conn, 'update users set fusername="'.$fusername.'", fpassword="'.$fpassword.'", email="'.$email.'", avatar="'.$avatar.'" where id="'.mysqli_real_escape_string($conn, $_SESSION['userid']).'"'))
						{
							$form = false;
							unset($_SESSION['fusername'], $_SESSION['userid']);
?>
<div class="message">Ваш профиль успешно отредактирован. Пожалуйста, войдите заново.<br />
<a href="login.php">Войти</a></div>
<?php
						}
						else
						{
							$form = true;
							$message = 'Произошла ошибка';
						}
					}
					else
					{
						$form = true;
						$message = 'Этот никнейм уже использует другой пользователь';
					}
				}
				else
				{
					$form = true;
					$message = 'Неправильный e-mail';
				}
			}
			else
			{
				$form = true;
				$message = 'Пароль должен содержать как минимум 6 символов';
			}
		}
		else
		{
			$form = true;
			$message = 'Неодинаковые пароли';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		if(isset($message))
		{
			echo '<strong>'.$message.'</strong>';
		}
		if(isset($_POST['fusername'],$_POST['fpassword'],$_POST['email']))
		{
			$fusername = htmlentities($_POST['fusername'], ENT_QUOTES, 'UTF-8');
			if($_POST['fpassword']==$_POST['passverif'])
			{
				$fpassword = htmlentities($_POST['fpassword'], ENT_QUOTES, 'UTF-8');
			}
			else
			{
				$fpassword = '';
			}
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$avatar = htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');
		}
		else
		{
			$dnn = mysqli_fetch_array(mysqli_query($conn, 'select fusername,email,avatar from users where fusername="'.$_SESSION['fusername'].'"'));
			$fusername = htmlentities($dnn['fusername'], ENT_QUOTES, 'UTF-8');
			$fpassword = '';
			$email = htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
			$avatar = htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8');
		}
?>
    <form action="edit_profile.php" method="post">
        Вы можете изменить информацию о себе: <br />
        <div class="center">
            <label for="fusername">Имя</label><input type="text" name="fusername" id="fusername" value="<?php echo $fusername; ?>" /><br />
            <label for="fpassword">Пароль<span class="small">(6 символов минимум)</span></label><input type="fpassword" name="fpassword" id="fpassword" value="<?php echo $fpassword; ?>" /><br />
            <label for="passverif">Пароль<span class="small">(подтверждение)</span></label><input type="fpassword" name="passverif" id="passverif" value="<?php echo $fpassword; ?>" /><br />
            <label for="email">E-mail</label><input type="text" name="email" id="email" value="<?php echo $email; ?>" /><br />
            <label for="avatar">Аватар<span class="small">(не обязательно)</span></label><input type="text" name="avatar" id="avatar" value="<?php echo $avatar; ?>" /><br />
            <input type="submit" value="Отправить" />
        </div>
    </form>

<?php
	}
}
else
{
?>
<h2>Чтобы иметь доступ к этой странице, вам нужно войти:</h2>
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