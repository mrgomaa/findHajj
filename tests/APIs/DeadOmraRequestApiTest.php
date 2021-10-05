<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\DeadOmraRequest;

class DeadOmraRequestApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_dead_omra_request()
    {
        $deadOmraRequest = DeadOmraRequest::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/dead_omra_requests', $deadOmraRequest
        );

        $this->assertApiResponse($deadOmraRequest);
    }

    /**
     * @test
     */
    public function test_read_dead_omra_request()
    {
        $deadOmraRequest = DeadOmraRequest::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/dead_omra_requests/'.$deadOmraRequest->id
        );

        $this->assertApiResponse($deadOmraRequest->toArray());
    }

    /**
     * @test
     */
    public function test_update_dead_omra_request()
    {
        $deadOmraRequest = DeadOmraRequest::factory()->create();
        $editedDeadOmraRequest = DeadOmraRequest::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/dead_omra_requests/'.$deadOmraRequest->id,
            $editedDeadOmraRequest
        );

        $this->assertApiResponse($editedDeadOmraRequest);
    }

    /**
     * @test
     */
    public function test_delete_dead_omra_request()
    {
        $deadOmraRequest = DeadOmraRequest::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/dead_omra_requests/'.$deadOmraRequest->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/dead_omra_requests/'.$deadOmraRequest->id
        );

        $this->response->assertStatus(404);
    }
}
