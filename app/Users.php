<?php

/*
* Class Users
* Description: Handle the users information
* Author Aaron Aceves
*/
class Users
{

  public $email, $rememberme;
  private $password;

  public function __construct(array $data)
  {
    $this->email = $data['useremail'];
    $this->password = $data['userpassword'];
    $this->rememberme = $data['rememberuser'] == 'false' ? false : true;
  }

  /*
  * Description: Format the user credentials and encrypt the password
  * @visibility public
  * @param void
  * @return array $result
  */
  public function getUserCredentials() :array
  {
    return [ 'email' => $this->email, 'password' => sha1($this->password) ];
  }

  /*
  * Description: Return the user email based on the token
  * @visibility public
  * @param string $token
  * @return string $email
  */
  public function getUserEmail(string $token) :string
  {
    return $this->email;
  }

  /*
  * Description: Return the remember user boolean
  * @visibility public
  * @param void
  * @return boolean $result
  */
  public function getRememberUser() :bool
  {
    return $this->rememberme;
  }

}
