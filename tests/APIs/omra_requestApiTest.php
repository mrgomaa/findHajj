<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\omra_request;

class omra_requestApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_omra_request()
    {
        $omraRequest = omra_request::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/omra_requests', $omraRequest
        );

        $this->assertApiResponse($omraRequest);
    }

    /**
     * @test
     */
    public function test_read_omra_request()
    {
        $omraRequest = omra_request::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/omra_requests/'.$omraRequest->id
        );

        $this->assertApiResponse($omraRequest->toArray());
    }

    /**
     * @test
     */
    public function test_update_omra_request()
    {
        $omraRequest = omra_request::factory()->create();
        $editedomra_request = omra_request::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/omra_requests/'.$omraRequest->id,
            $editedomra_request
        );

        $this->assertApiResponse($editedomra_request);
    }

    /**
     * @test
     */
    public function test_delete_omra_request()
    {
        $omraRequest = omra_request::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/omra_requests/'.$omraRequest->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/omra_requests/'.$omraRequest->id
        );

        $this->response->assertStatus(404);
    }
}
