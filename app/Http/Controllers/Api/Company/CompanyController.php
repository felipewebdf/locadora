<?php

namespace App\Http\Controllers\Api\Company;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\RulesException;
use App\Domain\Service\CompanyService;
use App\Http\Request\Company\CompanyRequest;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use App\Domain\Company;
use App\Http\StatusCode;

class CompanyController extends Controller
{
    /**
     *
     * @var Container
     */
    protected $container;

    /**
     *
     * @param Container $container
     */
    public function __construct(Container $container)
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
        return Company::all();
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
            $id = Auth::id();
            $arrCompany = $request->all();
            $arrCompany['user_id'] = $id;
            $company = $this->container
                    ->make(CompanyService::class)
                    ->register($arrCompany);
            return response()->json($company->toArray(), StatusCode::HTTP_CREATED);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Company  $company
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
     * @param  \App\Domain\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
