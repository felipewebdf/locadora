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
                ->where('id', $id)->first();

        if (!$rent) {
            throw new RulesException('Locação não existe');
        }

        unset($arrRent['client_id']);
        unset($arrRent['car_id']);

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

    protected function verifyParams($arrRent)
    {
        $company = $this->getCompanyUser($arrRent['user_id']);
        $arrRent['company_id'] = $company->id;

        $client = Client::where('id', $arrRent['client_id'])
                ->where('company_id', $company->id)->first();

        if (!$client) {
            throw new RulesException('Cliente não encontrado');
        }

        $car = Car::where('id', $arrRent['car_id'])
                ->where('company_id', $company->id)->first();

        if (!$car) {
            throw new RulesException('Veículo não encontrado');
        }

        $typeRent = TypeRent::where('id', $arrRent['type_rent_id'])->first();

        if (!$typeRent) {
            throw new RulesException('Tipo de locação não encontrada');
        }
        return $arrRent;
    }

}
