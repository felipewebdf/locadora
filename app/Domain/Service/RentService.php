<?php

namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Traits\CompanyTrait;
use App\Exceptions\RulesException;
use App\Domain\Rent;
use App\Domain\Client;
use App\Domain\Car;
use App\Domain\TypeRent;

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
        return Rent::where('company_id', $company->id)->orderBy('init')->get();
    }

    /**
     *
     * @param array $arrParams
     * @return Rent
     * @throws RulesException
     */
    public function add($arrParams)
    {
        $arrRent = $this->verifyParams($arrParams);

        $exists = Rent::where('car_id', $arrRent['car_id'])
                        ->where('company_id', $arrRent['company_id'])
                        ->where('client_id', $arrRent['client_id'])
                        ->where('driver_id', $arrRent['driver_id'])
                        ->where('type_rent_id', $arrRent['type_rent_id'])
                        ->where('contract_id', $arrRent['contract_id'])
                        ->where('init', $arrRent['init'])->first();

        if ($exists) {
            throw new RulesException('Locação já existe');
        }

        $rent = new Rent();
        $rent->fill($arrRent);
        $rent->save();
        return $rent;
    }

    /**
     *
     * @param array $arrParams
     * @return Rent
     * @throws RulesException
     */
    public function update($id, $arrParams)
    {
        $arrRent = $this->verifyParams($arrParams);

        $rent = Rent::where('car_id', $arrRent['car_id'])
                        ->where('company_id', $arrRent['company_id'])
                        ->where('client_id', $arrRent['client_id'])
                        ->where('driver_id', $arrRent['driver_id'])
                        ->where('id', $id)->first();

        if (!$rent) {
            throw new RulesException('Locação não existe');
        }

        unset($arrRent['client_id']);
        unset($arrRent['car_id']);
        unset($arrRent['user_id']);

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
            throw new RulesException('Locação não encontrada');
        }

        return $rent;
    }

    /**
     * Verify params rent
     * @param array $arrRent
     * @return array
     * @throws RulesException
     */
    protected function verifyParams($arrRent)
    {
        $company = $this->getCompanyUser($arrRent['user_id']);
        $arrRent['company_id'] = $company->id;

        $this->container->make(ClientService::class)->getByCompany($arrRent['client_id'], $company->id);
        $this->container->make(CarService::class)->getByCompany($arrRent['car_id'], $company->id);

        $typeRent = TypeRent::where('id', $arrRent['type_rent_id'])->first();

        if (!$typeRent) {
            throw new RulesException('Tipo de locação não encontrada');
        }

        return $arrRent;
    }

    public static function gasoline()
    {
        return [
            '1/8' => '1/8',
            '2/8' => '2/8',
            '4/8' => '4/8',
            '6/8' => '6/8',
            '8/8' => '8/8'
        ];
    }

}
