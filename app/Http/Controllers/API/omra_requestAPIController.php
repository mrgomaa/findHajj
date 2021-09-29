<?php

namespace App\Http\Controllers\API;

use Response;
use Carbon\Carbon;
use App\Models\omra_request;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\Createomra_requestAPIRequest;
use App\Http\Requests\API\Updateomra_requestAPIRequest;

/**
 * Class omra_requestController
 * @package App\Http\Controllers\API
 */

class omra_requestAPIController extends AppBaseController
{
    /**
     * Display a listing of the omra_request.
     * GET|HEAD /omraRequests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = omra_request::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $omraRequests = $query->get();

        return $this->sendResponse($omraRequests->toArray(), 'Omra Requests retrieved successfully');
    }

    /**
     * Store a newly created omra_request in storage.
     * POST /omraRequests
     *
     * @param Createomra_requestAPIRequest $request
     *
     * @return Response
     */
    public function store(Createomra_requestAPIRequest $request)
    {
        $request->merge([
                        'user_id' => auth()->user()->id , 
                        'request_date' => Carbon::now()
                        ]);

        $input = $request->all();

        /** @var omra_request $omraRequest */
        $omraRequest = omra_request::create($input);


        return $this->sendResponse($omraRequest->toArray(), 'Omra Request saved successfully');
    }

    /**
     * Display the specified omra_request.
     * GET|HEAD /omraRequests/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var omra_request $omraRequest */
        $omraRequest = omra_request::find($id);

        if (empty($omraRequest)) {
            return $this->sendError('Omra Request not found');
        }

        return $this->sendResponse($omraRequest->toArray(), 'Omra Request retrieved successfully');
    }

    /**
     * Update the specified omra_request in storage.
     * PUT/PATCH /omraRequests/{id}
     *
     * @param int $id
     * @param Updateomra_requestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateomra_requestAPIRequest $request)
    {
        /** @var omra_request $omraRequest */
        $omraRequest = omra_request::find($id);

        if (empty($omraRequest)) {
            return $this->sendError('Omra Request not found');
        }

        $omraRequest->fill($request->all());
        $omraRequest->save();

        return $this->sendResponse($omraRequest->toArray(), 'omra_request updated successfully');
    }

    /**
     * Remove the specified omra_request from storage.
     * DELETE /omraRequests/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var omra_request $omraRequest */
        $omraRequest = omra_request::find($id);

        if (empty($omraRequest)) {
            return $this->sendError('Omra Request not found');
        }

        $omraRequest->delete();

        return $this->sendSuccess('Omra Request deleted successfully');
    }
}
