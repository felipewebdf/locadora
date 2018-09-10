<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\RentService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;
use \App\Domain\Service\ClientService;
use \App\Domain\Service\CarService;
use App\Domain\TypeRent;
use \App\Domain\Service\InspectionService;
use App\Domain\Service\ContractService;
use App\Domain\Service\DevolutionService;

class RentController extends Controller
{
    use ContainerTrait;

    public function index()
    {
        $user_id = Auth::id();
        $rents = $this->container
                ->make(RentService::class)
                ->all(['user_id' => $user_id]);
        return view('web.rent.list', ['rents' => $rents, 'title' => 'Lista de locações']);
    }

    public function create()
    {
        $arrParams = ['user_id' => Auth::id()];
        $clients = $this->container->make(ClientService::class)->all($arrParams);
        $cars = $this->container->make(CarService::class)->all($arrParams);
        $contracts = $this->container->make(ContractService::class)->all($arrParams);
        return view('web.rent.create', [
            'title' => 'Cadastrar locação',
            'clients' => $clients,
            'cars' => $cars,
            'types_rents' => TypeRent::all(),
            'contracts' => $contracts
        ]);
    }

    public function update($id)
    {
        $rent = $this->container->make(RentService::class)->get($id, Auth::id());
        $inspection = $this->container->make(InspectionService::class)->getForRent($id);
        $contracts = $this->container->make(ContractService::class)->all(['user_id' => Auth::id()]);
        $devolution = $this->container->make(DevolutionService::class)->getForRent($id);
        $clients = $this->container->make(ClientService::class)->all(['user_id' => Auth::id()]);

        return view('web.rent.update', [
            'rent' => $rent,
            'title' => 'Alterar locação',
            'types_rents' => TypeRent::all(),
            'inspection' => $inspection,
            'contracts' => $contracts,
            'devolution' => $devolution,
            'clients' => $clients
        ]);
    }

    public function pdf($id)
    {
        $rent = $this->container->make(RentService::class)->get($id, Auth::id());
    }

}
