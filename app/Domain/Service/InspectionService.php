<?php
namespace App\Domain\Service;

use App\Traits\ContainerTrait;
use App\Exceptions\RulesException;
use App\Domain\Inspection;

class InspectionService
{
    use ContainerTrait;

    /**
     * Get inspection for rent
     * @param integer $rent_id
     * @return array
     */
    public function getForRent($rent_id)
    {
        return Inspection::where('rent_id', $rent_id)->first();
    }

    /**
     *
     * @param array $arrInspection
     * @return Inspection
     * @throws RulesException
     */
    public function register($arrInspection)
    {
        $inpectionRentExists = $this->getForRent($arrInspection['rent_id']);
        if ($inpectionRentExists) {
            throw new RulesException('Vistoria já existente para esta locação');
        }
        $inspection = new Inspection();
        $inspection->fill($arrInspection);
        $inspection->save();
        return $inspection;
    }

    /**
     * @param integer $id
     * @param array $arrInspection
     * @return Inspection
     * @throws RulesException
     */
    public function update($id, $arrInspection)
    {
        $inspectionExists = $this->get($id);
        unset($arrInspection['user_id']);
        unset($arrInspection['rent_id']);
        $inspectionExists->fill($arrInspection);
        $inspectionExists->save();
        return $inspectionExists;
    }

    /**
     *
     * @param integer $id
     * @return Inspection
     * @throws RulesException
     */
    public function get($id)
    {
        $inspectionExists = Inspection::find($id);

        if (!$inspectionExists) {
            throw new RulesException('Vistoria não encontrada');
        }

        return $inspectionExists;
    }

}
