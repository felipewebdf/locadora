<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Domain\Car;
use App\Exceptions\RulesException;
use App\Domain\ModelCar;

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

        $model = ModelCar::where('id', '=', $arrCar['model'])->first();

        if (!$model) {
            throw new RulesException('Modelo não encontrado');
        }

        $arrCar['model_id'] = $model->id;
        $arrCar['tag'] = strtoupper($arrCar['tag']);

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
        $arrCar['tag'] = strtoupper($arrCar['tag']);
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

        $exists = Car::where('tag', strtoupper($arrCar['tag']))
                ->where('company_id', $company->id)->first();
        return $exists;
    }

    static public function years()
    {
        return range(2009, (new \DateTime())->format("Y"));
    }
}
