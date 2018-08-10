<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Domain\Car;
use App\Exceptions\RulesException;

class CarService
{
    use ContainerTrait;

    public function add($arrCar)
    {
        $company = $this->container->make(CompanyService::class)->forUser($arrCar['user_id']);
        $arrCar['company_id'] = $company->id;

        $exists = Car::where('tag', $arrCar['tag'])
                ->where('company_id', $company->id)->first();
        if ($exists) {
            throw new RulesException('Carro já cadastrado');
        }

        $car = new Car();
        $car->fill($arrCar);
        $car->save();
        return $car;
    }

    public function all($params)
    {
        $company = $this->container->make(CompanyService::class)->forUser($params['user_id']);
        return Car::where('company_id', $company->id)->orderBy('automaker', 'asc')->get();
    }
}
