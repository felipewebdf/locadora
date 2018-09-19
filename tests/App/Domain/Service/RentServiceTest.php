<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Service\RentService;
use App\Domain\Rent;
use App\Domain\Service\CompanyService;
use App\Domain\Service\ClientService;
use \App\Domain\Service\CarService;
use App\Domain\Service\ContractService;

/**
 * @group rent
 */
class RentServiceTest extends TestCase
{
    private $db;

    /**
     *
     * @var \App\Domain\Service\CompanyService
     */
    protected $companyService;

     /**
     *
     * @var \App\Domain\Service\ClientService
     */
    protected $clientService;

    /**
     *
     * @var \App\Domain\Service\CarService
     */
    protected $car;

    /**
     *
     * @var RentService
     */
    protected $rentService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->rentService = $this->app->make(RentService::class);
        $this->companyService = $this->app->make(CompanyService::class);
        $this->clientService = $this->app->make(ClientService::class);
        $this->carService = $this->app->make(CarService::class);
        $this->contractService = $this->app->make(ContractService::class);
    }

    public function tearDown()
    {
        $this->db->connection()->rollback();
    }

    protected function company()
    {
        $arrCompany = [
            'name' => 'federal',
            'cnpj' => '54256465465465',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];
        return $this->companyService->register($arrCompany);
    }

    protected function client()
    {
        $arrClient = [
            'name' => 'NOvo cliente',
            'cnh' => '1.8',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];
        return $this->clientService->add($arrClient);
    }

    public function car()
    {
        $this->company();
        $arrCar = [
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'Honda',
            'renavan' => '546546545',
            'chassi' => '546546545',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        return $this->carService->add($arrCar);
    }

    protected function typeRent()
    {
        $type = new \App\Domain\TypeRent();
        $type->name = 'teste';
        $type->save();
        return $type;
    }

    protected function contract($company)
    {
        $arrContract = [
            'name' => 'contrato 1',
            'company_id' => $company->id,
            'template' => 'ajçls djfçlak dsfçlkajs fkjasd [[tag]]',
            'user_id' => 2
        ];
        return $this->contractService->add($arrContract);
    }


    public function testAddReturnEntity()
    {
        $company = $this->company();
        $car = $this->car();
        $client = $this->client();
        $typeRend = $this->typeRent();
        $contract = $this->contract($company);

        $arrRent = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $rent = $this->rentService->add($arrRent);
        $this->assertInstanceOf(Rent::class, $rent);
        $this->assertNotEmpty($rent->id);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testAddExistsRentLaunchException()
    {
        $company = $this->company();
        $car = $this->car();
        $client = $this->client();
        $typeRend = $this->typeRent();
        $contract = $this->contract($company);

        $arrRent = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $this->rentService->add($arrRent);
        $this->rentService->add($arrRent);
    }

    /**
     * @group testUpdateReturnEntityUpdate
     */
    public function testUpdateReturnEntityUpdate()
    {
        $company = $this->company();
        $car = $this->car();
        $client = $this->client();
        $typeRend = $this->typeRent();
        $contract = $this->contract($company);

        $arrRent = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $rent = $this->rentService->add($arrRent);

        $arrRentUpdate = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '90,00',
            'init' => '2018-08-10',
            'end' => '2018-10-20',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $objRent = $this->rentService->update($rent->id, $arrRentUpdate);

        $this->assertEquals($arrRentUpdate['daily'], $objRent->daily);
        $this->assertEquals($arrRentUpdate['end'], $objRent->end);
    }

    /**
     * @group testUpdateReturnEntityUpdate
     * @expectedException \App\Exceptions\RulesException
     */
    public function testUpdateNotExisteRentException()
    {
        $company = $this->company();
        $car = $this->car();
        $client = $this->client();
        $typeRend = $this->typeRent();
        $contract = $this->contract($company);

        $arrRentUpdate = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '90,00',
            'init' => '2018-08-20',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $this->rentService->update(0, $arrRentUpdate);
    }

    /**
     * @group testAddRentNotExistCarException
     * @expectedException \App\Exceptions\RulesException
     */
    public function testAddRentNotExistCarException()
    {
        $company = $this->company();
        $client = $this->client();
        $typeRend = $this->typeRent();
        $contract = $this->contract($company);

        $arrRent = [
            'company_id' => $company->id,
            'car_id' => 345,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $rent = $this->rentService->add($arrRent);
    }

    /**
     * @group testAddRentNotExistClientException
     * @expectedException \App\Exceptions\RulesException
     */
    public function testAddRentNotExistClientException()
    {
        $company = $this->company();
        $car = $this->car();
        $typeRend = $this->typeRent();
        $contract = $this->contract($company);

        $arrRent = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => 345345,
            'driver_id' => 123,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $rent = $this->rentService->add($arrRent);
    }

    /**
     * @group testAddRentNotExistTypeException
     * @expectedException \App\Exceptions\RulesException
     */
    public function testAddRentNotExistTypeException()
    {
        $company = $this->company();
        $car = $this->car();
        $client = $this->client();
        $contract = $this->contract($company);

        $arrRent = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => 12321312,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $rent = $this->rentService->add($arrRent);
    }

    public function testAll()
    {
        $company = $this->company();
        $car = $this->car();
        $client = $this->client();
        $typeRend = $this->typeRent();
        $contract = $this->contract($company);

        $arrRent = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $this->rentService->add($arrRent);

        $arrRents = $this->rentService->all(['user_id' => 2]);
        $this->assertArrayHasKey('daily', $arrRents[0]);
        $this->assertArrayHasKey('init', $arrRents[0]);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testGetRentNotExistsException()
    {
        $this->company();
        $this->rentService->get(4, 2);
    }

    /**
     *
     */
    public function testGetRentEntity()
    {
        $company = $this->company();
        $car = $this->car();
        $client = $this->client();
        $typeRend = $this->typeRent();
        $contract = $this->contract($company);

        $arrRent = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'driver_id' => $client->id,
            'type_rent_id' => $typeRend->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'total_km' => '1000',
            'value_km_extra' => '0,50',
            'value_hr_extra' => '0,20'
        ];
        $rent = $this->rentService->add($arrRent);
        $rentExists = $this->rentService->get($rent->id, 2);

        $this->assertEquals($rent->id, $rentExists->id);
    }

    public function testGasoline()
    {
        $arrGasoline = RentService::gasoline();
        $this->assertEquals('1/8', $arrGasoline['1/8']);
        $this->assertEquals('2/8', $arrGasoline['2/8']);
        $this->assertEquals('4/8', $arrGasoline['4/8']);
        $this->assertEquals('6/8', $arrGasoline['6/8']);
        $this->assertEquals('8/8', $arrGasoline['8/8']);
    }
}
