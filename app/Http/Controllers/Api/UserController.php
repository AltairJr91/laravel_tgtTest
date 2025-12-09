<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserServices;
use App\DTOs\UserDTO;
use App\Models\User;
use App\Requests\StoreUserRequest;
use App\Requests\UpdateUserRequest;


class UserController extends Controller
{
    public function __construct(private UserServices $service) {}

    public function store(StoreUserRequest $req)
    {
        $data = $req->validated();

        $dto = new UserDTO(
            $data['name'],
            $data['email'],
            $data['phone'] ?? null, 
            $data['cpf'],
            $data['password'],
        );
        try {
            $user = $this->service->create($dto);
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create user', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateUserRequest $req,  $id)
    {
        $dto = new UserDTO(
            $req->name,
            $req->email,
            $req->phone,
            $req->cpf,
            $req->password
        );
        try {
            $updateUser = $this->service->update($dto, $id);
            return response()->json([
                'message' => 'User updated successfully',
                'user' => $updateUser
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not update user', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $user = $this->service->find($id);
        if (!$user) return response()->json([
            'message' => 'User not found',
            'error' => 'User with id ' . $id . ' does not exist or has been deleted'
        ], 404);

        return response()->json(
            [
                'message' => 'User retrieved successfully',
                'user' => $user,
            ],
            200
        );
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(
            [
                'message' => 'User deleted successfully',
                'deletion_type' => 'soft'
            ],
            200
        );
    }

    public function index()
    {
        $users = $this->service->index();
        return response()->json(
            [
                'message' => 'Users retrieved successfully',
                'users' => $users,
            ],
            200
        );
    }
}
