<?php

namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Domain\Company;
use App\Exceptions\RulesException;
use App\Domain\Car;
use App\Domain\Client;

/**
 * Class service company
 */
class CompanyService
{

    use ContainerTrait;

    /**
     * New company
     * @param array $arrCompany
     * @return Company
     */
    public function register($arrCompany)
    {
        $user = $this->container->make(UserService::class)->getForId($arrCompany['user_id']);

        $companyExists = $this->forUser($user->id);

        if ($companyExists) {
            return $this->update($companyExists, $arrCompany);
        }

        $company = new Company();
        $company->name = mb_strtoupper($arrCompany['name']);
        $company->cnpj = $arrCompany['cnpj'];
        $company->created_at = new \DateTime();
        $company->user_id = $user->id;

        $this->registerAddress($company, $arrCompany);

        $company->save();
        return $company;
    }

    /**
     * Update register company
     * @param Company $company
     * @param array $arrCompany
     * @return Company
     */
    public function update($company, $arrCompany)
    {

        $company->name = mb_strtoupper($arrCompany['name']);
        $company->cnpj = $arrCompany['cnpj'];

        $arrCompany['address_id'] = $company->address_id;
        $this->registerAddress($company, $arrCompany);

        $company->save();
        return $company;
    }

    /**
     * Find company for user
     * @param integer $user_id
     * @return Company | null
     */
    public function forUser($user_id)
    {
        return Company::where('user_id', $user_id)->first();
    }

    /**
     * Register address company
     * @param Company $company
     * @param array $arrAddress
     */
    protected function registerAddress(Company $company, $arrAddress)
    {
        $address = $this->container->make(AddressService::class)->register($arrAddress);
        $company->address_id = $address->id;
    }
}
