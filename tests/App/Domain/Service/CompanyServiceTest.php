<?php
namespace Test\App\Domain\Service;

use Tests\TestCase;
use App\Domain\Service\CompanyService;
use App\Domain\Company;

/**
 * @group company
 */
class CompanyServiceTest extends TestCase
{
    private $db;

    /**
     *
     * @var CompanyService
     */
    protected $companyService;

    public function setUp()
    {
        parent::setUp();
        $this->db = $this->app->make('db');
        $this->db->connection()->beginTransaction();
        $this->companyService = $this->app->make(CompanyService::class);
    }

    public function tearDown()
    {
        $this->db->connection()->rollback();
    }

    public function testRegisterReturnEntity()
    {
        $arrCompany = [
            'name' => 'federal',
            'cnpj' => '54256465465465',
            'description' => 'federal',
            'district' => '54256465465465',
            'cep' => '12123456',
            'city' => 'nome da cidade',
            'uf' => 'DF'
        ];
        $objCompany = $this->companyService->register($arrCompany);
        $this->assertInstanceOf(Company::class, $objCompany);
    }

}
