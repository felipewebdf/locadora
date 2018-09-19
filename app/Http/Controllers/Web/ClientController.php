<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\ClientService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;
use \App\Domain\Address;

class ClientController extends Controller
{

    use ContainerTrait;

    public function index()
    {
        $user_id = Auth::id();
        $clients = $this->container->make(ClientService::class)->all(['user_id' => $user_id]);
        return view('web.client.list', ['clients' => $clients, 'title' => 'Lista de clientes']);
    }

    public function create()
    {
        return view('web.client.create', [
            'title' => 'Cadastrar cliente',
            'ufs' => Address::$UFS
        ]);
    }

    public function update($id)
    {
        $client = $this->container->make(ClientService::class)->get($id, Auth::id());
        return view('web.client.update', [
            'client' => $client,
            'title' => 'Alterar cliente',
            'ufs' => Address::$UFS
        ]);
    }

}
