<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\RentService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;
use \App\Domain\Service\ClientService;
use \App\Domain\Service\CarService;
use App\Domain\TypeRent;

class InspectionController extends Controller
{
    use ContainerTrait;

    public function index()
    {

    }

    public function create(\Illuminate\Http\Request $request)
    {
        $rent_id = $request->get('rent_id');
        return view('web.inspection.create', [
            'title' => 'Cadastrar vistoria',
            'rent_id' => $rent_id
        ]);
    }


}
