
<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";


if( $action != "loginArticles" && $action != "logoutArticles" && !$username ) {
  loginNews();
  
  exit;
}

elseif ( $action != "loginNews" && $action != "logoutNews" && !$username ) {
  loginArticles();
  
  exit;
}



switch ( $action ) {
  case 'loginArticles':
    loginArticles();
    break;
  case 'loginNews':
    loginNews();
    break;
  case 'logoutArticles':
    logoutArticles();
    break;
  case 'logoutNews':
    logoutNews();
    break;
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  case 'deleteArticle':
    deleteArticle();
    break;
	/**/
  case 'newNews':
    newNews();
    break;
  case 'editNews':
    editNews();
    break;
  case 'deleteNews':
    deleteNews();
    break;
	
  case 'listNews':
    listNews();
    break;
  case 'listArticles':
    listArticles();
    break;
	
	/**/
  default:
    listNews(); 
	
	
}


function loginArticles() {
$host = 'localhost'; // адрес сервера 
$database = 'cms'; // имя базы данных
$user = 'root'; // имя пользователя
$password = 'root'; // пароль
$conn = mysqli_connect($host,$user,$password,$database);
$n = mysqli_query($conn,"SELECT name FROM users"); 
$name = mysqli_fetch_array($n); 
$ADMIN_USERNAME = $name[0];

$p = mysqli_query($conn,"SELECT password FROM users"); 
$password = mysqli_fetch_array($p);
$ADMIN_PASSWORD = $password[0];
$password = sha1($_POST['password']);




		  $results = array();
		  $results['pageTitle'] = "Вход для администратора";

		  if ( isset( $_POST['login'] ) ) {

    // Пользователь получает форму входа: попытка авторизировать пользователя

   
			if ( $_POST['username'] == $ADMIN_USERNAME && $password == $ADMIN_PASSWORD ) {

			  // Вход прошел успешно: создаем сессию и перенаправляем на страницу администратора
			  $_SESSION['username'] = $ADMIN_USERNAME;
			  header( "Location: admin.php?action=listArticles" );

    } else {

      // Ошибка входа: выводим сообщение об ошибке для пользователя
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
	
    }

  } else {

    // Пользователь еще не получил форму: выводим форму
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }
$conn = null;
}

function loginNews() {
$host = 'localhost'; // адрес сервера 
$database = 'cms'; // имя базы данных
$user = 'root'; // имя пользователя
$password = 'root'; // пароль
$conn = mysqli_connect($host,$user,$password,$database);
$n = mysqli_query($conn,"SELECT name FROM users"); 
$name = mysqli_fetch_array($n); 
$ADMIN_USERNAME = $name[0];

$p = mysqli_query($conn,"SELECT password FROM users"); 
$password = mysqli_fetch_array($p);
$ADMIN_PASSWORD = $password[0];
$password = sha1($_POST['password']);



		  $results = array();
		  $results['pageTitle'] = "Вход для администратора";

		  if ( isset( $_POST['login'] ) ) {

			// Пользователь получает форму входа: попытка авторизировать пользователя

			if ( $_POST['username'] == $ADMIN_USERNAME && $password == $ADMIN_PASSWORD ) {

			  // Вход прошел успешно: создаем сессию и перенаправляем на страницу администратора
			  $_SESSION['username'] = $ADMIN_USERNAME;
			  header( "Location: admin.php" );

			} else {

			  // Ошибка входа: выводим сообщение об ошибке для пользователя
			  $results['errorMessage'] = "Incorrect username or password. Please try again.";
			  require( TEMPLATE_PATH . "/admin/loginFormNews.php" );
			}

		  } else {

			// Пользователь еще не получил форму: выводим форму
			require( TEMPLATE_PATH . "/admin/loginFormNews.php" );
		  }
$conn = null;
}


function logoutArticles() {
  unset( $_SESSION['username'] );
  unset( $_SESSION['password'] );
  header( "Location: index.php?action=homepage" );
}
function logoutNews() {
  unset( $_SESSION['username'] );
  unset( $_SESSION['password'] );
  header( "Location: index.php?action=homepageNews" );
}


