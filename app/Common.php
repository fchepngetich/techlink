<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

 use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// function generateJWT($data, $secret, $expiry = 3600)
// {
//     $issuedAt = time();
//     $payload = [
//         'iat' => $issuedAt,
//         'exp' => $issuedAt + $expiry,
//         'data' => $data
//     ];
//     return JWT::encode($payload, $secret, 'HS256');
// }

function generateJWT($data, $secret, $expiry = 3600)
{
    if (!$data || !$secret) {
        return null; 
    }

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
    if (!$token || !$secret) {
        return null; 
    }

    try {
        return JWT::decode($token, new Key($secret, 'HS256'));
    } catch (Exception $e) {
        return null; 
    }
}
