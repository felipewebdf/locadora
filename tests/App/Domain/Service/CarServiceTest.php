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
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'Honda',
            'renavan' => '546546545',
            'chassi' => '546546545123',
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
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'PAT-5006',
            'renavan' => '546546545',
            'chassi' => '546546545123',
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
    public function testAddCarNotExistsModelLaunchException()
    {
        $this->company();
        $arrCar = [
            'model' => 23443,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'PAT-5006',
            'renavan' => '546546545',
            'chassi' => '546546545123',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $this->carService->add($arrCar);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testUpdateVerifyExists()
    {
        $this->company();
        $arrCar = [
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'Honda',
            'renavan' => '546546545',
            'chassi' => '546546545123',
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
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'JHE-4545',
            'renavan' => '546546545',
            'chassi' => '546546545123',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $objCar = $this->carService->add($arrCar);

        $arrCarUPdate = [
            'model' => 703,
            'power' => '2.0',
            'year_factory' => '2018',
            'year' => '2018',
            'tag' => 'JHE-4545',
            'renavan' => '546546545',
            'chassi' => '546546545123',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $objCar = $this->carService->update($arrCarUPdate);

        $this->assertEquals($arrCarUPdate['power'], $objCar->power);
    }

    public function testAll()
    {
        $this->company();
        $arrCar = [
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'JHE-4545',
            'renavan' => '546546545',
            'chassi' => '546546545123',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $objCar = $this->carService->add($arrCar);
        $arrCar = $this->carService->all(['user_id' => 2]);
        $this->assertArrayHasKey('power', $arrCar[0]);
    }

    public function testGetForTag()
    {
        $this->company();

        $arrCar = [
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'Honda',
            'renavan' => '546546545',
            'chassi' => '546546545123',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $objCar = $this->carService->add($arrCar);
        //dd($objCar);
        $carTag = $this->carService->getForTag($arrCar);
        //dd($carTag);

        $this->assertEquals($objCar->tag, $carTag->tag);

    }

    public function testYearsReturnArray()
    {
        $years = CarService::years();
        $this->assertEquals(2009, $years[0]);
        $this->assertEquals((new \DateTime)->format('Y'), end($years));
    }


    public function testGetByCompany()
    {
        $objCompany = $this->company();

        $arrCar = [
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'Honda',
            'renavan' => '546546545',
            'chassi' => '546546545123',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 2,
            'provider_id' => null
        ];
        $objCar = $this->carService->add($arrCar);

        $objCarCompany = $this->carService->getByCompany($objCar->id, $objCompany->id);
        $this->assertEquals($objCar->year, $objCarCompany->year);
        $this->assertEquals($objCar->tag, $objCarCompany->tag);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testGetNotByCompany()
    {
        $objCompany = $this->company();

        $arrCar = [
            'model' => 703,
            'power' => '1.8',
            'year_factory' => '2007',
            'year' => '2007',
            'tag' => 'Honda',
            'renavan' => '546546545',
            'chassi' => '546546545123',
            'door' => '5',
            'capacity' => '5',
            'user_id' => 1,
            'provider_id' => null
        ];
        $objCar = $this->carService->add($arrCar);

        $objCarCompany = $this->carService->getByCompany($objCar->id, $objCompany->id);
    }
}
