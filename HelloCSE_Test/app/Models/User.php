<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'image_path',
        'email',
        'status'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => UserStatus::class
        ];
    }


    /**
     * Get active users
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getActiveUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return User::select(['firstname', 'lastname', 'email', 'image_path', 'created_at', 'updated_at'])->where('status', '=', 'actif')->get();
    }

    /**
     * Add a new user to the database
     * @param mixed $validated
     * @return array
     */
    protected function storeNewUser(mixed $validated) {

        if(file_exists(public_path('images/')) === false){
            mkdir(public_path('images/'), 757, true);
        }
        
        $filepath = public_path('images/') . $validated['image_path'];
        $image = $validated['image'];

        $newUser = User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'image_path' => $validated['image_path'],
            'status' => $validated['status'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
		
        if(file_put_contents($filepath, $image) === false){
            return [
                "success" => false,
                "data" => [
                    "errorCode" => -2,
                    "errorMessage" => "The photo could not be uploaded."
                ]
            ];
        }



        return [
            "success" => true,
            "data" => [
                "user" => $newUser
            ]
        ];
    }

    /**
     * Update a user from the database
     * @param User $user, array $data
     * @param array $validated
     * @return array
     */
    protected function updateUser(User $user, array $validated) {

        if(file_exists(public_path('images/')) === false){
            mkdir(public_path('images/'), 757, true);
        }

        $oldUser = $user->replicate();
        
        $dataUpdate = [
            'firstname' => $validated['firstname'] ?? $oldUser->firstname,
            'lastname' => $validated['lastname'] ?? $oldUser->lastname,
            'email' => $validated['email'] ?? $oldUser->email,
            'image_path' => $validated['image_path'] ?? $oldUser->image_path,
            'status' => $validated['status'] ?? $oldUser->status,
            'updated_at' => now()
        ];

        $user->update($dataUpdate);
		
        if(isset($dataUpdate['image_path']) === true && isset($validated['image']) === true){
            $filepath = public_path('images/') . $dataUpdate['image_path'];
            $image = $validated['image'];
            if(file_put_contents($filepath, $image) === false){
                return [
                    "success" => false,
                    "data" => [
                        "errorCode" => -2,
                        "errorMessage" => "The photo could not be uploaded."
                    ]
                ];
            } else {
                $oldFilename = $oldUser->image_path;
                unlink(public_path('images/') . $oldFilename);
            }
           
        }

        return [
            "success" => true,
            "data" => [
                "oldUser" => $oldUser,
                "user" => $user
            ]
        ];
    }


    /**
     * Delete a user from the database
     * @param User $user
     * @return array
     */
    protected function deleteUser($user){

        unlink(public_path('images/') . $user->image_path);
        $user->delete();

        return [
            "success" => true,
            "data" => null
        ];
    }
}
