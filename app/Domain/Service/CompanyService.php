<?php

namespace App\Domain\Service;

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
     * @param \App\Domain\Service\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register($company)
    {
        
    }
}