<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Container\Container;
use App\Domain\Service\CarService;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;


class CarController extends Controller
{
    /**
     *
     * @var Container
     */
    protected $container;

    public function __construct(Container $container, \Illuminate\Http\Request $request)
    {
        $this->container = $container;
        $token = explode(' ', $request->cookie('Authorization'));
        $auth = $this->container->make(JWTAuth::class);
        if (count($token) < 1) {
            return redirect('/');
        }
        $auth->setToken($token[1]);
        $auth->authenticate();
    }

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
