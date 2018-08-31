<?php
namespace App\Http\Controllers\Api\Client;

use \App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use \App\Traits\ContainerTrait;
use \Illuminate\Support\Facades\Auth;
use \App\Http\StatusCode;
use \App\Domain\Service\ClientService;
use App\Http\Request\Client\ClientRequest;
use \App\Exceptions\RulesException;

class RegisterController extends Controller
{
    use ContainerTrait;

    public function index(Request $request)
    {

    }

    /**
     *
     * @param App\Http\Request\Client\ClientRequest $request
     * @return json
     */
    public function store(ClientRequest $request)
    {
        try {
            $id = Auth::id();
            $arrClients = $request->all();
            $arrClients['user_id'] = $id;
            $client = $this->container
                    ->make(ClientService::class)
                    ->add($arrClients);
            return response()->json($client->toArray(), StatusCode::HTTP_CREATED);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }

    /**
     * @param integer $id
     * @param App\Http\Request\Client\ClientRequest $request
     * @return json
     */
    public function update($id, ClientRequest $request)
    {
        try {
            $userId = Auth::id();
            $arrClients = $request->all();
            $arrClients['user_id'] = $userId;
            $client = $this->container
                    ->make(ClientService::class)
                    ->update($id, $arrClients);
            return response()->json($client->toArray(), StatusCode::HTTP_OK);
        } catch (RulesException $ex) {
            return response()->json([$ex->getMessage()], $ex->getCode());
        }
    }
}