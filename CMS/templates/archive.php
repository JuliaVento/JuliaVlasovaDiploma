<?php include "templates/include/header.php" ?>



	<div class="article">
		<div class="content_block">
		<h2>Статьи</h2>
		
	
	
	
	      <ul id="headlines" class="archive">

<?php foreach ( $results['articles'] as $article ) { ?>

        <li>
          <h2>
            <span class="pubDate"><?php echo date('j F Y', $article->publicationDate)?></span><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"> - <?php echo htmlspecialchars( $article->title )?></a>
          </h2>
          <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
        </li>
<br> <br>
<?php } ?>

      </ul>
<br> <br>
      <p><?php echo $results['totalRows']?> статей<?php echo ( $results['totalRows'] != 1 ) ? '' : '' ?> всего.</p>

      
	
	 <a href="../CMS/admin.php?action=loginArticles">Редактировать статьи</a>
	
	
	
		</div>
	</div>




<?php include "templates/include/footer.php" ?>

