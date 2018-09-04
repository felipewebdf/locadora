<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Traits\CompanyTrait;
use App\Domain\Client;
use App\Exceptions\RulesException;

class ClientService
{
    use ContainerTrait;
    use CompanyTrait;

    /**
     * List all clients for params
     * @param array $params
     * @return array
     */
    public function all($params)
    {
        $company = $this->getCompanyUser($params['user_id']);
        return Client::where('company_id', $company->id)->orderBy('name')->get();
    }

    /**
     *
     * @param array $arrClient
     * @return Client
     * @throws RulesException
     */
    public function add($arrClient)
    {
        $company = $this->getCompanyUser($arrClient['user_id']);
        $arrClient['company_id'] = $company->id;

        $exists = Client::where('cnh', $arrClient['cnh'])
                ->where('company_id', $company->id)->first();

        if ($exists) {
            throw new RulesException('Cnh já cadastrada');
        }

        $arrClient['address_id'] = $this->container
                ->make(AddressService::class)
                ->register($arrClient)->id;
        mb_strtoupper($arrClient['name']);
        $client = new Client();
        $client->fill($arrClient);
        $client->save();
        return $client;
    }

    /**
     *
     * @param array $arrClient
     * @return type
     * @throws RulesException
     */
    public function update($id, $arrClient)
    {
        $client = $this->get($id, $arrClient['user_id']);

        $exists = Client::where('cnh', $arrClient['cnh'])
                ->where('company_id', $client->company->id)->first();

        if ($exists && $exists->id != $client->id) {
            throw new RulesException('Cliente já existente');
        }

        $arrClient['address_id'] = $client->address->id;
        $this->container->make(AddressService::class)->register($arrClient);

        unset($arrClient['user_id']);
        unset($arrClient['company_id']);
        unset($arrClient['address_id']);

        $arrClient['updated_at'] = new \DateTime();
        $client->fill($arrClient);
        $client->save();
        return $client;
    }

    /**
     *
     * @param int $id
     * @param int $userId
     * @return Client
     * @throws RulesException
     */
    public function get($id, $userId)
    {
        $company = $this->getCompanyUser($userId);

        $client = Client::where('id', $id)
                ->where('company_id', $company->id)->first();

        if (!$client) {
            throw new RulesException('Cliente não encontrado');
        }

        return $client;
    }

}
