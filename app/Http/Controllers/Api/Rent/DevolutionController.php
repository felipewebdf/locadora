<?php

namespace App\Http\Controllers\Api\Rent;

use \App\Http\Controllers\Controller;
use \App\Traits\ContainerTrait;
use \Illuminate\Support\Facades\Auth;
use \App\Http\StatusCode;
use App\Domain\Service\DevolutionService;
use \App\Exceptions\RulesException;
use App\Http\Request\Rent\DevolutionRequest;

class DevolutionController extends Controller
{

    use ContainerTrait;

    public function store(DevolutionRequest $request)
    {
        try {
            $id = Auth::id();
            $arrDevolution = $request->all();
            $arrDevolution['user_id'] = $id;
            $devolution = $this->container
                    ->make(DevolutionService::class)
                    ->register($arrDevolution);
            return response()->json($devolution->toArray(), StatusCode::HTTP_CREATED);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * @param integer $id
     * @param App\Http\Request\Rent\DevolutionRequest $request
     * @return json
     */
    public function update(DevolutionRequest $request)
    {
        try {
            $id = $request->route('id');
            $arrDevolution = $request->all();
            $arrDevolution['user_id'] = Auth::id();
            $devolution = $this->container
                    ->make(DevolutionService::class)
                    ->update($id, $arrDevolution);
            return response()->json($devolution->toArray(), StatusCode::HTTP_OK);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

}
