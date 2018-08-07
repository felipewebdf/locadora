<?php

namespace App\Domain\Service;

use Illuminate\Container\Container;

/**
 * Class service company
 */
class CompanyService
{
    /**
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     *
     * @param \Illuminate\Container\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * New company
     * @param array $arrCompany
     * @return \App\Domain\Company
     */
    public function register($arrCompany)
    {
        $company = new \App\Domain\Company();
        $company->name = $arrCompany['name'];
        $company->cnpj = $arrCompany['cnpj'];
        $company->created_at = new \DateTime();

        $address = $this->container->make(AddressService::class)->register($arrCompany);
        $company->address_id = $address->id;

        $company->save();
        return $company;
    }
}