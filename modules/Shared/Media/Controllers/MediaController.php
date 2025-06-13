<?php

declare(strict_types=1);

namespace Modules\Shared\Media\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;
use App\Mail\HelpMessageMail;
use Illuminate\Support\Facades\Mail;
use Modules\Shared\Help\Handlers\DeleteMediaHandler;
use Modules\Shared\Media\Requests\DeleteMediaRequest;

class MediaController extends Controller
{
    public function __construct(

        private DeleteMediaHandler $deleteHelpHandler,
    ) {
    }
    public function delete(DeleteMediaRequest $request): JsonResponse
    {
        $ids = $request->input('ids');

        // Support both single UUID and array of UUIDs
        $parsedIds = is_array($ids)
            ? array_map(fn($id) => $id, $ids)
            : $ids;

        $this->deleteHelpHandler->handle($parsedIds);

        return Json::deleted();
    }

}
