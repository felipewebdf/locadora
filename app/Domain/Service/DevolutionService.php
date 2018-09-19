<?php

namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Exceptions\RulesException;
use App\Domain\Devolution;

class DevolutionService
{

    use ContainerTrait;

    /**
     * Get devolution for rent
     * @param integer $rent_id
     * @return array
     */
    public function getForRent($rent_id)
    {
        return Devolution::where('rent_id', $rent_id)->first();
    }

    /**
     *
     * @param array $arrDevolution
     * @return Devolution
     * @throws RulesException
     */
    public function register($arrDevolution)
    {
        $devolutionRentExists = $this->getForRent($arrDevolution['rent_id']);

        if ($devolutionRentExists) {
            throw new RulesException('Devolução já existente para esta locação');
        }

        $devolution = new Devolution();
        $devolution->fill($arrDevolution);
        $devolution->save();
        return $devolution;
    }

    /**
     * @param integer $id
     * @param array $arrDevolution
     * @return Devolution
     * @throws RulesException
     */
    public function update($id, $arrDevolution)
    {
        $devolutionExists = $this->get($id);
        unset($arrDevolution['user_id']);
        unset($arrDevolution['rent_id']);
        $devolutionExists->fill($arrDevolution);
        $devolutionExists->save();
        return $devolutionExists;
    }

    /**
     *
     * @param integer $id
     * @return Devolution
     * @throws RulesException
     */
    public function get($id)
    {
        $devolutionExists = Devolution::find($id);

        if (!$devolutionExists) {
            throw new RulesException('Devolução não encontrada');
        }

        return $devolutionExists;
    }

}
