<?php

namespace App\Http\Controllers\Api\Cars;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\RulesException;
use App\Domain\Service\CarService;
use App\Http\Request\Car\CarRequest;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use App\Domain\Cars;

class CarsController extends Controller
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
        $arrParams['user_id'] = Auth::id();
        return Car::all($arrParams);
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
     * @param  CarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        try {
            $id = Auth::id();
            $arrCars = $request->all();
            $arrCars['user_id'] = $id;
            $cars = $this->container
                    ->make(CarService::class)
                    ->register($arrCars);
            return response()->json($cars->toArray(), 201);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function show(Cars $cars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function edit(Cars $cars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cars $cars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cars $cars)
    {
        //
    }
}
