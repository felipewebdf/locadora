<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Service\AddressService;
use App\Domain\Address;

/**
 * @group address
 */
class AddressServiceTest extends TestCase
{
    private $db;

    /**
     *
     * @var AddressService
     */
    protected $addressService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->addressService = $this->app->make(AddressService::class);
    }

    public function tearDown()
    {
        $this->db->connection()->rollback();
    }

    public function testRegisterReturnEntity()
    {
        $arrAddress = [
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF'
        ];
        $objAddress = $this->addressService->register($arrAddress);
        $this->assertInstanceOf(Address::class, $objAddress);
    }

    public function testRegisterExistAddressUpdateAndReturnEntity()
    {
        $arrAddress = [
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF'
        ];
        $objAddress = $this->addressService->register($arrAddress);
        $arrAddressUpdate = [
            'description' => 'federala dfa',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da as dcidade',
            'uf' => 'DF',
            'address_id' => $objAddress->id
        ];

        $objAddressExists = $this->addressService->register($arrAddressUpdate);
        $this->assertEquals($objAddressExists->id, $objAddress->id);
        $this->assertEquals($arrAddressUpdate['description'], $objAddressExists->description);
    }

}
