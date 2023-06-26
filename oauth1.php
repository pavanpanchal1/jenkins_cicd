<?php
// Step 1: User clicks on the "Sign in with Google" button on your website
error_reporting(E_ALL);
ini_set('display_errors',1);
// Step 2: Redirect the user to Google's authorization server
$clientID = '909219603358-jfigf9revqvqp79do8f8qo4f4m41m56i.apps.googleusercontent.com';
$redirectURI = 'http://localhost/mywork/Final/oauth1.php';
$scope = 'panchalpavan800@gmail.com';

$authURL = 'https://accounts.google.com/o/oauth2/auth?' .
    'client_id=' . urlencode($clientID) .
    '&redirect_uri=' . urlencode($redirectURI) .
    '&scope=' . urlencode($scope) .
    '&response_type=code';

header('Location:oauth1.php');
exit;

?>