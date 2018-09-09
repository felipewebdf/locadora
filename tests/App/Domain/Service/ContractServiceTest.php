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

    protected function company($user_id=2)
    {
        $arrContract = [
            'name' => 'federal',
            'cnpj' => '54256465465465',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF',
            'user_id' => $user_id
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

    public function testUpdateReturnEntityAltered()
    {
        $company = $this->company();

        $arrContract = [
            'name' => 'contrato 1',
            'company_id' => $company->id,
            'template' => 'ajçls djfçlak dsfçlkajs fkjasd [[tag]]',
            'user_id' => 2
        ];
        $contract = $this->contractService->add($arrContract);

        $arrContractUpdate = [
            'name' => 'contract 2',
            'company_id' => $company->id,
            'template' => 'ALterado [[tag]]',
            'user_id' => 2
        ];

        $contractUpdate = $this->contractService->update($contract->id, $arrContractUpdate);

        $this->assertInstanceOf(Contract::class, $contractUpdate);
        $this->assertNotEquals($arrContract['name'], $contractUpdate->name);
        $this->assertNotEquals($arrContract['template'], $contractUpdate->template);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     * @expectedExceptionMessage Contrato não pertence a sua empresa, portanto não pode ser alterado
     */
    public function testUpdateOtherCompanyException()
    {
        $company = $this->company();

        $arrContract = [
            'name' => 'contrato 1',
            'company_id' => $company->id,
            'template' => 'ajçls djfçlak dsfçlkajs fkjasd [[tag]]',
            'user_id' => 2
        ];
        $contract = $this->contractService->add($arrContract);

        $company2 = $this->company(1);

        $arrContractUpdate = [
            'name' => 'contract 2',
            'company_id' => $company2->id,
            'template' => 'ALterado [[tag]]',
            'user_id' => 1
        ];

        $this->contractService->update($contract->id, $arrContractUpdate);
    }

    public function testGetContractReturnEntity()
    {
        $company = $this->company();

        $arrContract = [
            'name' => 'contrato 1',
            'company_id' => $company->id,
            'template' => 'ajçls djfçlak dsfçlkajs fkjasd [[tag]]',
            'user_id' => 2
        ];
        $contract = $this->contractService->add($arrContract);

        $contractGet = $this->contractService->get($contract->id, 2);
        $this->assertEquals($contract->id, $contractGet->id);
    }

    /**
     * @expectedException \App\Exceptions\RulesException
     */
    public function testGetNotExistsException()
    {
        $company = $this->company();
        $this->contractService->get(1, 2);
    }

    public function testAll()
    {
        $company = $this->company();

        $arrContract = [
            'name' => 'contrato 1',
            'company_id' => $company->id,
            'template' => 'ajçls djfçlak dsfçlkajs fkjasd [[tag]]',
            'user_id' => 2
        ];
        $this->contractService->add($arrContract);

        $arrContracts = $this->contractService->all(['user_id' => 2]);
        $this->assertArrayHasKey('name', $arrContracts[0]);
        $this->assertArrayHasKey('template', $arrContracts[0]);
    }
}
