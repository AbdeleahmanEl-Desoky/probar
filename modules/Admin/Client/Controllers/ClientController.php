<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Client\Handlers\DeleteClientHandler;
use Modules\Admin\Client\Handlers\UpdateClientHandler;
use Modules\Admin\Client\Presenters\ClientPresenter;
use Modules\Admin\Client\Requests\CreateClientRequest;
use Modules\Admin\Client\Requests\DeleteClientRequest;
use Modules\Admin\Client\Requests\GetClientListRequest;
use Modules\Admin\Client\Requests\GetClientRequest;
use Modules\Admin\Client\Requests\UpdateClientRequest;
use Modules\Admin\Client\Services\ClientCRUDService;
use Ramsey\Uuid\Uuid;

class ClientController extends Controller
{
    public function __construct(
        private ClientCRUDService $clientService,
    ) {
    }

    public function index(GetClientListRequest $request)
    {
        $list = $this->clientService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );
        return view('client::index', [
            'clients' => ClientPresenter::collection($list['data']),
            'pagination' => $list['pagination'],
        ]);
    }

}
