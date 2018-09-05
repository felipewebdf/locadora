<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\RentService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;
use App\Domain\Service\DevolutionService;
use Illuminate\Http\Request;
use App\Domain\Service\InspectionService;

class DevolutionController extends Controller
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
        $inspection = $this->container
                ->make(InspectionService::class)
                ->getForRent($request->route('rent_id'));
        return view('web.devolution.create', [
            'title' => 'Cadastrar devolução',
            'rent' => $rent,
            'gasolines' => RentService::gasoline(),
            'inspection' => $inspection
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
        $devolution = $this->container
                ->make(DevolutionService::class)
                ->get($id);
        return view('web.devolution.update', [
            'title' => 'Alterar devolução',
            'rent' => $rent,
            'devolution' => $devolution,
            'gasolines' => RentService::gasoline()
        ]);
    }
}
