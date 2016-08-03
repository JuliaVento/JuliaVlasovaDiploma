<?php
//This page let log in
include('config.php');
if(isset($_SESSION['fusername']))
{
	unset($_SESSION['fusername'], $_SESSION['userid']);
	setcookie('fusername', '', time()-100);
	setcookie('fpassword', '', time()-100);
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">	
<div class="message">Вы успешно вышли<br />
<a href="<?php echo $url_home; ?>">На главную форума</a></div>
<?php
}
else
{
	$ofusername = '';
	if(isset($_POST['fusername'], $_POST['fpassword']))
	{
		if(get_magic_quotes_gpc())
		{
			$ofusername = stripslashes($_POST['fusername']);
			$fusername = mysqli_real_escape_string($conn, stripslashes($_POST['fusername']));
			$fpassword = stripslashes($_POST['fpassword']);
		}
		else
		{
			$fusername = mysqli_real_escape_string($conn, $_POST['fusername']);
			$fpassword = $_POST['fpassword'];
		}
		$req = mysqli_query($conn,'select fpassword,id from users where fusername="'.$fusername.'"');
		$dn = mysqli_fetch_array($req);
		if($dn['fpassword']==sha1($fpassword) and mysqli_num_rows($req)>0)
		{
			$form = false;
			$_SESSION['fusername'] = $_POST['fusername'];
			$_SESSION['userid'] = $dn['id'];
			if(isset($_POST['memorize']) and $_POST['memorize']=='yes')
			{
				$one_year = time()+(60*60*24*365);
				setcookie('fusername', $_POST['fusername'], $one_year);
				setcookie('fpassword', sha1($fpassword), $one_year);
			}
?>
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">	
<div class="message">Вы удачно вошли!<br />
<a href="<?php echo $url_home; ?>">К категориям</a></div>

<?php
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>


<?php
		}
		else
		{
			$form = true;
			$message = 'Имя или пароль неправильные';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
?>

<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">	
<?php
if(isset($message))
{
	echo '<div class="message">'.$message.'</div>';
}
?>
<div class="content">

<div class="box">

<?php 
	if($ofusername) {
		
	?>
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">На главную форума</a> &gt; Войти
    </div>
	
	<div class="box_right">
    	<a href="list_pm.php">Ваши сообщения(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['fusername'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Выйти</a>)
    </div>
	
	<?php 
	}
		
	?>
    <div class="clean"></div>
</div>
    <form action="login.php" method="post">
        Пожалуйста, введите ваши данные:<br />
        <div class="login">
            <label for="fusername">Имя</label><br /> <input type="text" name="fusername" id="fusername" value="<?php echo htmlentities($ofusername, ENT_QUOTES, 'UTF-8'); ?>" /><br />
           <label for="fpassword">Пароль</label><br /> <input type="fpassword" name="fpassword" id="fpassword" /><br />
          <label for="memorize">Запомнить</label> <input type="checkbox" name="memorize" id="memorize" value="yes" /><br />
            <input type="submit" value="Login" />
		</div>
    </form>
	<a href="signup.php">Зарегистрироваться</a>
</div>
<?php
	}
}
?>
	 </div>
	 </div>
<?php include ('include/footer.php'); ?>

