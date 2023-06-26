<?php

// Step 3: Handle the callback from Google's authorization server

if (isset($_GET['code'])) {
    $authCode = $_GET['code'];

    // Step 4: Exchange authorization code for access token

    $clientID = '909219603358-jfigf9revqvqp79do8f8qo4f4m41m56i.apps.googleusercontent.com';
    $clientSecret = 'your-client-secret';
    $redirectURI = 'http://example.com/oauth_callback.php';

    $tokenURL = 'https://accounts.google.com/o/oauth2/token';

    $postData = array(
        'code' => $authCode,
        'client_id' => $clientID,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectURI,
        'grant_type' => 'authorization_code'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Step 5: Extract the access token from the response

    $responseData = json_decode($response, true);
    $accessToken = $responseData['access_token'];

    // Now you have the access token and can use it to make requests to the Google API
    // For example, you can fetch the user's profile information

    $profileURL = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . urlencode($accessToken);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $profileURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $profileData = curl_exec($ch);
    curl_close($ch);

    // Process the profile data
    // ...
    // You can also store the access token for future use, such as making subsequent API requests

} else {
    echo 'Authorization failed.';
}

?>