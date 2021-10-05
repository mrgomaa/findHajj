<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\VolunteerService;

class VolunteerServiceApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_volunteer_service()
    {
        $volunteerService = VolunteerService::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/volunteer_services', $volunteerService
        );

        $this->assertApiResponse($volunteerService);
    }

    /**
     * @test
     */
    public function test_read_volunteer_service()
    {
        $volunteerService = VolunteerService::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/volunteer_services/'.$volunteerService->id
        );

        $this->assertApiResponse($volunteerService->toArray());
    }

    /**
     * @test
     */
    public function test_update_volunteer_service()
    {
        $volunteerService = VolunteerService::factory()->create();
        $editedVolunteerService = VolunteerService::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/volunteer_services/'.$volunteerService->id,
            $editedVolunteerService
        );

        $this->assertApiResponse($editedVolunteerService);
    }

    /**
     * @test
     */
    public function test_delete_volunteer_service()
    {
        $volunteerService = VolunteerService::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/volunteer_services/'.$volunteerService->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/volunteer_services/'.$volunteerService->id
        );

        $this->response->assertStatus(404);
    }
}
