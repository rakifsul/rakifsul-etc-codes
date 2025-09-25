<?php

namespace App\Controllers\Api;

use App\Models\UserModel;

class UserController extends BaseApiController
{
    protected $modelName = UserModel::class;
    protected $format    = 'json';

    public function index() // GET /api/users
    {
        $users = $this->model->select('id, username, email, created_at, updated_at')->findAll();
        return $this->respondSuccess($users);
    }

    public function show($id = null) // GET /api/users/{id}
    {
        $user = $this->model->select('id, username, email, created_at, updated_at')->find($id);
        if (!$user) {
            return $this->respondError('User not found', 404);
        }
        return $this->respondSuccess($user);
    }

    public function create() // POST /api/users
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();
        if (!is_array($data)) {
            return $this->respondError('Invalid payload', 422);
        }

        if (empty($data['username']) || empty($data['password'])) {
            return $this->respondError('username and password are required', 422);
        }

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        if (!$this->model->insert($data)) {
            return $this->respondError('Validation failed', 422, $this->model->errors());
        }

        $id = $this->model->getInsertID();
        return $this->respondSuccess(['id' => $id], 201);
    }

    public function update($id = null) // PUT /api/users/{id}
    {
        $data = $this->request->getJSON(true);
        if (!is_array($data)) {
            return $this->respondError('Invalid payload', 422);
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        if (!$this->model->update($id, $data)) {
            return $this->respondError('Validation failed', 422, $this->model->errors());
        }

        return $this->respondSuccess(['updated' => (int) $id]);
    }

    public function partialUpdate($id = null) // PATCH /api/users/{id}
    {
        return $this->update($id);
    }

    public function delete($id = null) // DELETE /api/users/{id}
    {
        if (!$this->model->delete($id)) {
            return $this->respondError('Delete failed', 400);
        }
        return $this->respondSuccess(['deleted' => (int) $id]);
    }
}
