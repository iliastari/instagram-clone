<?php

//Database gegevens
define('HOST','localhost');
define('HOST_NAME','root');
define('HOST_PASSWORD','password');
define('DB_NAME','databasename');


// Extra
define('SITE_URL','http://localhost/');
define('SITE_NAME','MediaConnect');

define('captcha', '2'); // 0 = geen captcha / 1 = werkende captcha / 2 = captcha zichtbaar maar je kan registeren zonder te gebruiken

/* Als je captcha gebruikt */
define('PUBLIC_KEY', '6Ld6qyAUAAAAABkUDX2uOXiHyFAhkO9lsEA6NyTf'); // SITE_KEY - reCaptcha Public key
define('PRIVATE_KEY', '6Ld6qyAUAAAAAKHdkDLsPBmoqXleeEiy-_yVfYSs'); // SECRET_KEY - reCaptcha Private key

define('LIBS', 'libs/');
