<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\CompanyService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;

class CompanyController extends Controller
{
    use ContainerTrait;

    public function index()
    {
        $user_id = Auth::id();
        $company = $this->container->make(CompanyService::class)->forUser($user_id);
        return view('web.company', ['company' => $company]);
    }
}
