<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\RentService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;
use App\Domain\Service\InspectionService;
use Illuminate\Http\Request;

class InspectionController extends Controller
{

    use ContainerTrait;

    /**
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $rent = $this->container
                ->make(RentService::class)
                ->get($request->route('rent_id'), Auth::id());
        return view('web.inspection.create', [
            'title' => 'Cadastrar vistoria',
            'rent' => $rent,
            'gasolines' => RentService::gasoline()
        ]);
    }

    /**
     *
     * @param integer $id
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function update(Request $request)
    {
        $id = $request->route('id');
        $rent = $this->container
                ->make(RentService::class)
                ->get($request->route('rent_id'), Auth::id());
        $inspection = $this->container
                ->make(InspectionService::class)
                ->get($id);
        return view('web.inspection.update', [
            'title' => 'Alterar vistoria',
            'rent' => $rent,
            'inspection' => $inspection,
            'gasolines' => RentService::gasoline()
        ]);
    }

}
