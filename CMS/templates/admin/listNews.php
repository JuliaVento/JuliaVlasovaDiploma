<?php include "templates/include/headerNews.php" ?>

	<div class="article">
		<div class="content_block">
    

      <h2>Все новости</h2>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>

      <table>
        <tr>
          <th>Дата публикации</th>
          <th>Новость</th>
        </tr>

<?php foreach ( $results['news'] as $news ) { ?>

        <tr onclick="location='admin.php?action=editNews&amp;newsId=<?php echo $news->id?>'">
          <td><?php echo date('j M Y', $news->publicationDate)?></td>
          <td>
            <?php echo $news->title?>
          </td>
        </tr>

<?php } ?>

      </table>

      <p><?php echo $results['totalRows']?> новостей<?php echo ( $results['totalRows'] != 1 ) ? '' : '' ?> всего.</p>

      <p><a href="admin.php?action=newNews">Добавить новую новость</a></p>
	  <a href="admin.php?action=logoutNews"?>Выйти</a></p>
</div></div>
<?php include "templates/include/footer.php" ?>

