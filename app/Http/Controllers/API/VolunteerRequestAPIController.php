<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVolunteerRequestAPIRequest;
use App\Http\Requests\API\UpdateVolunteerRequestAPIRequest;
use App\Models\VolunteerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class VolunteerRequestController
 * @package App\Http\Controllers\API
 */

class VolunteerRequestAPIController extends AppBaseController
{
    /**
     * Display a listing of the VolunteerRequest.
     * GET|HEAD /volunteerRequests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = VolunteerRequest::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $volunteerRequests = $query->get();

        return $this->sendResponse($volunteerRequests->toArray(), 'Volunteer Requests retrieved successfully');
    }

    /**
     * Store a newly created VolunteerRequest in storage.
     * POST /volunteerRequests
     *
     * @param CreateVolunteerRequestAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateVolunteerRequestAPIRequest $request)
    {
        $input = $request->all();

        /** @var VolunteerRequest $volunteerRequest */
        $volunteerRequest = VolunteerRequest::create($input);

        return $this->sendResponse($volunteerRequest->toArray(), 'Volunteer Request saved successfully');
    }

    /**
     * Display the specified VolunteerRequest.
     * GET|HEAD /volunteerRequests/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var VolunteerRequest $volunteerRequest */
        $volunteerRequest = VolunteerRequest::find($id);

        if (empty($volunteerRequest)) {
            return $this->sendError('Volunteer Request not found');
        }

        return $this->sendResponse($volunteerRequest->toArray(), 'Volunteer Request retrieved successfully');
    }

    /**
     * Update the specified VolunteerRequest in storage.
     * PUT/PATCH /volunteerRequests/{id}
     *
     * @param int $id
     * @param UpdateVolunteerRequestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVolunteerRequestAPIRequest $request)
    {
        /** @var VolunteerRequest $volunteerRequest */
        $volunteerRequest = VolunteerRequest::find($id);

        if (empty($volunteerRequest)) {
            return $this->sendError('Volunteer Request not found');
        }

        $volunteerRequest->fill($request->all());
        $volunteerRequest->save();

        return $this->sendResponse($volunteerRequest->toArray(), 'VolunteerRequest updated successfully');
    }

    /**
     * Remove the specified VolunteerRequest from storage.
     * DELETE /volunteerRequests/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var VolunteerRequest $volunteerRequest */
        $volunteerRequest = VolunteerRequest::find($id);

        if (empty($volunteerRequest)) {
            return $this->sendError('Volunteer Request not found');
        }

        $volunteerRequest->delete();

        return $this->sendSuccess('Volunteer Request deleted successfully');
    }
}
