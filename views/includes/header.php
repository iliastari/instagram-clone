<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width,user-scalable=no" name="viewport">
	<title><?php echo SITE_NAME; ?></title>
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700|Kaushan+Script|Montserrat|Raleway' rel='stylesheet' type='text/css'>
	<link href="<?php echo SITE_URL; ?>favicon.png" rel="shortcut icon" type="image/png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
	<script src="<?php echo SITE_URL;?>/assets/js/bootstrap.js"></script>
	<script src="<?php echo SITE_URL;?>views/js/navigator.js?<?php echo mt_rand(); ?>"></script>
        <?php
            if(isset($this->js)) 
            {  
                foreach($this->js as $js)
                {
                    echo '<script type="text/javascript" src="'.SITE_URL.'views/js/'.$js.'?'.mt_rand().'"></script>';
                }
            }
        ?>
        
        <?php
            if(isset($this->css)) 
            {  
                foreach($this->css as $css)
                {
                    echo '<link rel="stylesheet" href="'.SITE_URL.'assets/css/'.$css.'?'.mt_rand().'">';
                }
            }
        ?>
        
	<link href="<?php echo SITE_URL;?>/assets/css/bootstrap.css?<?php echo mt_rand(); ?>" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css/font-awesome.min.css">
	<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
	<link href="<?php echo SITE_URL;?>/assets/css/style.css?<?php echo mt_rand(); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL;?>/assets/css/animate.css?<?php echo mt_rand(); ?>" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  
      <a class="navbar-brand fancy-font" href="<?php echo SITE_URL; ?>"><?php echo SITE_NAME; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
	  
        <li class="nav-icons"><a href="<?php echo SITE_URL; ?>"><i class="glyphicon glyphicon-home"></i></a></li>
        <li class="nav-icons"><a href="<?php echo SITE_URL; ?>upload"><i class="glyphicon glyphicon-camera"></i></a></li>
     <!--   <li class="nav-icons"><a href="#"><i class="glyphicon glyphicon-inbox"></i></a></li> -->
	
        <li class="dropdown nav-username nav-icons">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">	
				<img class="nav-user-img" src="<?php echo SITE_URL."assets/images/profile/".$this->userData['profile_image']; ?>" alt="">	
			<span class="caret"></span></a>
          <ul class="dropdown-menu settings-drop">
            <li><a href="<?php echo SITE_URL."user"; ?>">Mijn profiel</a></li>
            <li><a href="<?php echo SITE_URL."settings"; ?>">Instellingen</a></li>
            <li class="disabled"><a href="#">Privacy</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo SITE_URL."settings/logout"; ?>">Uitloggen</a></li>
          </ul>
        </li>
      </ul>
	  <form method="post" action="" id="search" class="navbar-form" role="search">
        <div class="form-group">
		
			<input type="text" name="search" class="input-search" placeholder="Zoeken.." onkeyup="searchq();" autocomplete="off">
			<i class="placeSearch fa fa-search" aria-hidden="true"></i>
<div id="searchData" class="arrow_box" hidden>
</div>
		</div>
     </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>