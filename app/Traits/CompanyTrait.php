<?php
namespace App\Traits;

use App\Domain\Service\CompanyService;

trait CompanyTrait
{
    /**
     *
     * @param type $userId
     * @return type
     * @throws RulesException
     */
    protected function getCompanyUser($userId)
    {
        $company = $this->container->make(CompanyService::class)->forUser($userId);

        if (!$company) {
            throw new RulesException('Usuário não esta vinculado a uma empresa');
        }

        return $company;
    }
}