<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecityAPIRequest;
use App\Http\Requests\API\UpdatecityAPIRequest;
use App\Models\city;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cityController
 * @package App\Http\Controllers\API
 */

class cityAPIController extends AppBaseController
{
    /**
     * Display a listing of the city.
     * GET|HEAD /cities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = city::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $cities = $query->get();

        return $this->sendResponse($cities->toArray(), 'Cities retrieved successfully');
    }

    /**
     * Store a newly created city in storage.
     * POST /cities
     *
     * @param CreatecityAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecityAPIRequest $request)
    {
        $input = $request->all();

        /** @var city $city */
        $city = city::create($input);

        return $this->sendResponse($city->toArray(), 'City saved successfully');
    }

    /**
     * Display the specified city.
     * GET|HEAD /cities/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var city $city */
        $city = city::find($id);

        if (empty($city)) {
            return $this->sendError('City not found');
        }

        return $this->sendResponse($city->toArray(), 'City retrieved successfully');
    }

    /**
     * Update the specified city in storage.
     * PUT/PATCH /cities/{id}
     *
     * @param int $id
     * @param UpdatecityAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecityAPIRequest $request)
    {
        /** @var city $city */
        $city = city::find($id);

        if (empty($city)) {
            return $this->sendError('City not found');
        }

        $city->fill($request->all());
        $city->save();

        return $this->sendResponse($city->toArray(), 'city updated successfully');
    }

    /**
     * Remove the specified city from storage.
     * DELETE /cities/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var city $city */
        $city = city::find($id);

        if (empty($city)) {
            return $this->sendError('City not found');
        }

        $city->delete();

        return $this->sendSuccess('City deleted successfully');
    }
}
