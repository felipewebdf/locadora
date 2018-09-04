<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Service\ContractService;
use App\Domain\Contract;
use App\Domain\Service\CompanyService;

/**
 * @group contract
 */
class ContractServiceTest extends TestCase
{
    private $db;

    /**
     *
     * @var App\Domain\Service\CompanyService
     */
    protected $companyService;

    /**
     *
     * @var ContractService
     */
    protected $contractService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->contractService = $this->app->make(ContractService::class);
        $this->companyService = $this->app->make(CompanyService::class);
    }

    public function tearDown()
    {
        $this->db->connection()->rollback();
    }

    protected function company()
    {
        $arrContract = [
            'name' => 'federal',
            'cnpj' => '54256465465465',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => 2
        ];
        return $this->companyService->register($arrContract);
    }

    public function testAddReturnEntity()
    {
        $company = $this->company();

        $arrContract = [
            'name' => 'contrato 1',
            'company_id' => $company->id,
            'template' => 'ajçls djfçlak dsfçlkajs fkjasd [[tag]]',
            'user_id' => 2
        ];
        $contract = $this->contractService->add($arrContract);
        $this->assertInstanceOf(Contract::class, $contract);
        $this->assertNotEmpty($contract->id);
    }
}
