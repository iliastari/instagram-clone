<!doctype html>
<html lang="nl">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo SITE_NAME; ?></title>
  	<script src="https://www.google.com/recaptcha/api.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<?php
	if(isset($this->js)) {
		foreach($this->js as $js)
		{
			echo '<script src="'.SITE_URL.'views/'.$js.'?'.mt_rand().'" type="text/javascript"></script>';
		}
	} 
	?>
  <link href='http://fonts.googleapis.com/css?family=Lato:400,700|Kaushan+Script|Montserrat:300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/login_index.css?<?php echo mt_rand(); ?>">
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/animate.css?<?php echo mt_rand(); ?>">
  <link rel="icon" href="images/favicon.png">
  
</head>

<body class="background_gradient">
  <div class="container">
  
   <!-- Inloggen -->
  <div class="login_box animated bounceInLeft">
  <label class="logo fancy-font"><?php echo SITE_NAME; ?></label>

  <form class="inloggen_form">
	<div class="error_login"></div>
	<p><input type="text" placeholder="Gebruikersnaam" id="username"></p>
	<p><input type="password" placeholder="Wachtwoord" id="password"><a href="/test" class="forgot">Vergeten?</a></p>
	<p><input type="submit" value="Inloggen" class="button" id="submit_btn"></p>
		
	<p class="small-text">Geen account? <a href="javascript:;" onclick="showregpage()"class="pagina">Registreer je dan</a></p>
  </form>
  
  </div>
  
  <!-- Registreren oproepen met Javascript (Jquery) -->
  <div class="register_box animated bounceInRight">
  <label class="logo fancy-font"><?php echo SITE_NAME; ?></label>

  <form class="reg_form">
	<div class="error_reg"></div>
	<p><input type="email" placeholder="Email" id="reg_email"></p>
	<p><input type="text" placeholder="Voornaam" id="reg_firstname" style="width:122px;"><input type="text" placeholder="Achternaam" id="reg_surname" style="width:122px;float:right;"></p>
	<p><input type="text" placeholder="Gebruikersnaam" id="reg_username"></p>
	<p><input type="password" placeholder="Wachtwoord" id="reg_password"></p>
	<?php 
	switch (captcha) {
    case 1:
        echo '<p><div class="g-recaptcha" data-sitekey="'.PUBLIC_KEY.'"></div></p>';
        break;
    case 2:
         echo '<p><div class="g-recaptcha" data-sitekey="'.PUBLIC_KEY.'"></div></p>';
        break;
	}
	?>
	<p><input type="submit" value="Registreren" class="button" id="reg_btn"></p>
	

	<p class="small-text">Al een account? <a href="javascript:;" onclick="showloginpage()" class="pagina">Log dan in</a></p>
	
  </form>
  </div>
  
  </div>
</body>

</html>