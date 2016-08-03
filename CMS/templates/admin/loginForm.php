<?php include "templates/include/header.php" ?>
<div class="article">
		<div class="content_block">
      <form action="admin.php?action=loginArticles" method="post" style="width: 50%;">
        <input type="hidden" name="login" value="true" />

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

        <ul>

          <li>
            <label for="username">Имя</label><br>
            <input type="text" name="username" id="username" placeholder="Ваше имя администратора" required autofocus maxlength="20" />
          </li>

          <li>
            <label for="password">Пароль</label><br>
            <input type="password" name="password" id="password" placeholder="Ваш секретный пароль" required maxlength="20" />
          </li>

        </ul>

        <div class="buttons">
          <input type="submit" name="login" value="Login" />
        </div>

      </form>
  </div>
	 </div>
<?php include "templates/include/footer.php" ?>

