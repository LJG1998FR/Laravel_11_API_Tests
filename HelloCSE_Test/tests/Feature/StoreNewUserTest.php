<?php
 
namespace Tests\Feature;

use App\Enums\UserStatus;
use App\Models\Admin;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
 
class StoreNewUserTest extends TestCase
{
    /**
     * Test "storeNewUser" endpoint (success)
     */
    public function test_store_new_user_success_request(): void
    {
        $admin = Admin::first();
        $this->be($admin);

        $filename = time() . '_' . 'image.png';
        $image = UploadedFile::fake()->image($filename);

        $request = [
            'firstname' => 'Martin',
            'lastname'  => 'Matin',
            'email'     => 'm.matin@dev.com',
            'status' => 'actif',
            'image_path' => $filename,
            'image' => $image
        ];

        $this->assertAuthenticatedAs($admin); // check if user is authenticated
        
        $response = $this->actingAs($admin)->postJson('/api/storeNewUser', $request);
 
        $response->assertStatus(200);
    }


    /**
     * Test "storeNewUser" endpoint failure (no user)
     */
    public function test_store_new_user_unauthenticated_request(): void
    {
        $this->assertGuest(null); // check if no user is authenticated

        $filename = time() . '_' . 'image.png';
        $image = UploadedFile::fake()->image($filename);

        $request = [
            'firstname' => 'Martin',
            'lastname'  => 'Matin',
            'email'     => 'm.matin@dev.com',
            'status' => 'actif',
            'image_path' => $filename,
            'image' => $image
        ];

        $response = $this->postJson('/api/storeNewUser',  $request);
        $response->assertStatus(403);
    }

    /**
     * Test "storeNewUser" endpoint failure (missing field)
     */
    public function test_store_new_user_failure_missing_field_request(): void
    {
        $admin = Admin::first();
        $this->be($admin);

        $filename = time() . '_' . 'image.png';
        $image = UploadedFile::fake()->image($filename);

        $request = [
            'firstname' => 'Robert',
            'lastname'  => null,
            'email'     => 'r.paul@gmail.com',
            'status' => 'actif',
            'image_path' => $filename,
            'image' => $image
        ];

        $this->assertAuthenticatedAs($admin, $guard = null); // check if user is authenticated
        
        $response = $this->actingAs($admin)->postJson('/api/storeNewUser', $request);
 
        $response->assertInvalid(['lastname']);
    }
}