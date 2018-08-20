<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\CarService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;


class CarController extends Controller
{
    use ContainerTrait;

    public function index()
    {
        $user_id = Auth::id();
        $cars = $this->container->make(CarService::class)->all(['user_id' => $user_id]);
        return view('web.car.list', ['cars' => $cars]);
    }

    public function create()
    {
        $brands = \App\Domain\Brand::all();
        return view('web.car.create', ['brands' => $brands]);
    }

    public function update($tag)
    {
        $arrCar = [
            'tag' => $tag,
            'user_id' => Auth::id()
        ];
        $car = $this->container->make(CarService::class)->getForTag($arrCar);
        $brands = \App\Domain\Brand::all();
        $models = \App\Domain\ModelCar::where('brand_id', '=', $car->model->brand->id)->get();
        return view('web.car.update', ['car' => $car, 'brands' => $brands, 'models' => $models]);
    }

}
