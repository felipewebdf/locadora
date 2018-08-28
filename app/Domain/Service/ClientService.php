<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Domain\Client;
use App\Exceptions\RulesException;

class ClientService
{
    use ContainerTrait;

    public function all($params)
    {
        $company = $this->container->make(CompanyService::class)->forUser($params['user_id']);
        return Client::where('company_id', $company->id)->get();
    }

    /**
     *
     * @param array $arrClient
     * @return Client
     * @throws RulesException
     */
    public function add($arrClient)
    {
        $company = $this->container->make(CompanyService::class)->forUser($arrClient['user_id']);
        $arrClient['company_id'] = $company->id;

        $exists = Client::where('cnh', $arrClient['cnh'])
                ->where('company_id', $company->id)->first();

        if ($exists) {
            throw new RulesException('Cnh já cadastrada');
        }

        $arrClient['address_id'] = $this->container
                ->make(AddressService::class)
                ->register($arrClient)->id;

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
    public function update($arrClient)
    {
        $company = $this->container->make(CompanyService::class)->forUser($arrClient['user_id']);
        $arrClient['company_id'] = $company->id;

        $client = Client::find($arrClient['id']);

        if (!$client) {
            throw new RulesException('Cliente não encontrado');
        }

        $exists = Client::where('cnh', $arrClient['cnh'])
                ->where('company_id', $company->id)->first();

        if ($exists && $exists->id != $client->id) {
            throw new RulesException('Cliente já existente');
        }

        $arrClient['address_id'] = $client->address->id;
        $this->container->make(AddressService::class)->register($arrClient);

        unset($arrClient['user_id']);
        unset($arrClient['company_id']);
        unset($arrClient['id']);

        $arrClient['updated_at'] = new \DateTime();
        $client->fill($arrClient);
        $client->save();
        return $client;
    }

}
