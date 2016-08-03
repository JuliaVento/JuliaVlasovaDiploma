<?php include "templates/include/headerNews.php" ?>
<div class="article">
		<div class="content_block">
      <div id="adminHeader">
        <h2>Панель администратора</h2>
        <p>Вы зашли как <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Выйти</a></p>
      </div>

      <h1><?php echo $results['pageTitle']?></h1>

      <form action="admin.php?action=<?php echo $results['formActionNews']?>" method="post">
        <input type="hidden" name="newsId" value="<?php echo $results['news']->id ?>"/>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

        <ul>

          <li>
            <label for="title">Заголовок новости</label><br>
            <input type="text" name="title" id="title" placeholder="Name of the news" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['news']->title )?>" />
          </li>

          <li>
            <label for="summary">Краткое содержание новости</label><br>
            <textarea name="summary" id="summary" placeholder="Brief description of the news" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $results['news']->summary )?></textarea>
          </li>

          <li>
            <label for="content">Полное содержание новости</label><br>
            <textarea name="content" id="content" placeholder="The HTML content of the news" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['news']->content )?></textarea>
          </li>

          <li>
            <label for="publicationDate">Дата публикации</label><br>
            <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['news']->publicationDate ? date( "Y-m-d", $results['news']->publicationDate ) : "" ?>" />
          </li>


        </ul>

        <div class="buttons">
          <input type="submit" name="saveChanges" value="Сохранить изменения" />
          <input type="submit" formnovalidate name="cancel" value="Отмена" />
        </div>

      </form>

<?php if ( $results['news']->id ) { ?>
      <p><a href="admin.php?action=deleteNews&amp;newsId=<?php echo $results['news']->id ?>" onclick="return confirm('Delete This News?')">Удалить новость</a></p>
<?php } ?>
</div></div>
<?php include "templates/include/footer.php" ?>

