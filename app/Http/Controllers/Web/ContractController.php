<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\ContractService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;

class ContractController extends Controller
{
    use ContainerTrait;

    public function index()
    {
        $user_id = Auth::id();
        $contracts = $this->container->make(ContractService::class)->all(['user_id' => $user_id]);
        return view('web.contract.list', [
            'contracts' => $contracts,
            'title' => 'Lista de contratos'
        ]);
    }

    public function create()
    {
        return view('web.contract.create', [
            'title' => 'Cadastrar contrato'
        ]);
    }

    public function update($id)
    {
        $contract = $this->container->make(ContractService::class)->get($id, Auth::id());
        return view('web.contract.update', [
            'title' => 'Alterar contrato',
            'contract' => $contract
        ]);
    }
}
