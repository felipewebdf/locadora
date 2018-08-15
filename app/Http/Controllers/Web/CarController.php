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
        return view('web.car.create');
    }

    public function update($tag)
    {
        $arrCar = [
            'tag' => $tag,
            'user_id' => Auth::id()
        ];
        $car = $this->container->make(CarService::class)->getForTag($arrCar);
        return view('web.car.update', ['car' => $car]);
    }

}
