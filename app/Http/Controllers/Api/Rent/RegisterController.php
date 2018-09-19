<?php

namespace App\Http\Controllers\Api\Rent;

use \App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use \App\Traits\ContainerTrait;
use \Illuminate\Support\Facades\Auth;
use \App\Http\StatusCode;
use \App\Domain\Service\RentService;
use App\Http\Request\Rent\RentRequest;
use \App\Exceptions\RulesException;

class RegisterController extends Controller
{

    use ContainerTrait;

    public function index(Request $request)
    {

    }

    /**
     *
     * @param App\Http\Request\Rent\RentRequest $request
     * @return json
     */
    public function store(RentRequest $request)
    {
        try {
            $id = Auth::id();
            $arrRent = $request->all();
            $arrRent['user_id'] = $id;
            $rent = $this->container
                    ->make(RentService::class)
                    ->add($arrRent);
            return response()->json($rent->toArray(), StatusCode::HTTP_CREATED);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * @param integer $id
     * @param App\Http\Request\Rent\RentRequest $request
     * @return json
     */
    public function update($id, RentRequest $request)
    {
        try {
            $userId = Auth::id();
            $arrRents = $request->all();
            $arrRents['user_id'] = $userId;
            $rent = $this->container
                    ->make(RentService::class)
                    ->update($id, $arrRents);
            return response()->json($rent->toArray(), StatusCode::HTTP_OK);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

}
