<?php
 
namespace Tests\Feature;

use App\Enums\UserStatus;
use App\Models\Admin;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
 
class UpdateUserTest extends TestCase
{
    /**
     * Test "updateUser" endpoint
     */
    public function test_update_user_status_success_request(): void
    {
        $admin = Admin::first();
        $this->be($admin);
        $request = new Request();
        
        $request->replace([
            'lastname'  => 'Renouveau',
            'status' => 'inactif',
        ]);

        $this->assertAuthenticatedAs($admin, $guard = null); // check if user is authenticated

        $oldUser = User::where('email', 'test123@test.dev')->first();
        
        $response = $this->actingAs($admin)->putJson('/api/updateUser', [
            'user' => $oldUser, 
            'request' => $request
        ]);
 
        $response->assertStatus(200);
    }

    /**
     * Test "updateUser" endpoint - update photo
     */
    public function test_update_user_photo_status_success_request(): void
    {
        $admin = Admin::first();
        $this->be($admin);

        $filename = time() . '_' . 'image.png';
        $image = UploadedFile::fake()->image($filename);
        $request = new Request();
        
        $request->replace([
            'image' => $image,
            'image_path' => $filename
        ]);

        $this->assertAuthenticatedAs($admin, $guard = null); // check if user is authenticated

        $oldUser = User::where('email', 'm.olive@test.dev')->first();
 
        $response = $this->actingAs($admin)->putJson('/api/updateUser', [
            'user' => $oldUser->toArray(), 
            'request' => $request->all()
        ]);

        $response->assertStatus(200);
    }


    /**
     * Test "updateUser" endpoint failure (no user)
     */
    public function test_update_user_unauthenticated_request(): void
    {
        $this->assertGuest(null); // check if no user is authenticated

        $request = [
            'lastname'  => 'Renouveau',
            'status' => 'inactif',
        ];

        $oldUser = User::where('email', 'm.olive@test.dev')->first();
        $response = $this->putJson('/api/updateUser',  ['user' => $oldUser, 'request' => $request]);
        $response->assertStatus(403);
    }
}