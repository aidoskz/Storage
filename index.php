<?php 
include 'function.php';


  if(trim(get_link($_SERVER['REQUEST_URI'])[0])=='api')  {
    header("Content-Type: application/json");
    echo json_encode(array(1,2,3,45,6));
    exit();
  }

if(trim(get_link($_SERVER['REQUEST_URI'])[0])==''){

    header('Location:/'.(md5(session_id().date('Ymdhs'))));
}
function __($value='')
{
  return $value;
}

        $hash = mysql_real_escape_string(get_link($_SERVER['REQUEST_URI'])[0]);
        $files = SQL::execute("SELECT * FROM files WHERE hash='$hash';");
 
 
  if(is_json()){
    header("Content-Type: application/json");
    echo json_encode($files);
    exit();
  }elseif(is_xml()){
    header("Content-Type: application/rss+xml;");
    // $xml = new SimpleXMLElement('<root/>');
    // array_walk_recursive($files, array ($xml, 'addChild'));
    // print $xml->asXML();
    echo array_to_xml($files);
    exit();
  }
 

 ?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo (!empty($title)) ? $title : __('Файловая хранилище') . ' KTGA.KZ'; ?></title>
	<meta name="author" content="Aidos Kakimzhanov" />
	<meta property="og:title" content="<?php echo (!empty($title)) ? $title : '';  ?>" />
	<meta property="og:url" content="<?php echo (!empty($url)) ? $url : $_SERVER['REQUEST_URI'];  ?>" />
	<meta property="og:type" content="<?php echo (!empty($type)) ? $type : 'website';  ?>" />
	<meta property="og:image" content="<?php echo (!empty($image)) ? $image : '';  ?>" />
	<meta property="og:updated_time" content="<?php echo time(); ?>" />
  <meta name="google-site-verification" content="tST01OL5B0WHq3g-mj4caeFDjvsJtRoWEjUPIfTbUH0" />
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
    <link rel="stylesheet" type="text/css" href="/css/flaticon.css"/>
</head>
<body>
<div class="container">
      <!-- <div>
        <a href="/">
          <img src="/public/image/logo.png" alt="<?php echo __('Файловая хранилище') . ' KTGA.KZ'; ?>">
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
            <a class="navbar-brand" href="/"><?php echo __('Файловая хранилище') . ' KTGA.KZ'; ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/"><?php echo __('Главная'); ?></a></li>
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
        <center>  
          <style>

        .logo{
          background-image: url('/logo.jpg');
          background-size: contain;
          background-position: center center;
          background-repeat: no-repeat;
          width:100%;
          min-height:100px;
        }
          .btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  background: red;
  cursor: inherit;
  display: block;
}
input[readonly] {
  background-color: white !important;
  cursor: text !important;
}

/*Thumbnails*/
.thumbnail {
    position: relative;
    padding: 0px;
    margin-bottom: 20px;
}

.thumbnail > h4 {
    padding: 7px 5px 0px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.thumbnail h4 .info {
    position: absolute;
    top: 0px;
    right: 0px;
    font-size: 0.6em;
    padding-left: 15px;
    border-top-right-radius: 3px;
    border-bottom-left-radius: 4px;
    border-radius: 0px;
    border-bottom-left-radius: 5px;
    cursor:  pointer;
}

.thumbnail h4 .info > span {
    margin-right: 10px;   
}

.thumbnail img {
    width: 100%;
}
.thumbnail a.btn {
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
}


@media (max-width: 400px) {
  .navbar-brand {
    font-size: 14px;
  }
}

.back-to-top {
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display:none;
}


</style>
          <div class="logo" alt="storage.ktga.kz"></div>
    <div class="upload"> 
      <span class="message btn btn-block btn-lg btn-primary file-input btn-file">Загрузить файл
      <form id="uploader" action="/upload.php" method="post" enctype="multipart/form-data">
        <input class="" data-filename-placement="inside" onchange="waitingDialog.show('Загружается');$('#uploader').submit();" type="file" name="file[]" multiple>
      </form>
      </span>
    </div>
    </center>
    <br>
    <div id="dropbox">
      
    
      <?php 

        if(!empty($files)){
          // var_dump($files);
          echo '<div class="clearfix"></div>';
        	echo '<center><span class="message col-sm-6 col-md-4"><b>Ваша ссылка :</b> </span><a href="http://storage.ktga.kz/'.trim(get_link($_SERVER['REQUEST_URI'])[0]) .'">http://storage.ktga.kz/'.trim(get_link($_SERVER['REQUEST_URI'])[0]) .'</a></center> <br>';
          echo '<div class="clearfix"></div>';
          foreach ($files as $file) {

              $path = $file['path'];

            if(preg_match('#image#', $file['type'])){
              $src = $file['path'];
            }else{
              $src = '/assets/img/done.png';
            }

echo <<<END
<div class="col-sm-6 col-md-4 col-xs-12 col-lg-3">
  <div class="thumbnail">
      <h4><span class="label label-info info">
              <span data-toggle="tooltip" title="viewed">257 <b class="glyphicon glyphicon-eye-open"></b></span>
              <span data-toggle="tooltip" title="size">$file[size] <b class="glyphicon glyphicon-floppy-disk"></b></span>

          </span>
      </h4>
      <img src="$src" alt="$file[name]">
      <a href="$path" class="btn btn-primary col-xs-12" role="button">$file[name]</a>
      <div class="clearfix"></div>
  </div>
</div>
END;
          }
        }
        //else{
        	//echo '<span class="message">Dropни файл для загрузки. <br /><i>(это видно только для тебя)</i></span>';
        //} 
       ?>

    </div>
<div class="clearfix"></div>
  <footer class="bs-footer" role="contentinfo">
    
      <div class="footer">
        <p>© KTGA.KZ <?php echo date('Y'); ?></p>
      </div>
  </footer>
  </div>  
    <script src="/js/jquery-2.1.3.js"></script>
    <script src="/js/bootstrap-min.js"></script>
<!--     // <script src="/js/bootstrap-transition.js"></script>
    // <script src="/js/bootstrap-alert.js"></script>
    // <script src="/js/bootstrap-modal.js"></script>
    // <script src="/js/bootstrap-dropdown.js"></script>
    // <script src="/js/bootstrap-scrollspy.js"></script>
    // <script src="/js/bootstrap-tab.js"></script>
    // <script src="/js/bootstrap-tooltip.js"></script>
    // <script src="/js/bootstrap-popover.js"></script>
    // <script src="/js/bootstrap-button.js"></script>
    // <script src="/js/bootstrap-collapse.js"></script>
    // <script src="/js/bootstrap-carousel.js"></script>
    // <script src="/js/bootstrap-typeahead.js"></script> -->
          <!-- Including The jQuery Library -->
<!--     // <script src="http://code.jquery.com/jquery-1.6.3.min.js"></script> -->
    
    <!-- Including the HTML5 Uploader plugin -->
    <script src="assets/js/jquery.filedrop.js"></script>
    
    <!-- The main script file -->
    <script src="assets/js/script.js"></script>
        <script src="/js/main.js"></script>
        <script>$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
        </script>
  <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" data-toggle="tooltip" role="button" title="Наверх" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
</body>
</html>
