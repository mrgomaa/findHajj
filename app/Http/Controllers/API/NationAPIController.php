<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNationAPIRequest;
use App\Http\Requests\API\UpdateNationAPIRequest;
use App\Models\Nation;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NationController
 * @package App\Http\Controllers\API
 */

class NationAPIController extends AppBaseController
{
    /**
     * Display a listing of the Nation.
     * GET|HEAD /nations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Nation::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $nations = $query->get();

        return $this->sendResponse($nations->toArray(), 'Nations retrieved successfully');
    }

    /**
     * Store a newly created Nation in storage.
     * POST /nations
     *
     * @param CreateNationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateNationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Nation $nation */
        $nation = Nation::create($input);

        return $this->sendResponse($nation->toArray(), 'Nation saved successfully');
    }

    /**
     * Display the specified Nation.
     * GET|HEAD /nations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Nation $nation */
        $nation = Nation::find($id);

        if (empty($nation)) {
            return $this->sendError('Nation not found');
        }

        return $this->sendResponse($nation->toArray(), 'Nation retrieved successfully');
    }

    /**
     * Update the specified Nation in storage.
     * PUT/PATCH /nations/{id}
     *
     * @param int $id
     * @param UpdateNationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNationAPIRequest $request)
    {
        /** @var Nation $nation */
        $nation = Nation::find($id);

        if (empty($nation)) {
            return $this->sendError('Nation not found');
        }

        $nation->fill($request->all());
        $nation->save();

        return $this->sendResponse($nation->toArray(), 'Nation updated successfully');
    }

    /**
     * Remove the specified Nation from storage.
     * DELETE /nations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Nation $nation */
        $nation = Nation::find($id);

        if (empty($nation)) {
            return $this->sendError('Nation not found');
        }

        $nation->delete();

        return $this->sendSuccess('Nation deleted successfully');
    }
}
