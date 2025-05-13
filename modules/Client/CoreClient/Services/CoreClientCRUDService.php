<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Services;

use Illuminate\Support\Collection;
use Modules\Client\CoreClient\DTO\CreateCoreClientDTO;
use Modules\Client\CoreClient\Models\Client;
use Modules\Client\CoreClient\Repositories\CoreClientRepository;
use Modules\Client\CoreClient\Requests\ChangePasswordRequest;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Support\Facades\Hash;
class CoreClientCRUDService
{
    public function __construct(
        private CoreClientRepository $repository,
    ) {
    }

    public function create(CreateCoreClientDTO $createCoreClientDTO): Client
    {
         return $this->repository->createCoreClient($createCoreClientDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Client
    {
        return $this->repository->getCoreClient(
            id: $id,
        );
    }




    public function changePassword(ChangePasswordRequest $request)
    {
        $client = auth('api_clients')->user();

        if (!Hash::check($request->old_password, $client->password)) {
            return response()->json(['message' => 'Old password is incorrect.'], 422);
        }

        $client->password = bcrypt($request->new_password);
        $client->save();

        return response()->json(['message' => 'Password updated successfully.']);
    }
}
