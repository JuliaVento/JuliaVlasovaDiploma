<?php include "templates/include/headerNews.php" ?>
<div class="article">
		<div class="content_block">
      <ul id="headlines">

<?php foreach ( $results['news'] as $news ) { ?>

        <li>
          <h2>
            <span class="pubDate"> <?php echo date('j F', $news->publicationDate)?></span><a href=".?action=viewNews&amp;newsId=<?php echo $news->id?>"> - <?php echo htmlspecialchars( $news->title )?></a>
          </h2>
          <p class="summary"><?php echo htmlspecialchars( $news->summary )?></p>
        </li>
<br> <br>
<?php } ?>

      </ul>
<br> <br>
      <p><a href="./?action=archiveNews">Хранилище новостей</a></p>
	   <a href="../CMS/admin.php?action=loginNews">Редактировать новости</a>
   </div>
	 </div>
<?php include "templates/include/footer.php" ?>

