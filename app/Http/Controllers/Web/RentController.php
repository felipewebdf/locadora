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
use App\Domain\Car;

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
        $htmlContract = str_replace('{{client_name}}', $rent->client->name, $rent->contract->template);
        $htmlContract = str_replace('{{client_document}}', $rent->client->document, $htmlContract);
        $htmlContract = str_replace('{{car_model_brand_name}}', $rent->car->model->brand->name, $htmlContract);
        $htmlContract = str_replace('{{car_model_name}}', $rent->car->model->name, $htmlContract);
        $htmlContract = str_replace('{{car_power}}', $rent->car->power, $htmlContract);
        $htmlContract = str_replace('{{car_door}}', $rent->car->door, $htmlContract);
        $htmlContract = str_replace('{{car_capacity}}', $rent->car->capacity, $htmlContract);
        $htmlContract = str_replace('{{car_year}}', $rent->car->year, $htmlContract);
        $htmlContract = str_replace('{{car_type_fuel}}', Car::$arrFuel[$rent->car->type_fuel], $htmlContract);
        $htmlContract = str_replace('{{car_tag}}', $rent->car->tag, $htmlContract);

        $pdf = new \niklasravnsborg\LaravelPdf\Pdf($htmlContract);
        return $pdf->download('contrato.pdf');
    }

}
