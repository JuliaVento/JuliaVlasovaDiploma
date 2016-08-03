<?php
//This page let users sign up
include('config.php');
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">
<?php
if(isset($_POST['fusername'], $_POST['fpassword'], $_POST['passverif'], $_POST['email'], $_POST['avatar']) and $_POST['fusername']!='')
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
				$dn = mysqli_num_rows(mysqli_query($conn, 'select id from users where fusername="'.$fusername.'"'));
				if($dn==0)
				{
					$dn2 = mysqli_num_rows(mysqli_query($conn, 'select id from users'));
					$id = $dn2+1;
					if(mysqli_query($conn, 'insert into users(id, fusername, fpassword, email, avatar, signup_date) values ('.$id.', "'.$fusername.'", "'.$fpassword.'", "'.$email.'", "'.$avatar.'", "'.time().'")'))
					{
						$form = false;
?>
<div class="message">Вы удачно зарегистрировались. Теперь вы можете войти.<br />
<a href="login.php">Войти</a></div>
<?php
					}
					else
					{
						$form = true;
						$message = 'Упс! Произошла ошибка.';
					}
				}
				else
				{
					$form = true;
					$message = 'Другой пользователь уже использует это имя';
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
			$message = 'Пароль должен содержать хотя бы 6 символов';
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
		echo '<div class="message">'.$message.'</div>';
	}
?>
<div class="content">
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a> &gt; Регистрация
    </div>
	<div class="box_right">
    	<a href="signup.php">Зарегистрироваться</a> - <a href="login.php">Войти</a>
    </div>
    <div class="clean"></div>
</div>
    <form action="signup.php" method="post">
        Для регистрации заполните эту форму: <br />
        <div class="center">
            <label for="fusername">Имя</label><br><input type="text" name="fusername" value="<?php if(isset($_POST['fusername'])){echo htmlentities($_POST['fusername'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="fpassword">Пароль<span class="small">(6 символов и более)</span></label><br><input type="fpassword" name="fpassword" /><br />
            <label for="passverif">Пароль<span class="small">(подтверждение)</span></label><br><input type="fpassword" name="passverif" /><br />
            <label for="email">E-mail</label><br><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="avatar">Аватар<span class="small">(необязательно)</span></label><br><input type="text" name="avatar" value="<?php if(isset($_POST['avatar'])){echo htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <input type="submit" value="Зарегистрироваться" />
		</div>
    </form>
</div>
<?php
}
?>
			 </div>
	 </div>
<?php include ('include/footer.php'); ?>