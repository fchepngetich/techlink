<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJWT($data, $secret, $expiry = 3600)
{
    $issuedAt = time();
    $payload = [
        'iat' => $issuedAt,
        'exp' => $issuedAt + $expiry,
        'data' => $data
    ];
    return JWT::encode($payload, $secret, 'HS256');
}

function validateJWT($token, $secret)
{
    try {
        return JWT::decode($token, new Key($secret, 'HS256'));
    } catch (Exception $e) {
        return null;
    }
}
