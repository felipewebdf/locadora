<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Inspection;
use App\Domain\Service\CompanyService;
use App\Domain\Service\ClientService;
use \App\Domain\Service\CarService;
use \App\Domain\Service\RentService;
use \App\Domain\Service\InspectionService;

/**
 * @group inspection
 */
class InspectionServiceTest extends TestCase
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
     * @var InspectionService
     */
    protected $inspectionService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->inspectionService = $this->app->make(InspectionService::class);
        $this->companyService = $this->app->make(CompanyService::class);
        $this->clientService = $this->app->make(ClientService::class);
        $this->carService = $this->app->make(CarService::class);
        $this->rentService = $this->app->make(RentService::class);
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

        $rentService = [
            'company_id' => $company->id,
            'car_id' => $car->id,
            'client_id' => $client->id,
            'type_rent_id' => $typeRent->id,
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
        $type->name = 'teste';
        $type->save();
        return $type;
    }

    public function testRegisterReturnEntity()
    {
        $rent = $this->rent();
        $arrInspection = [
            'rent_id' => $rent->id,
            'user_id' => 2,
            'init_km' => '23444',
            'gasoline' => '2/3',
            'bodywork' => 'apenas com arranhdo no parachoque frontal direito',
            'washed_out' => 'limpo',
            'note' => 'Carro com problema no retrovisor esquerdo'
        ];

        $inspection = $this->inspectionService->register($arrInspection);
        $this->assertInstanceOf(Inspection::class, $inspection);
        $this->assertNotEmpty($inspection->id);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     * @expectedExceptionMessage Vistoria já existente para esta locação
     */
    public function testRegisterInspectionExistsException()
    {
        $rent = $this->rent();
        $arrInspection = [
            'rent_id' => $rent->id,
            'user_id' => 2,
            'init_km' => '23444',
            'gasoline' => '2/3',
            'bodywork' => 'apenas com arranhdo no parachoque frontal direito',
            'washed_out' => 'limpo',
            'note' => 'Carro com problema no retrovisor esquerdo'
        ];

        $this->inspectionService->register($arrInspection);
        $this->inspectionService->register($arrInspection);
    }

    public function testUpdateReturnEntity()
    {
        $rent = $this->rent();
        $arrInspection = [
            'rent_id' => $rent->id,
            'user_id' => 2,
            'init_km' => '23444',
            'gasoline' => '2/3',
            'bodywork' => 'apenas com arranhdo no parachoque frontal direito',
            'washed_out' => 'limpo',
            'note' => 'Carro com problema no retrovisor esquerdo'
        ];

        $inspection = $this->inspectionService->register($arrInspection);
        $arrInspectionUpdate = $arrInspection;
        $arrInspectionUpdate['init_km'] = '654654';
        $arrInspectionUpdate['gasoline'] = '654654';
        $arrInspectionUpdate['bodywork'] = '654654';
        $arrInspectionUpdate['washed_out'] = '654654';
        $arrInspectionUpdate['note'] = '654654';
        $inspectionUpdate = $this->inspectionService->update($inspection->id, $arrInspectionUpdate);
        $this->assertInstanceOf(Inspection::class, $inspectionUpdate);
        $this->assertEquals($arrInspectionUpdate['init_km'], $inspectionUpdate->init_km);
        $this->assertEquals($arrInspectionUpdate['gasoline'], $inspectionUpdate->gasoline);
        $this->assertEquals($arrInspectionUpdate['bodywork'], $inspectionUpdate->bodywork);
        $this->assertEquals($arrInspectionUpdate['washed_out'], $inspectionUpdate->washed_out);
        $this->assertEquals($arrInspectionUpdate['note'], $inspectionUpdate->note);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     * @expectedExceptionMessage Vistoria não encontrada
     */
    public function testUpdateNotExistsException()
    {
        $rent = $this->rent();
        $arrInspection = [
            'rent_id' => $rent->id,
            'user_id' => 2,
            'init_km' => '23444',
            'gasoline' => '2/3',
            'bodywork' => 'apenas com arranhdo no parachoque frontal direito',
            'washed_out' => 'limpo',
            'note' => 'Carro com problema no retrovisor esquerdo'
        ];
        $this->inspectionService->update(123123213, $arrInspection);
    }


}
