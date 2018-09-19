<?php

namespace App\Domain\Service;

use Illuminate\Container\Container;
use App\Domain\Address;

class AddressService
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
     * Register new address
     * @param array $arrAddress
     * @return \App\Domain\Address
     */
    public function register($arrAddress)
    {
        if (isset($arrAddress['address_id'])) {
            $addressExists = \App\Domain\Address::where('id', $arrAddress['address_id'])->first();
            return $this->update($addressExists, $arrAddress);
        }

        $address = new \App\Domain\Address();
        $address->description = $arrAddress['description'];
        $address->district = $arrAddress['district'];
        $address->cep = $arrAddress['cep'];
        $address->city = $arrAddress['city'];
        $address->uf = strtoupper($arrAddress['uf']);
        $address->created_at = new \DateTime();
        $address->save();
        return $address;
    }

    public function update(Address $address, $arrAddress)
    {
        $address->description = $arrAddress['description'];
        $address->district = $arrAddress['district'];
        $address->cep = $arrAddress['cep'];
        $address->city = $arrAddress['city'];
        $address->uf = strtoupper($arrAddress['uf']);
        $address->save();
        return $address;
    }

}
