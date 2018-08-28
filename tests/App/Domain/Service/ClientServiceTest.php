<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Service\ClientService;
use App\Domain\Client;
use App\Domain\Service\CompanyService;

/**
 * @group client
 */
class ClientServiceTest extends TestCase
{
    private $db;

    /**
     *
     * @var App\Domain\Service\CompanyService
     */
    protected $companyService;

    /**
     *
     * @var ClientService
     */
    protected $clientService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->clientService = $this->app->make(ClientService::class);
        $this->companyService = $this->app->make(CompanyService::class);
    }

    public function tearDown()
    {
        $this->db->connection()->rollback();
    }

    protected function company()
    {
        $arrClient = [
            'name' => 'federal',
            'cnpj' => '54256465465465',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];
        return $this->companyService->register($arrClient);
    }

    public function testAddReturnEntity()
    {
        $this->company();

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
        $client = $this->clientService->add($arrClient);
        $this->assertInstanceOf(Client::class, $client);
        $this->assertNotEmpty($client->id);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testAddExistsClientLaunchException()
    {
        $this->company();
        $arrClient = [
            'name' => 'Novo cliente',
            'cnh' => '1.8',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];
        $this->clientService->add($arrClient);
        $this->clientService->add($arrClient);
    }
//
    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testUpdateVerifyExists()
    {
        $this->company();
        $arrClient = [
            'name' => 'Novo cliente',
            'cnh' => '1.8',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];

        $this->clientService->add($arrClient);

        $arrClient['cnh'] = '123';
        $clientNew = $this->clientService->add($arrClient);

        $arrClient['id'] = $clientNew->id;
        $arrClient['cnh'] = '1.8';
        $this->clientService->update($arrClient);
    }

    /**
     * @group testUpdateReturnEntityUpdate
     */
    public function testUpdateReturnEntityUpdate()
    {
        $this->company();
        $arrClient = [
            'name' => 'Novo cliente',
            'cnh' => '1.8',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];
        $client = $this->clientService->add($arrClient);

        $arrClientUPdate = [
            'id' => $client->id,
            'name' => 'Novo cliente asd',
            'cnh' => '2123123',
            'description' => 'federal asdf',
            'district' => 'adsfsda465',
            'cep' => '12123456',
            'city' => 'nome da csdf',
            'uf' => 'GO',
            'user_id' => 2
        ];
        $objClient = $this->clientService->update($arrClientUPdate);

        $this->assertEquals($arrClientUPdate['cnh'], $objClient->cnh);
    }

    public function testAll()
    {
        $this->company();
        $arrClient = [
            'name' => 'Novo cliente',
            'cnh' => '1.8',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];

        $this->clientService->add($arrClient);

        $arrClients = $this->clientService->all(['user_id' => 2]);
        $this->assertArrayHasKey('name', $arrClients[0]);
        $this->assertArrayHasKey('cnh', $arrClients[0]);
    }
}
