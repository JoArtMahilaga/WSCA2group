<?php
require_once 'libs/php-jwt-main/src/JWT.php';  // Include the JWT library
use Firebase\JWT\JWT;

require_once 'libs/php-jwt-main/src/Key.php';
use Firebase\JWT\Key;

global $secret_key;
$secret_key = "2172464e069513a0c765af87bd3fdc4fb1d720e9076384399494fab8447d631dd36460eca5b6360ba01898dec1f142855440c4550dccfdae70dcb24d57e0c75b3745ec5b5246d52b2332b8222910e2e2563c4cdf5afd781c374839a60104600efbd24414c7d4f2c4f2ac6f59672fdaf33b308692fc14536ac2f23ad0884436c9c91f1044eca64ed575d4b87f234cd2153e783821db3873cea5fe6c613e45a224f208c41f66968d3917a16f306fbb35fcf6fd106a0fdcb25f1db5e99e98e26266c45808b3dabaf9f6bb6f1f8036465e221df6968cecb56e522c123bffbaa8a308d25a7b6928e4083dd8ec3b0f37a3f347448736d7296312e86f059305a1e453d4";

// Decodes the JWT token and returns the decoded data
function decode_jwt($jwt) {
    global $secret_key;
    try {
        // Decode the JWT without passing the algorithms array as the third argument
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));

        return (array) $decoded;  // Return the decoded data as an array
    } catch (Exception $e) {
        // If JWT is invalid or expired, throw an exception
        echo $e->getMessage();
    }
}
