<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Request\Company\ContractRequest;
use App\Http\Controllers\Controller;
use App\Exceptions\RulesException;
use \App\Traits\ContainerTrait;
use App\Http\StatusCode;
use \App\Domain\Contract;
use App\Domain\Service\ContractService;
use \Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    use ContainerTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contract::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
        try {
            $arrContract = $request->all();
            $arrContract['user_id'] = Auth::id();
            $contract = $this->container
                    ->make(ContractService::class)
                    ->add($arrContract);
            return response()->json($contract->toArray(), StatusCode::HTTP_CREATED);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, ContractRequest $request)
    {
        try {
            $arrContract = $request->all();
            $arrContract['user_id'] = Auth::id();
            $contract = $this->container
                    ->make(ContractService::class)
                    ->update($id, $arrContract);
            return response()->json($contract->toArray(), StatusCode::HTTP_OK);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }
}
