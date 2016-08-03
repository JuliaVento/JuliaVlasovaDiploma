<?php
//This page let move a category
include('config.php');
if(isset($_GET['id'], $_GET['action']) and ($_GET['action']=='up' or $_GET['action']=='down'))
{
$id = intval($_GET['id']);
$action = $_GET['action'];
$dn1 = mysqli_fetch_array(mysqli_query($conn,'select count(c.id) as nb1, c.position, count(c2.id) as nb2 from categories as c, categories as c2 where c.id="'.$id.'" group by c.id'));
if($dn1['nb1']>0)
{
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
	if($action=='up')
	{
		if($dn1['position']>1)
		{
			if(mysqli_query($conn,'update categories as c, categories as c2 set c.position=c.position-1, c2.position=c2.position+1 where c.id="'.$id.'" and c2.position=c.position-1'))
			{
				header('Location: '.$url_home);
			}
			else
			{
				echo 'Произошла ошибка';
			}
		}
		else
		{
			echo '<h2>Данное действие неосуществимо</h2>';
		}
	}
	else
	{
		if($dn1['position']<$dn1['nb2'])
		{
			if(mysqli_query($conn,'update categories as c, categories as c2 set c.position=c.position+1, c2.position=c2.position-1 where c.id="'.$id.'" and c2.position=c.position+1'))
			{
				header('Location: '.$url_home);
			}
			else
			{
				echo 'Произошла ошибка';
			}
		}
		else
		{
			echo '<h2>Данное действие неосуществимо</h2>';
		}
	}
}
else
{
	echo '<h2>Чтобы иметь доступ к этой странице, вы должны войти как администратор: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>Категория, которую вы хотите передвинуть, не существует</h2>';
}
}
else
{
	echo '<h2>Категория не определена</h2>';
}
?>