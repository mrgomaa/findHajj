<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVolunteerServiceAPIRequest;
use App\Http\Requests\API\UpdateVolunteerServiceAPIRequest;
use App\Models\VolunteerService;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class VolunteerServiceController
 * @package App\Http\Controllers\API
 */

class VolunteerServiceAPIController extends AppBaseController
{
    /**
     * Display a listing of the VolunteerService.
     * GET|HEAD /volunteerServices
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = VolunteerService::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $volunteerServices = $query->get();

        return $this->sendResponse($volunteerServices->toArray(), 'Volunteer Services retrieved successfully');
    }

    /**
     * Store a newly created VolunteerService in storage.
     * POST /volunteerServices
     *
     * @param CreateVolunteerServiceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateVolunteerServiceAPIRequest $request)
    {
        $input = $request->all();

        /** @var VolunteerService $volunteerService */
        $volunteerService = VolunteerService::create($input);

        return $this->sendResponse($volunteerService->toArray(), 'Volunteer Service saved successfully');
    }

    /**
     * Display the specified VolunteerService.
     * GET|HEAD /volunteerServices/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var VolunteerService $volunteerService */
        $volunteerService = VolunteerService::find($id);

        if (empty($volunteerService)) {
            return $this->sendError('Volunteer Service not found');
        }

        return $this->sendResponse($volunteerService->toArray(), 'Volunteer Service retrieved successfully');
    }

    /**
     * Update the specified VolunteerService in storage.
     * PUT/PATCH /volunteerServices/{id}
     *
     * @param int $id
     * @param UpdateVolunteerServiceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVolunteerServiceAPIRequest $request)
    {
        /** @var VolunteerService $volunteerService */
        $volunteerService = VolunteerService::find($id);

        if (empty($volunteerService)) {
            return $this->sendError('Volunteer Service not found');
        }

        $volunteerService->fill($request->all());
        $volunteerService->save();

        return $this->sendResponse($volunteerService->toArray(), 'VolunteerService updated successfully');
    }

    /**
     * Remove the specified VolunteerService from storage.
     * DELETE /volunteerServices/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var VolunteerService $volunteerService */
        $volunteerService = VolunteerService::find($id);

        if (empty($volunteerService)) {
            return $this->sendError('Volunteer Service not found');
        }

        $volunteerService->delete();

        return $this->sendSuccess('Volunteer Service deleted successfully');
    }
}
