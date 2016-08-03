<?php
//На этой странице будут категори форума
include('config.php');
?>

		
<?php include "include/header.php" ?>
<div class="article">
<div class="content_block">	
		
		
<?php
if(isset($_SESSION['fusername']))
{
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a>
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
    	<a href="<?php echo $url_home; ?>">Главная страница форума</a>
    </div>
	<div class="box_right">
    	<a href="signup.php">Зарегистрироваться</a> - <a href="login.php">Войти</a>
    </div>
	<div class="clean"></div>
</div>
<?php
}
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
?>
	<a href="new_category.php" class="button">Новая категория</a>
<?php
}
?>
<table class="categories_table">
	<tr>
    	<th class="forum_cat">Категории</th>
    	<th class="forum_ntop">Темы</th>
    	<th class="forum_nrep">Ответы</th>
<?php
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
?>
    	<th class="forum_act">Действие</th>
<?php
}
?>
	</tr>
<?php
$dn1 = mysqli_query($conn,'select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
$nb_cats = mysqli_num_rows($dn1);
while($dnn1 = mysqli_fetch_array($dn1))
{
?>
	<tr>
    	<td class="forum_cat"><a href="list_topics.php?parent=<?php echo $dnn1['id']; ?>" class="title"><?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        <div class="description"><?php echo $dnn1['description']; ?></div></td>
    	<td><?php echo $dnn1['topics']; ?></td>
    	<td><?php echo $dnn1['replies']; ?></td>
<?php
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
?>
    	<td><a href="delete_category.php?id=<?php echo $dnn1['id']; ?>"><img src="../images/delete.png" alt="Delete" /></a>
		<?php if($dnn1['position']>1){ ?><a href="move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><img src="../images/up.png" alt="Move Up" /></a><?php } ?>
		<?php if($dnn1['position']<$nb_cats){ ?><a href="move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><img src="../images/down.png" alt="Move Down" /></a><?php } ?>
		<a href="edit_category.php?id=<?php echo $dnn1['id']; ?>"><img src="../images/edit.png" alt="Edit" /></a></td>
<?php
}
?>
    </tr>
<?php
}
?>
</table>
<?php
if(isset($_SESSION['fusername']) and $_SESSION['fusername']==$admin)
{
?>
	<a href="new_category.php" class="button">Новая категория</a>
<?php
}
if(!isset($_SESSION['fusername']))
{
?>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="fusername">Имя</label><br><input type="text" name="fusername" id="fusername" /><br>
		<label for="fpassword">Пароль</label><br><input type="fpassword" name="fpassword" id="fpassword" /><br>
        <label for="memorize">Запомнить</label> <input type="checkbox" name="memorize" id="memorize" value="yes" />
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
	