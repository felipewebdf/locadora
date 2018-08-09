<?php

namespace App\Http\Controllers\Api\Company;

use App\Company;
use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use \App\Domain\Service\CompanyService;
use App\Http\Request\Company\CompanyRequest;

class CompanyController extends Controller
{
    public function __construct(\Illuminate\Container\Container $container)
    {
        $this->container = $container;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Domain\Company::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        try {
            $id = \Illuminate\Support\Facades\Auth::id();
            $arrCompany = $request->all();
            $arrCompany['user_id'] = $id;
            $company = $this->container
                    ->make(CompanyService::class)
                    ->register($arrCompany);
            return response()->json($company->toArray(), 201);
        } catch (\Exception $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
