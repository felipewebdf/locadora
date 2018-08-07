<?php

namespace App\Domain\Service;

use Illuminate\Container\Container;
use App\Domain\Company;

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
     * @return Company
     */
    public function register($arrCompany)
    {
        $user = \App\User::find($arrCompany['user_id']);

        if (!$user) {
            throw new \InvalidArgumentException('Usuário não encontrado');
        }

        $company = new Company();
        $company->name = $arrCompany['name'];
        $company->cnpj = $arrCompany['cnpj'];
        $company->created_at = new \DateTime();
        $company->user_id = $user->id;

        $address = $this->container->make(AddressService::class)->register($arrCompany);
        $company->address_id = $address->id;

        $company->save();
        return $company;
    }

}
