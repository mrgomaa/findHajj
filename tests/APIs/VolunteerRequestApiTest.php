<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\VolunteerRequest;

class VolunteerRequestApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_volunteer_request()
    {
        $volunteerRequest = VolunteerRequest::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/volunteer_requests', $volunteerRequest
        );

        $this->assertApiResponse($volunteerRequest);
    }

    /**
     * @test
     */
    public function test_read_volunteer_request()
    {
        $volunteerRequest = VolunteerRequest::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/volunteer_requests/'.$volunteerRequest->id
        );

        $this->assertApiResponse($volunteerRequest->toArray());
    }

    /**
     * @test
     */
    public function test_update_volunteer_request()
    {
        $volunteerRequest = VolunteerRequest::factory()->create();
        $editedVolunteerRequest = VolunteerRequest::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/volunteer_requests/'.$volunteerRequest->id,
            $editedVolunteerRequest
        );

        $this->assertApiResponse($editedVolunteerRequest);
    }

    /**
     * @test
     */
    public function test_delete_volunteer_request()
    {
        $volunteerRequest = VolunteerRequest::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/volunteer_requests/'.$volunteerRequest->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/volunteer_requests/'.$volunteerRequest->id
        );

        $this->response->assertStatus(404);
    }
}
