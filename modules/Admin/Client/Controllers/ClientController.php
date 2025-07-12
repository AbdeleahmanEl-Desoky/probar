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
use Tymon\JWTAuth\Facades\JWTAuth;
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

        $list->setCollection(collect(ClientPresenter::collection($list->items())));

        // extract pagination info
        $pagination = [
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
        ];

        return view('client::index', [
            'clients' => $list,
            'pagination' => $pagination,
        ]);
    }

    public function toggleStatus(string $id, GetClientListRequest $request): JsonResponse
    {
        $client = $this->clientService->get(Uuid::fromString($id));

        $newStatus = !$client->is_active;
        $client->is_active = $newStatus;
        $client->save();

        if (!$newStatus) {
            JWTAuth::invalidate(JWTAuth::fromUser($client));
        }

        return response()->json([
            'message' => 'Status updated successfully',
            'is_active' => $client->is_active,
        ]);
    }
}
