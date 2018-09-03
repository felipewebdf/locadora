<?php
namespace App\Http\Controllers\Api\Rent;

use \App\Http\Controllers\Controller;
use \App\Traits\ContainerTrait;
use \Illuminate\Support\Facades\Auth;
use \App\Http\StatusCode;
use App\Domain\Service\InspectionService;
use \App\Exceptions\RulesException;
use App\Http\Request\Rent\InspectionRequest;

class InspectionController extends Controller
{
    use ContainerTrait;

    public function store(InspectionRequest $request)
    {
        try {
            $id = Auth::id();
            $arrInspection = $request->all();
            $arrInspection['user_id'] = $id;
            $inspection = $this->container
                    ->make(InspectionService::class)
                    ->register($arrInspection);
            return response()->json($inspection->toArray(), StatusCode::HTTP_CREATED);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * @param integer $id
     * @param App\Http\Request\Rent\InspectionRequest $request
     * @return json
     */
    public function update(InspectionRequest $request)
    {
        try {
            $id = $request->route('id');
            $arrInspection = $request->all();
            $arrInspection['user_id'] = Auth::id();
            $inspection = $this->container
                    ->make(InspectionService::class)
                    ->update($id, $arrInspection);
            return response()->json($inspection->toArray(), StatusCode::HTTP_OK);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }
}