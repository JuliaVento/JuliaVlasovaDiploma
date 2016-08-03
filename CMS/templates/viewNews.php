<?php include "templates/include/headerNews.php" ?>

	<div class="article">
		<div class="content_block">
      <h1 style="width: 100%;"><?php echo htmlspecialchars( $results['news']->title )?></h1>
      <div style="width: 100%; font-style: italic;"><?php echo htmlspecialchars( $results['news']->summary )?></div>
      <div style="width: 100%;"><?php echo $results['news']->content?></div>
      <p class="pubDate">Опубликовано <?php echo date('j F Y', $results['news']->publicationDate)?></p>
<br> <br>
    
	  <a href="../CMS/admin.php">Редактировать новость</a>
	   </div>
	 </div>

<?php include "templates/include/footer.php" ?>

