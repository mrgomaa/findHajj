<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\city;

class cityApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_city()
    {
        $city = city::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cities', $city
        );

        $this->assertApiResponse($city);
    }

    /**
     * @test
     */
    public function test_read_city()
    {
        $city = city::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cities/'.$city->id
        );

        $this->assertApiResponse($city->toArray());
    }

    /**
     * @test
     */
    public function test_update_city()
    {
        $city = city::factory()->create();
        $editedcity = city::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cities/'.$city->id,
            $editedcity
        );

        $this->assertApiResponse($editedcity);
    }

    /**
     * @test
     */
    public function test_delete_city()
    {
        $city = city::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cities/'.$city->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cities/'.$city->id
        );

        $this->response->assertStatus(404);
    }
}