function newArticle() {

  $results = array();
  $results['pageTitle'] = "Новая статья";
  $results['formAction'] = "newArticle";

  if ( isset( $_POST['saveChanges'] ) ) {

    // Пользователь получает форму редактирования статьи: сохраняем новую статью
    $article = new Article;
    $article->storeFormValues( $_POST );
    $article->insert();
    header( "Location: admin.php?action=listArticles&status=changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // Пользователь сбросид результаты редактирования: возвращаемся к списку статей
    header( "Location: admin.php" );
  } else {

    // Пользователь еще не получил форму редактирования: выводим форму
    $results['article'] = new Article;
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }

}





function editArticle() {

  $results = array();
  $results['pageTitle'] = "Редактировать статью";
  $results['formAction'] = "editArticle";

  if ( isset( $_POST['saveChanges'] ) ) {

    // Пользователь получил форму редактирования статьи: сохраняем изменения

    if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }

    $article->storeFormValues( $_POST );
    $article->update();
    header( "Location: admin.php?action=listArticles&status=changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // Пользователь отказался от результатов редактирования: возвращаемся к списку статей
    header( "Location: admin.php?action=listArticles" );
  } else {

    // Пользвоатель еще не получил форму редактирования: выводим форму
    $results['article'] = Article::getById( (int)$_GET['articleId'] );
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }

}




function deleteArticle() {

  if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }

  $article->delete();
  header( "Location: admin.php?action=listArticles&status=articleDeleted" );
}


function listArticles() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Все статьи";

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) {
		$results['statusMessage'] = "Изменения успешно сохранены!";
		
	}
    if ( $_GET['status'] == "articleDeleted" ) {
		
		$results['statusMessage'] = "Статья успешно удалена";
	
	}
		
  }

  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

/**/
function listNews() {
  $results = array();
  $data = News::getList();
  $results['news'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Все новости";

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "newsNotFound" ) $results['errorMessage'] = "Error: News not found.";
  }

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesNewsSaved" ) {
		$results['statusMessage'] = "Изменения успешно сохранены!";
		
	}
    if ( $_GET['status'] == "newsDeleted" ) {
		
		$results['statusMessage'] = "Новость успешно удалена";
	
	}
		
  }

  require( TEMPLATE_PATH . "/admin/listNews.php" );
}

function newNews() {

  $results = array();
  $results['pageTitle'] = "Новая новость";
  $results['formActionNews'] = "newNews";

  if ( isset( $_POST['saveChanges'] ) ) {

    // Пользователь получает форму редактирования статьи: сохраняем новую статью
    $news = new News;
    $news->storeFormValues( $_POST );
    $news->insert();
    header( "Location: admin.php?action=listNews&status=changesNewsSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // Пользователь сбросид результаты редактирования: возвращаемся к списку статей
    header( "Location: admin.php?action=listNews" );
  } else {

    // Пользователь еще не получил форму редактирования: выводим форму
    $results['news'] = new News;
    require( TEMPLATE_PATH . "/admin/editNews.php" );
  }

}


function editNews() {

  $results = array();
  $results['pageTitle'] = "Редактировать новость";
  $results['formActionNews'] = "editNews";

  if ( isset( $_POST['saveChanges'] ) ) {

    // Пользователь получил форму редактирования статьи: сохраняем изменения

    if ( !$news = News::getById( (int)$_POST['newsId'] ) ) {
      header( "Location: admin.php?error=newsNotFound" );
      return;
    }

    $news->storeFormValues( $_POST );
    $news->update();
    header( "Location: admin.php?action=listNews&status=changesNewsSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // Пользователь отказался от результатов редактирования: возвращаемся к списку статей
    header( "Location: admin.php?action=listNews" );
  } else {

    // Пользвоатель еще не получил форму редактирования: выводим форму
    $results['news'] = News::getById( (int)$_GET['newsId'] );
    require( TEMPLATE_PATH . "/admin/editNews.php" );
  }

}

function deleteNews() {

  if ( !$news = News::getById( (int)$_GET['newsId'] ) ) {
    header( "Location: admin.php?error=newsNotFound" );
    return;
  }

  $news->delete();
  header( "Location: admin.php?action=listNews&status=newsDeleted" );
}


/**/
?>
