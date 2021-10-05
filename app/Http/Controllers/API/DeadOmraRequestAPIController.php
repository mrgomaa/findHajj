<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeadOmraRequestAPIRequest;
use App\Http\Requests\API\UpdateDeadOmraRequestAPIRequest;
use App\Models\DeadOmraRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DeadOmraRequestController
 * @package App\Http\Controllers\API
 */

class DeadOmraRequestAPIController extends AppBaseController
{
    /**
     * Display a listing of the DeadOmraRequest.
     * GET|HEAD /deadOmraRequests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = DeadOmraRequest::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $deadOmraRequests = $query->get();

        return $this->sendResponse($deadOmraRequests->toArray(), 'Dead Omra Requests retrieved successfully');
    }

    /**
     * Store a newly created DeadOmraRequest in storage.
     * POST /deadOmraRequests
     *
     * @param CreateDeadOmraRequestAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeadOmraRequestAPIRequest $request)
    {
        $input = $request->all();

        /** @var DeadOmraRequest $deadOmraRequest */
        $deadOmraRequest = DeadOmraRequest::create($input);

        return $this->sendResponse($deadOmraRequest->toArray(), 'Dead Omra Request saved successfully');
    }

    /**
     * Display the specified DeadOmraRequest.
     * GET|HEAD /deadOmraRequests/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DeadOmraRequest $deadOmraRequest */
        $deadOmraRequest = DeadOmraRequest::find($id);

        if (empty($deadOmraRequest)) {
            return $this->sendError('Dead Omra Request not found');
        }

        return $this->sendResponse($deadOmraRequest->toArray(), 'Dead Omra Request retrieved successfully');
    }

    /**
     * Update the specified DeadOmraRequest in storage.
     * PUT/PATCH /deadOmraRequests/{id}
     *
     * @param int $id
     * @param UpdateDeadOmraRequestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeadOmraRequestAPIRequest $request)
    {
        /** @var DeadOmraRequest $deadOmraRequest */
        $deadOmraRequest = DeadOmraRequest::find($id);

        if (empty($deadOmraRequest)) {
            return $this->sendError('Dead Omra Request not found');
        }

        $deadOmraRequest->fill($request->all());
        $deadOmraRequest->save();

        return $this->sendResponse($deadOmraRequest->toArray(), 'DeadOmraRequest updated successfully');
    }

    /**
     * Remove the specified DeadOmraRequest from storage.
     * DELETE /deadOmraRequests/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DeadOmraRequest $deadOmraRequest */
        $deadOmraRequest = DeadOmraRequest::find($id);

        if (empty($deadOmraRequest)) {
            return $this->sendError('Dead Omra Request not found');
        }

        $deadOmraRequest->delete();

        return $this->sendSuccess('Dead Omra Request deleted successfully');
    }
}
