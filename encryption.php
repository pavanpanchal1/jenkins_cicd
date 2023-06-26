<?php

$example1 = "A";

echo " 1 . MD5 type encryption: " . md5($example1);
$b = md5($example1);
$c = "A";

$hash = sha1($example1);

echo "<br> 2 . SHA1 type encryption : " . $hash;

$ve = password_verify($c, $hash);

echo "<br> varify:" . $ve;

$password = "myPassword123";
$encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
echo "<br> 3 . Password_hash Type enc :" . $encryptedPassword;

$verify = password_verify($password, $encryptedPassword);

echo "<h1>verify:</h1>" . $verify;

$data = "Sensitive information";
$key = "mySecretKey";
$en = openssl_encrypt($data, "AES-256-CBC", $key);
$de = openssl_decrypt($en, "AES-256-CBC", $key);

echo "<br> 4 . Openssl_encrypt type:  " . $en;
echo "<br> 4 . Openssl_decryt type: " . $de;

?>