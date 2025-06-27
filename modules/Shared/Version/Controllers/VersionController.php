<?php

declare(strict_types=1);

namespace Modules\Shared\Version\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Shared\Version\Handlers\DeleteVersionHandler;
use Modules\Shared\Version\Handlers\UpdateVersionHandler;
use Modules\Shared\Version\Models\Version;
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
        $item = $this->versionService->get($request->input('type','client'));
        $presenter = new VersionPresenter($item);
        return Json::item($presenter->getData());
    }

    public function update(GetVersionRequest $request): JsonResponse
    {
        $version = Version::where('type',$request->input('type','client'))->first();

        if($version){
            $version->update([
                'version'=>$request->version 
            ]);
            
        }else{
            Version::create([
                'version' => $request->version,
                'type' => $request->type
            ]);
        }

        return Json::done('done');
    }


}
