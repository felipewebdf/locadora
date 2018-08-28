<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domain\Service\ClientService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ContainerTrait;


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
            'title' => 'Cadastrar cliente'
        ]);
    }

    public function update($tag)
    {
//        $arrClient = [
//            'tag' => $tag,
//            'user_id' => Auth::id()
//        ];
//        $client = $this->container->make(ClientService::class)->getForTag($arrClient);
//        $brands = \App\Domain\Brand::all()->sortBy('name');
//        $models = \App\Domain\ModelClient::where('brand_id', '=', $client->model->brand->id)->orderBy('name')->get();
//        //dd($models);
//        return view('web.client.update', [
//            'client' => $client,
//            'brands' => $brands,
//            'models' => $models,
//            'years' => ClientService::years(),
//            'title' => 'Alterar veículo'
//        ]);
    }

}
