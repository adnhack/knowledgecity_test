<?php

$text = <<<EOT
<br />
<br />
<code>
* This file is created to test the cookie authorization.<br />
* Use to set a valid token cookie: http://xxxxxxxxx.xxx/test.php?cookie=valid <br />
* Use to set an invalid token cookie: http://xxxxxxxxx.xxx/test.php?cookie=invalid <br />
* Use to display hello world: http://xxxxxxxxx.xxx/test.php <br />
* This test is based on the email aaron.aceves@gmail.com and password swordfish <br />
* Change it if needed <br />
* <a href="/">Go back to Home</a>
</code>
EOT;


if(empty($_GET['cookie'])) {
  echo "hello world";
  echo $text;
  exit;
}

switch($_GET['cookie']) {
  case 'valid';
    $remembertime = time() + 3600 * 24 * 30;
    setcookie("userauth", "ec11d58778d58ffaf6c29cba8b68e1ba5211b567", $remembertime, "/");
    echo "Valid Token has been set";
    break;
  case 'invalid':
    $remembertime = time() + 3600 * 24 * 30;
    setcookie("userauth", "1234567890", $remembertime, "/");
    echo "Invalid Token has been set";
    break;
}

echo $text;
?>


* This file is created to test the cookie authorization.
* Use to set a valid token cookie: http://xxxxxxxxx.xxx/test.php?cookie=valid
* Use to set an invalid token cookie: http://xxxxxxxxx.xxx/test.php?cookie=invalid
* Use to display hello world: http://xxxxxxxxx.xxx/test.php
* This test is based on the email aaron.aceves@gmail.com and password swordfish
* Change it if needed
