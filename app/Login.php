<?php

/*
* Class: Login
* Description: Login, logout and validate the user credentials
* @author Aaron Aceves
*/

class Login
{

  private $users, $dbconnection;

  public function __construct(Users $users, Database $db)
  {
    $this->dbconnection = $db->getConnection();
    $this->users = $users;
  }

  /*
  * Description: Log the user into the system
  * @visibility public
  * @param void
  * @return boolean $valid
  */
  public function logIn() :bool
  {
    $credentials = $this->users->getUserCredentials();
    $valid = $this->validateCredentials($credentials);
    if($valid) {
      $token = $this->setToken($credentials);
      $this->setUserCookie($token, $this->users->getRememberUser());
    }
    return empty($valid) ? false : true;
  }

  /*
  * Description: Create the access token and save it to the DB
  * @visibility public
  * @param array $credentials
  * @return string $token
  */
  public function setToken(array $credentials) :string
  {
    $token = sha1($credentials['email'].$credentials['password']);
    $current_date = date("Y-m-d", mktime(0,0,0, date("m"), date("d")+30, date("Y")));
    $sql = $this->dbconnection->prepare("UPDATE api_users SET token = :token, valid = :valid WHERE email = :email AND password = :password");
    $result = $sql->execute([ 'token' => $token, 'valid' => $current_date, 'email' => $credentials['email'], 'password' => $credentials['password']]);

    return $token;
  }

  /*
  * Description: Validate the user credentials email/password
  * @visibility private
  * @param array $credentials
  * @return boolean
  */
  private function validateCredentials(array $credentials) :bool
  {
    $sql = $this->dbconnection->prepare("SELECT 1 FROM api_users WHERE email = :email AND password = :password");
    $sql->execute(['email' => $credentials['email'], 'password' => $credentials['password']]);
    return empty($sql->fetch(PDO::FETCH_ASSOC)) ? false : true;
  }

  /*
  * Description: Create and set the user cookie with the access token
  * @visibility private
  * @param string $token
  * @param boolean $rememberuser
  * @return void
  */
  private function setUserCookie(string $token, bool $rememberuser)
  {
    $remembertime = empty($rememberuser) ? 0 : time() + 3600 * 24 * 30;
    setcookie("userauth", $token, $remembertime, "/");
  }

  /*
  * Description: Logout the user from the system, remove the token and the valid date
  * from DB and remove the user cookie from the browser
  * @callable static
  * @visibility public
  * @param string $token
  * @param Database $db
  * @return boolean $result
  */
  static public function logOut(string $token, Database $db) :bool
  {
    $dbconnection = $db->getConnection();
    $sql = $dbconnection->prepare("UPDATE api_users SET token = NULL, valid = NULL WHERE token = :token");
    $sql->execute([ 'token' => $token ]);
    $result = $sql->rowCount();
    setcookie("userauth", null, time() - 3600);

    return empty($result) ? false : true;
  }

  /*
  * Description: Validate the access token. If not valid remove the cookie
  * @callable static
  * @visibility public
  * @param string $token
  * @param Database $db
  * @return boolean $result
  */
  static public function validateToken($token, Database $db) :bool
  {
    $current_date = date("Y-m-d", mktime(0,0,0, date("m"), date("d"), date("Y")));
    $dbconnection = $db->getConnection();
    $sql = $dbconnection->prepare("SELECT token FROM api_users WHERE valid >= :valid AND token = :token");
    $sql->execute(['valid' => $current_date, 'token' => $token]);
    $result = true;

    if(empty($sql->fetch(PDO::FETCH_ASSOC))) {
      setcookie("userauth", null, time() - 3600);
      $result = false;
    }

    return $result;
  }

}
