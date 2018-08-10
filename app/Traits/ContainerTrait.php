<?php
namespace App\Traits;

use Illuminate\Container\Container;

trait ContainerTrait
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}