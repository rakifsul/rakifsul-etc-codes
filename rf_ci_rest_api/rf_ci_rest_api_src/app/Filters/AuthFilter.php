<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;
use Exception;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader || stripos($authHeader, 'Bearer ') !== 0) {
            return Services::response()
                ->setStatusCode(401)
                ->setJSON(['status' => 'error', 'message' => 'No token provided']);
        }

        $token = trim(substr($authHeader, 7));
        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
            // Attach user id to request attribute (available via service('request')->user_id)
            $request->user_id = $decoded->sub ?? null;
        } catch (Exception $e) {
            return Services::response()
                ->setStatusCode(401)
                ->setJSON(['status' => 'error', 'message' => 'Invalid token']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No-op
    }
}
