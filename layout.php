<?php 
function __($value='')
{
  return $value;
}
 ?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo (!empty($title)) ? $title : __('Тех поддержка');  ?></title>
	<meta name="author" content="Aidos Kakimzhanov" />
	<meta property="og:title" content="<?php echo (!empty($title)) ? $title : '';  ?>" />
	<meta property="og:url" content="<?php echo (!empty($url)) ? $url : $_SERVER['REQUEST_URI'];  ?>" />
	<meta property="og:type" content="<?php echo (!empty($type)) ? $type : 'website';  ?>" />
	<meta property="og:image" content="<?php echo (!empty($image)) ? $image : '';  ?>" />
	<meta property="og:updated_time" content="<?php echo time(); ?>" />
<!--<meta property="og:image" content="/images/dicasta_logo128.png">
	<meta content="/images/dicasta_logo128.png" itemprop="image">
	<meta name="msapplication-TileImage" content="/images/dicasta_logo128.png">
	<link rel="apple-touch-icon" href="/images/dicasta_logo57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/dicasta_logo72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/dicasta_logo114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/dicasta_logo144.png"> 
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?1">
  	<meta name="description" content="<?php echo (!empty($description)) ? $description : '';  ?>">
	<link rel="image_src" href="<?php echo (!empty($image)) ? $image : '';  ?>">
-->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css"/>

</head>
<body>
<div class="container">
      <!-- <div>
        <a href="/">
          <img src="/public/image/logo.png" alt="<?php echo __('Файловая хранилище') . 'KTGA.KZ'; ?>">
        </a>
        <div class="col-lg-6 pull-right" >
        <form action="/search">
            <div class="input-group">
              <input type="text" type="search" name="q" class="form-control" placeholder="Поиск...">
              <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Поиск" />
              </span>
            </div>
        </form>
        </div>
      </div> -->
      <nav class="navbar navbar-default navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only"><?php echo __('Навигация'); ?></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><?php echo __('Файловая хранилище') . 'KTGA.KZ'; ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/"><?php echo __('Главная'); ?></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo __('Заявки'); ?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/orders"><?php echo __('Все'); ?></a></li>
                  <li><a href="/orders?filter=my"><?php echo __('Мои'); ?></a></li>
                  <li><a href="/orders?filter=new"><?php echo __('Новые'); ?></a></li>
                  <li><a href="/orders?filter=process"><?php echo __('В процессе'); ?></a></li>
                  <li><a href="/orders?filter=finish"><?php echo __('Выполненные'); ?></a></li>
                  <li><a href="/orders?filter=cancel"><?php echo __('Отклонено'); ?></a></li>
                </ul> 
              </li>
              <li><a href="/about"><?php echo __('О нас'); ?></a></li>
              <li><a href="/faq">FAQ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="<?php if($_SESSION['lang']=='ru') echo "active"; ?>"><a href=".?lang=ru">RU <span class="sr-only">(current)</span></a></li>
              <li class="<?php if($_SESSION['lang']=='kz') echo "active"; ?>"><a href=".?lang=kz">KZ</a></li>
              <li class="<?php if($_SESSION['lang']=='en') echo "active"; ?>"><a href=".?lang=en">EN</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <hr>
        <center>  
    <div class="upload">
      <span class="message">Загрузить файл</span>
      <form id="uploader" action="/upload.php" method="post" enctype="multipart/form-data">
        <input onchange="$('#uploader').submit()" type="file" name="file[]" multiple>
      </form>
    </div>
    </center>
    <div id="dropbox">
      <span class="message">Dropни файл для загрузки. <br /><i>(это видно только для тебя)</i></span>
    
      <?php 
        $hash = mysql_real_escape_string(get_link($_SERVER['REQUEST_URI'])[0]);
        $files = SQL::execute("SELECT * FROM files WHERE hash='$hash';");

        if(!empty($files)){
          // var_dump($files);
          foreach ($files as $file) {
            if(preg_match('#image#', $file['type'])){
              $src = $file['path'];
            }else{
              $src = '/assets/img/done.png';
            }
        $path = $file['path'];
echo <<<END
<a href="$path">
<div class="preview"><span class="imageHolder">
<img src="$src" style="max-width: 240px;
max-height: 180px;"> <h4></h4><span class="uploaded"></span></span>
</div>
</a>
END;
          }
        }
       ?>

    </div>

      <hr>

      <div class="footer">
        <p>© KTGA.KZ <?php echo date('Y'); ?></p>
      </div>
    </div>
    <!-- // <script src="/js/jquery-2.1.3.js"></script> -->
    <script src="/js/bootstrap-transition.js"></script>
    <script src="/js/bootstrap-alert.js"></script>
    <script src="/js/bootstrap-modal.js"></script>
    <script src="/js/bootstrap-dropdown.js"></script>
    <script src="/js/bootstrap-scrollspy.js"></script>
    <script src="/js/bootstrap-tab.js"></script>
    <script src="/js/bootstrap-tooltip.js"></script>
    <script src="/js/bootstrap-popover.js"></script>
    <script src="/js/bootstrap-button.js"></script>
    <script src="/js/bootstrap-collapse.js"></script>
    <script src="/js/bootstrap-carousel.js"></script>
    <script src="/js/bootstrap-typeahead.js"></script>
          <!-- Including The jQuery Library -->
    <script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
    
    <!-- Including the HTML5 Uploader plugin -->
    <script src="assets/js/jquery.filedrop.js"></script>
    
    <!-- The main script file -->
    <script src="assets/js/script.js"></script>
    <script src="/js/main.js"></script>
  
</body>
</html>
