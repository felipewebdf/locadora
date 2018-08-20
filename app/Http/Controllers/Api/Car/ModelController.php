<?php

namespace App\Http\Controllers\Api\Car;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Request\Model\ModelRequest;
use Illuminate\Container\Container;
use App\Domain\ModelCar;

class ModelController extends Controller
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
     * @param Request
     * @return Json
     */
    public function index(Request $request)
    {
        return response()->json(ModelCar::where('brand_id', '=', $request->get('brand_id'))->get());
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
     * @param  ModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModelRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function show(Model $model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($tag, Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Model  $model
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $model)
    {
        //
    }
}
