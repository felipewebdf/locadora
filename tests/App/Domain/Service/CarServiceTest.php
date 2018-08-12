<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Service\CarService;
use App\Domain\Car;
use App\Domain\Service\CompanyService;

/**
 * @group car
 */
class CarServiceTest extends TestCase
{
    private $db;

    /**
     *
     * @var App\Domain\Service\CompanyService
     */
    protected $companyService;

    /**
     *
     * @var CarService
     */
    protected $carService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->carService = $this->app->make(CarService::class);
        $this->companyService = $this->app->make(CompanyService::class);
    }

    public function tearDown()
    {
        $this->db->connection()->rollback();
    }

    protected function company()
    {
        $arrCar = [
            'name' => 'federal',
            'cnpj' => '54256465465465',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];
        return $this->companyService->register($arrCar);
    }

    public function testAddReturnEntity()
    {
        $this->company();

        $arrCar = [
            'automaker' => 'Honda Civic',
            'model' => 'Civic',
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
        $objCar = $this->carService->add($arrCar);
        $this->assertInstanceOf(Car::class, $objCar);
        $this->assertNotEmpty($objCar->id);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testAddExistsCarLaunchException()
    {
        $this->company();
        $arrCar = [
            'automaker' => 'Honda Civic',
            'model' => 'Civic',
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'PAT-5006',
            'renavan' => '546546545',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $this->carService->add($arrCar);
        $this->carService->add($arrCar);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testUpdateVerifyExists()
    {
        $this->company();
        $arrCar = [
            'automaker' => 'Honda Civic',
            'model' => 'Civic',
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
        $objCar = $this->carService->update($arrCar);
    }

    public function testUpdateReturnEntityUpdate()
    {
        $this->company();
        $arrCar = [
            'automaker' => 'Honda Civic',
            'model' => 'Civic',
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'JHE-4545',
            'renavan' => '546546545',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $objCar = $this->carService->add($arrCar);

        $arrCarUPdate = [
            'automaker' => 'Honda',
            'model' => 'Civic',
            'power' => '2.0',
            'year_factory' => '2018',
            'year' => '2018',
            'tag' => 'JHE-4545',
            'renavan' => '546546545',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $objCar = $this->carService->update($arrCarUPdate);

        $this->assertEquals($arrCarUPdate['automaker'], $objCar->automaker);
    }

    public function testAll()
    {
        $this->company();
        $arrCar = [
            'automaker' => 'Honda Civic',
            'model' => 'Civic',
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'JHE-4545',
            'renavan' => '546546545',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $objCar = $this->carService->add($arrCar);
        $arrCar = $this->carService->all(['user_id' => 2]);
        $this->assertArrayHasKey('automaker', $arrCar[0]);
    }
}
