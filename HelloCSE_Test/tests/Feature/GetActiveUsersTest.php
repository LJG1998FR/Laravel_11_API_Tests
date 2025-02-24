<?php
 
namespace Tests\Feature;
 
use Tests\TestCase;
 
class GetActiveUsersTest extends TestCase
{
    /**
     * Test "getActiveUsers" endpoint
     */
    public function test_get_active_users_request(): void
    {
        $response = $this->getJson('/api/getActiveUsers', []);
 
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);

        $response->ddJson();
    }
}