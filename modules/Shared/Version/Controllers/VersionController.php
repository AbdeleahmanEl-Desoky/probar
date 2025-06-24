<?php

declare(strict_types=1);

namespace Modules\Shared\Version\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Shared\Version\Handlers\DeleteVersionHandler;
use Modules\Shared\Version\Handlers\UpdateVersionHandler;
use Modules\Shared\Version\Presenters\VersionPresenter;
use Modules\Shared\Version\Requests\CreateVersionRequest;
use Modules\Shared\Version\Requests\DeleteVersionRequest;
use Modules\Shared\Version\Requests\GetVersionListRequest;
use Modules\Shared\Version\Requests\GetVersionRequest;
use Modules\Shared\Version\Requests\UpdateVersionRequest;
use Modules\Shared\Version\Services\VersionCRUDService;
use Ramsey\Uuid\Uuid;

class VersionController extends Controller
{
    public function __construct(
        private VersionCRUDService $versionService,
    ) {
    }

    public function index(GetVersionListRequest $request): JsonResponse
    {
        $list = $this->versionService->get();

        return Json::items(VersionPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }



}
