<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Psr\Http\Message\ServerRequestInterface;

// Load the necessary dependencies and configurations
require 'con.php'; // Database connection file

// Create a new ResourceServer instance
$accessTokenRepository = null; // Replace with your access token repository instance
$scopeRepository = null; // Replace with your scope repository instance

$server = new ResourceServer(
    $accessTokenRepository,
    $scopeRepository
);

// Handle the API request with OAuth authentication
try {
    $request = ServerRequestInterface::fromGlobals();
    $server->validateAuthenticatedRequest($request);

    // OAuth authentication successful, proceed with your CRUD operations

    $response = array();
    if ($con) {
        $query = "SELECT * FROM Customers";
        $result = mysqli_query($con, $query);
        if ($result) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $response[$i]['customer_id'] = $row['customer_id'];
                $response[$i]['customer_name'] = $row['customer_name'];
                $response[$i]['address'] = $row['address'];
                $response[$i]['mobile_number'] = $row['mobile_number'];
                $response[$i]['contact_person'] = $row['contact_person'];
                $response[$i]['email'] = $row['email'];
                $i++;
            }
            header("Content-type: application/json");
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    } else {
        echo "Not Connected";
    }
} catch (OAuthServerException $e) {
    // OAuth authentication failed, handle the error
    $response = $e->generateHttpResponse(new \Slim\Psr7\Response());
    echo $response->getBody();
    die();
}
