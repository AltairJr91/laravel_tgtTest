<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserPermissionServices;
use Illuminate\Http\Request;
use App\Services\UserServices;

class UserPermissionController extends Controller
{
    public function __construct(
        private UserPermissionServices $service,
        private UserServices $userService
        ) {}

    public function assign(Request $request, $id)
    {
        $user = $this->userService->find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'error' => 'User with id ' . $id . ' does not exist or has been deleted'
            ], 404);
        }

        //Poderia ter feito também um FormRequest para validação
        $request->validate([
            'permission' => 'nullable|string',
            'role' => 'nullable|string',
        ]);

        $this->service->autoAssignAdmin($user);

        if ($request->permission) {
            $this->service->assignPermission($user, $request->permission);
        }

        if ($request->role) {
            $this->service->assignRole($user, $request->role);
        }

        return response()->json([
            'message' => 'Permissão atribuída com sucesso.'
        ], 200);
    }
}
