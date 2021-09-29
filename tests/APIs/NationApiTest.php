<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Nation;

class NationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_nation()
    {
        $nation = Nation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/nations', $nation
        );

        $this->assertApiResponse($nation);
    }

    /**
     * @test
     */
    public function test_read_nation()
    {
        $nation = Nation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/nations/'.$nation->id
        );

        $this->assertApiResponse($nation->toArray());
    }

    /**
     * @test
     */
    public function test_update_nation()
    {
        $nation = Nation::factory()->create();
        $editedNation = Nation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/nations/'.$nation->id,
            $editedNation
        );

        $this->assertApiResponse($editedNation);
    }

    /**
     * @test
     */
    public function test_delete_nation()
    {
        $nation = Nation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/nations/'.$nation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/nations/'.$nation->id
        );

        $this->response->assertStatus(404);
    }
}
