<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Devolution;
use App\Domain\Service\CompanyService;
use App\Domain\Service\ClientService;
use \App\Domain\Service\CarService;
use \App\Domain\Service\RentService;
use \App\Domain\Service\DevolutionService;
use App\Domain\Service\ContractService;

/**
 * @group devolution
 */
class DevolutionServiceTest extends TestCase
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
     * @var \App\Domain\Service\RentService
     */
    protected $rent;

    /**
     *
     * @var DevolutionService
     */
    protected $devolutionService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->devolutionService = $this->app->make(DevolutionService::class);
        $this->companyService = $this->app->make(CompanyService::class);
        $this->clientService = $this->app->make(ClientService::class);
        $this->carService = $this->app->make(CarService::class);
        $this->rentService = $this->app->make(RentService::class);
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
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        return $this->carService->add($arrCar);
    }

    protected function rent()
    {
        $company = $this->company();
        $car = $this->car();
        $client = $this->client();
        $typeRent = $this->typeRent();

        $arrContract = [
            'name' => 'contrato 1',
            'company_id' => $company->id,
            'template' => 'ajçls djfçlak dsfçlkajs fkjasd [[tag]]',
            'user_id' => 2
        ];
        $contract = $this->contractService->add($arrContract);

        $rentService = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'type_rent_id' => $typeRent->id,
            'contract_id' => $contract->id,
            'user_id' => 2,
            'daily' => '80,00',
            'init' => '2018-08-10',
            'end' => '2018-10-10',
            'comment' => 'teste',
            'value_km_extra' => '0,50',
            'total_km' => '1000'
        ];
        return $this->rentService->add($rentService);
    }

    protected function typeRent()
    {
        $type = new \App\Domain\TypeRent();
        $type->id = 20;
        $type->name = 'teste';
        $type->save();
        return $type;
    }

    public function testRegisterReturnEntity()
    {
        $rent = $this->rent();
        $arrDevolution = [
            'rent_id' => $rent->id,
            'user_id' => 2,
            'end_km' => '23444',
            'gasoline' => '2/3',
            'bodywork' => 'apenas com arranhdo no parachoque frontal direito',
            'washed_out' => 'limpo',
            'note' => 'Carro com problema no retrovisor esquerdo'
        ];

        $devolution = $this->devolutionService->register($arrDevolution);
        $this->assertInstanceOf(Devolution::class, $devolution);
        $this->assertNotEmpty($devolution->id);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     * @expectedExceptionMessage Devolução já existente para esta locação
     */
    public function testRegisterDevolutionExistsException()
    {
        $rent = $this->rent();
        $arrDevolution = [
            'rent_id' => $rent->id,
            'user_id' => 2,
            'end_km' => '23444',
            'gasoline' => '2/3',
            'bodywork' => 'apenas com arranhdo no parachoque frontal direito',
            'washed_out' => 'limpo',
            'note' => 'Carro com problema no retrovisor esquerdo'
        ];

        $this->devolutionService->register($arrDevolution);
        $this->devolutionService->register($arrDevolution);
    }

    public function testUpdateReturnEntity()
    {
        $rent = $this->rent();
        $arrDevolution = [
            'rent_id' => $rent->id,
            'user_id' => 2,
            'end_km' => '23444',
            'gasoline' => '2/3',
            'bodywork' => 'apenas com arranhdo no parachoque frontal direito',
            'washed_out' => 'limpo',
            'note' => 'Carro com problema no retrovisor esquerdo'
        ];

        $devolution = $this->devolutionService->register($arrDevolution);
        $arrDevolutionUpdate = $arrDevolution;
        $arrDevolutionUpdate['end_km'] = '654654';
        $arrDevolutionUpdate['gasoline'] = '654654';
        $arrDevolutionUpdate['bodywork'] = '654654';
        $arrDevolutionUpdate['washed_out'] = '654654';
        $arrDevolutionUpdate['note'] = '654654';
        $devolutionUpdate = $this->devolutionService->update($devolution->id, $arrDevolutionUpdate);
        $this->assertInstanceOf(Devolution::class, $devolutionUpdate);
        $this->assertEquals($arrDevolutionUpdate['end_km'], $devolutionUpdate->end_km);
        $this->assertEquals($arrDevolutionUpdate['gasoline'], $devolutionUpdate->gasoline);
        $this->assertEquals($arrDevolutionUpdate['bodywork'], $devolutionUpdate->bodywork);
        $this->assertEquals($arrDevolutionUpdate['washed_out'], $devolutionUpdate->washed_out);
        $this->assertEquals($arrDevolutionUpdate['note'], $devolutionUpdate->note);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     * @expectedExceptionMessage Devolução não encontrada
     */
    public function testUpdateNotExistsException()
    {
        $rent = $this->rent();
        $arrDevolution = [
            'rent_id' => $rent->id,
            'user_id' => 2,
            'end_km' => '23444',
            'gasoline' => '2/3',
            'bodywork' => 'apenas com arranhdo no parachoque frontal direito',
            'washed_out' => 'limpo',
            'note' => 'Carro com problema no retrovisor esquerdo'
        ];
        $this->devolutionService->update(123123213, $arrDevolution);
    }


}
