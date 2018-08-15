<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Domain\Car;
use App\Exceptions\RulesException;

class CarService
{
    use ContainerTrait;

    public function all($params)
    {
        $company = $this->container->make(CompanyService::class)->forUser($params['user_id']);
        return Car::where('company_id', $company->id)->get();
    }

    /**
     *
     * @param array $arrCar
     * @return Car
     * @throws RulesException
     */
    public function add($arrCar)
    {
        $company = $this->container->make(CompanyService::class)->forUser($arrCar['user_id']);
        $arrCar['company_id'] = $company->id;

        $exists = Car::where('tag', $arrCar['tag'])
                ->where('company_id', $company->id)->first();

        if ($exists) {
            throw new RulesException('Veículo já cadastrado');
        }

        $car = new Car();
        $car->fill($arrCar);
        $car->save();
        return $car;
    }

    /**
     *
     * @param array $arrCar
     * @return type
     * @throws RulesException
     */
    public function update($arrCar)
    {
        $company = $this->container->make(CompanyService::class)->forUser($arrCar['user_id']);
        $arrCar['company_id'] = $company->id;
        $car = Car::where('tag', $arrCar['tag'])
                ->where('company_id', $company->id)->first();

        if (!$car) {
            throw new RulesException('Veículo não encontrado');
        }

        $arrCar['updated_at'] = new \DateTime();
        $car->fill($arrCar);
        $car->save();
        return $car;
    }

    /**
     *
     * @param array $arrCar
     * @return Car
     */
    public function getForTag($arrCar)
    {
        $company = $this->container->make(CompanyService::class)->forUser($arrCar['user_id']);

        $exists = Car::where('tag', $arrCar['tag'])
                ->where('company_id', $company->id)->first();
        return $exists;
    }
}
