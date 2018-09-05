<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Domain\Contract;
use App\Exceptions\RulesException;


class ContractService
{
    use ContainerTrait;

    /**
     *
     * @param array $params
     * @return array
     */
    public function all($params)
    {
        $company = $this->container->make(CompanyService::class)->forUser($params['user_id']);
        return Contract::where('company_id', $company->id)->orderBy('name')->get();
    }

    /**
     *
     * @param array $arrContract
     * @return Contract
     * @throws RulesException
     */
    public function add($arrContract)
    {
        $company = $this->container
                ->make(CompanyService::class)
                ->forUser($arrContract['user_id']);
        $arrContract['company_id'] = $company->id;
        $arrContract['name'] = mb_strtoupper($arrContract['name']);

        $contract = new Contract();
        $contract->fill($arrContract);
        $contract->save();
        return $contract;
    }

    /**
     *
     * @param integer $id
     * @param array $arrContract
     * @return Contract
     */
    public function update($id, $arrContract)
    {
        $company = $this->container
                ->make(CompanyService::class)
                ->forUser($arrContract['user_id']);

        $contract = Contract::find($id);

        if ($company->id != $contract->company->id) {
            throw new RulesException('Contrato não pertence a sua empresa, portanto não pode ser alterado');
        }

        $contract->name = mb_strtoupper($arrContract['name']);
        $contract->template = $arrContract['template'];
        $contract->save();
        return $contract;
    }

    /**
     *
     * @param integer $id
     * @param integer $user_id
     * @return Contract
     * @throws RulesException
     */
    public function get($id, $user_id)
    {
        $company = $this->container
                ->make(CompanyService::class)
                ->forUser($user_id);

        $contract = Contract::where('id', $id)->where('company_id', $company->id)->first();

        if (!$contract) {
            throw new RulesException('Contrato não encontrado');
        }

        return $contract;
    }
}
