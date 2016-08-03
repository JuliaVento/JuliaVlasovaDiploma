<?php
// http://localhost/final_project/CMS/index.php
require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
  case 'archive':
    archive();
    break;
  case 'viewArticle':
    viewArticle();
    break;
	
	/**/
	case 'archiveNews':
    archiveNews();
    break;
  case 'viewNews':
    viewNews();
    break;
	/* ----------*/
	case 'homepageNews':
    homepageNews();
    break;
	
	
	case 'homepage':
    homepage();
    break;
	
  default:
    homepage(); //??????? а для новостей?
}

function archive() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Article Archive";
  require( TEMPLATE_PATH . "/archive.php" );
}

function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    homepage();
    return;
  }

  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  $results['pageTitle'] = $results['article']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}

function homepage() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homepage.php" );
}




/* */
function archiveNews() {
  $results = array();
  $data = News::getList();
  $results['news'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "News Archive";
  require( TEMPLATE_PATH . "/archiveNews.php" );
}

function viewNews() {
  if ( !isset($_GET["newsId"]) || !$_GET["newsId"] ) {
    homepageNews();
    return;
  }

  $results = array();
  $results['news'] = News::getById( (int)$_GET["newsId"] );
  $results['pageTitle'] = $results['news']->title . " | Widget News";
  require( TEMPLATE_PATH . "/viewNews.php" );
}

function homepageNews() {
  $results = array();
  $data = News::getList( HOMEPAGE_NUM_NEWS );
  $results['news'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Widget News";
  require( TEMPLATE_PATH . "/homepageNews.php" );
}
/* ----------*/
?>
