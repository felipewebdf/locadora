<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Domain\Contract;
use App\Exceptions\RulesException;


class ContractService
{
    use ContainerTrait;

    public function all($params)
    {
        $company = $this->container->make(CompanyService::class)->forUser($params['user_id']);
        return Contract::where('company_id', $company->id)->get();
    }

    /**
     *
     * @param array $arrContract
     * @return Contract
     * @throws RulesException
     */
    public function add($arrContract)
    {
        $company = $this->container->make(CompanyService::class)
                ->forUser($arrContract['user_id']);
        $arrContract['company_id'] = $company->id;

        $contract = new Contract();
        $contract->fill($arrContract);
        $contract->save();
        return $contract;
    }
}
