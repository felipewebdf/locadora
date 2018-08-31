<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Traits\CompanyTrait;
use App\Domain\Rent;
use App\Exceptions\RulesException;

class RentService
{
    use ContainerTrait;
    use CompanyTrait;

    /**
     * List all rents for params
     * @param array $params
     * @return array
     */
    public function all($params)
    {
        $company = $this->getCompanyUser($params['user_id']);
        return Rent::where('company_id', $company->id)->orderBy('name')->get();
    }

    /**
     *
     * @param array $arrRent
     * @return Rent
     * @throws RulesException
     */
    public function add($arrRent)
    {
        $company = $this->getCompanyUser($arrRent['user_id']);
        $arrRent['company_id'] = $company->id;

        $exists = Rent::where('cnh', $arrRent['cnh'])
                ->where('company_id', $company->id)->first();

        if ($exists) {
            throw new RulesException('Cnh já cadastrada');
        }

        $arrRent['address_id'] = $this->container
                ->make(AddressService::class)
                ->register($arrRent)->id;

        $rent = new Rent();
        $rent->fill($arrRent);
        $rent->save();
        return $rent;
    }

    /**
     *
     * @param array $arrRent
     * @return type
     * @throws RulesException
     */
    public function update($id, $arrRent)
    {
        $rent = $this->get($id, $arrRent['user_id']);

        $exists = Rent::where('cnh', $arrRent['cnh'])
                ->where('company_id', $rent->company->id)->first();

        if ($exists && $exists->id != $rent->id) {
            throw new RulesException('Rente já existente');
        }

        $arrRent['address_id'] = $rent->address->id;
        $this->container->make(AddressService::class)->register($arrRent);

        unset($arrRent['user_id']);
        unset($arrRent['company_id']);
        unset($arrRent['address_id']);

        $arrRent['updated_at'] = new \DateTime();
        $rent->fill($arrRent);
        $rent->save();
        return $rent;
    }

    /**
     *
     * @param int $id
     * @param int $userId
     * @return Rent
     * @throws RulesException
     */
    public function get($id, $userId)
    {
        $company = $this->getCompanyUser($userId);

        $rent = Rent::where('id', $id)
                ->where('company_id', $company->id)->first();

        if (!$rent) {
            throw new RulesException('Rente não encontrado');
        }

        return $rent;
    }

}
