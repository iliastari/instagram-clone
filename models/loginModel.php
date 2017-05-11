<?php 

class loginModel extends Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function login() 
	{
                AjaxOnly();
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// PREPARED STATEMENT HELPT TEGEN SQL INJECTION
		$stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$data = $stmt->fetch();
		
		$id = $data['id'];
		$password_db = $data['password'];
		
		$count = $stmt->rowCount();
		
		// Alles checken
		if(empty($username)) {
			echo "Geen gebruikersnaam ingevuld";
		} elseif (empty($password)){
			echo "Geen wachtwoord ingevuld";
		} elseif ($count == 0){
			echo "Gebruikersnaam klopt niet";
		} elseif (password_verify($password, $data['password']) == false) {
			echo "Wachtwoord klopt niet";
		} elseif ($count > 0 && password_verify($password, $data['password']) == true) {
			Session::init();
			Session::set('loggedIn', true);
			Session::set('id', $data['id']);
            Session::set('username', $data['username']);
			
			redirectHTML("feed");
		} 
	}
	public function register()
	{
        AjaxOnly();
		$email = $_POST['email'];
		$username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];
		$password = $_POST['password'];
                $reg_ip = $_SERVER['REMOTE_ADDR'];
		$hashed_pass = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
		
		// Google recaptcha
		$response = $_POST["captcha"];
		$secret = PRIVATE_KEY;
		$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
		$captcha_success=json_decode($verify);

		$stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$data = $stmt->fetch();
		
		//Kijken of gebruiker bestaat
		$count = $stmt->rowCount();
			
		if(empty($email))
		{
			echo "Email niet ingevuld";
		} 
		elseif(empty($firstname)) 
		{
			echo "Voornaam niet ingevuld";
		}
		elseif(empty($surname)) 
		{
			echo "Achternaam niet ingevuld";
		}
		elseif(empty($username)) 
		{
			echo "Gebruikersnaam niet ingevuld";
		} 
		elseif(empty($password)) 
		{
			echo "Wachtwoord niet ingevuld";
		} 
		elseif($count > 0) 
		{
			echo "Gebruikersnaam is bezet";
		} 
		elseif($email == $data['email']) 
		{
			echo "Email bestaat al";
		} 
		elseif(!preg_match("/^[a-zA-Z\'\-\040]+$/", $firstname))
		{
			echo "Voer jouw volledige naam in";
		}
		elseif(!preg_match("/^[a-zA-Z\'\-\040]+$/", $surname))
		{
			echo "Voer jouw volledige naam in";
		}
		elseif( !ctype_alnum( $username ) )
		{
			echo "Gebruikersnaam is ongeldig";
		}
		elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
		{
			echo("<b>$email</b> is geen geldige email");
		}
		elseif (strlen($password) <= '6') 
		{
			echo "Wachtwoord moet minimaal 6 <b>tekens</b> bevatten";
		}
		elseif ($captcha_success->success==false && captcha == 1) 
		{
			echo "Captcha is niet ingevuld";
		} else {
			$stm = $this->db->prepare("INSERT INTO users (username, email, password, firstname, surname,reg_ip,last_ip,reg_date,last_online) VALUES (:username, :email, :hashedpassword, :firstname,:surname,:regIp,:lastIp ,UNIX_TIMESTAMP(),UNIX_TIMESTAMP())");
			$stm->execute([
                            ":username" => $username,
                            ":email" => $email,
                            ":hashedpassword" => $hashed_pass,
                            ":firstname" => $firstname,
                            ":surname" => $surname,
                            ":regIp" => $reg_ip,
                            ":lastIp" => $reg_ip
                        ]);
                        
                        Session::init();
                        Session::set('username', $username);
			redirectHTML("login/welcome");
		}	
	}
        public function welcome($sName) 
        {
            $stm = $this->db->prepare("SELECT id FROM users WHERE username = :username");
            $stm->execute([':username' => $sName]);
            $id = $stm->fetch();
            
            Session::init();
            Session::set('loggedIn', true);
            Session::set('id', $id['id']);
			
			redirectHTML("feed");
        }
        
}
