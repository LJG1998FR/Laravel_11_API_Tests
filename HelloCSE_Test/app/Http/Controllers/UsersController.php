<?php


namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\User\DeleteUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UsersController extends AdminController {


    /**
    * List active users
    *
    * @return array[]
    */
   public function getActiveUsers() {

        return [
            "success" => true,
            "data" => [
                "users" => User::getActiveUsers()
            ]
        ];
   }

    /**
     * Add a new user
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function storeNewUser(StoreUserRequest $request): JsonResponse
    {
        if(Auth::check() === false){
            return response()->json([
                "success" => false,
                "data" => [
                    "errorCode" => -1,
                    "errorMessage" => "Unauthenticated."
                ]
                ]);
        }

        $validated = $request->validated();
        
        $newUser = User::storeNewUser($validated);

        return response()->json($newUser);
    }

    /**
     * Update a user
     * @param User $user
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function updateUser(User $user, UpdateUserRequest $request): JsonResponse
    {
        if(Auth::check() === false){
            return response()->json([
                "success" => false,
                "data" => [
                    "errorCode" => -1,
                    "errorMessage" => "Unauthenticated."
                ]
                ]);
        }

        $validated = $request->validated();
        
        $updateUser = User::updateUser($user, $validated);

        return response()->json($updateUser);
    }

    
    /**
     * Update a user
     * @param User $user
     * @return JsonResponse
     */
    public function deleteUser(User $user): JsonResponse
    {
        if(Auth::check() === false){
            return response()->json([
                "success" => false,
                "data" => [
                    "errorCode" => -1,
                    "errorMessage" => "Unauthenticated."
                ]
                ]);
        }

        User::deleteUser($user);

        return response()->json([
            "success" => true,
            "data" => null
        ]);
    }

}
