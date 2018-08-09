<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Container\Container;
use App\Domain\Service\CompanyService;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;


class CompanyController extends Controller
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
        $auth->setToken($token[1]);
        $auth->authenticate();
    }
    public function index()
    {
        $user_id = Auth::id();
        $company = $this->container->make(CompanyService::class)->forUser($user_id);
        return view('web.company', ['company' => $company]);
    }
}
