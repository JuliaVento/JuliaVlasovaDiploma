<?php include "templates/include/header.php" ?>

	<div class="article">
		<div class="content_block">
      <h1 style="width: 100%;"><?php echo htmlspecialchars( $results['article']->title )?></h1>
      <div style="width: 100%; font-style: italic;"><?php echo htmlspecialchars( $results['article']->summary )?></div>
      <div style="width: 100%;"><?php echo $results['article']->content?></div>
      <p class="pubDate">Опубликовано <?php echo date('j F Y', $results['article']->publicationDate)?></p>
<br><br>
  
	  <a href="../CMS/admin.php?action=loginArticles">Редактировать статью</a>
	   </div>
	 </div>

<?php include "templates/include/footer.php" ?>

