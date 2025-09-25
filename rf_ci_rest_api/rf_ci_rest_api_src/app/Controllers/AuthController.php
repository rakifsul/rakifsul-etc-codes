<?php

namespace App;
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends Controller
{
    public function login()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();
        if (!is_array($data) || empty($data['username']) || empty($data['password'])) {
            return $this->response->setStatusCode(422)->setJSON(['status' => 'error', 'message' => 'username and password are required']);
        }

        $model = new UserModel();
        $user  = $model->where('username', $data['username'])->first();

        if (!$user || !password_verify($data['password'], $user['password'])) {
            return $this->response->setStatusCode(401)->setJSON(['status' => 'error', 'message' => 'Invalid credentials']);
        }

        $key = getenv('JWT_SECRET');
        if (!$key) {
            return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'JWT secret not configured']);
        }

        $now  = time();
        $exp  = $now + 3600; // 1 hour
        $payload = [
            'iss' => 'ci4-rest-api',
            'sub' => (int) $user['id'],
            'iat' => $now,
            'nbf' => $now,
            'exp' => $exp,
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        return $this->response->setJSON([
            'status' => 'success',
            'token'  => $token,
            'exp'    => $exp,
        ]);
    }
}
