<?php include "templates/include/header.php" ?>
<div class="article">
		<div class="content_block">
      <ul id="headlines">

<?php foreach ( $results['articles'] as $article ) { ?>

        <li>
          <h2>
            <span class="pubDate"><?php echo date('j F', $article->publicationDate)?></span> <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"> - <?php echo htmlspecialchars( $article->title )?></a>
          </h2>
          <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
        </li>
<br> <br>
<?php } ?>

      </ul>
<br> <br>
      <p><a href="./?action=archive">Хранилище статей</a></p>
	   <a href="admin.php?action=loginArticles">Редактировать статьи</a> 
	   <!--<a href="./?action=homepageNews">Редактировать статьи!!!</a>-->
   </div>
	 </div>
<?php include "templates/include/footer.php" ?>

