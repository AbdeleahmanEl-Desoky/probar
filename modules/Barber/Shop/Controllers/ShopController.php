<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Handlers\DeleteShopHandler;
use Modules\Barber\Shop\Handlers\UpdateShopHandler;
use Modules\Barber\Shop\Presenters\ShopDetailsPresenter;
use Modules\Barber\Shop\Presenters\ShopPresenter;
use Modules\Barber\Shop\Requests\CreateShopRequest;
use Modules\Barber\Shop\Requests\DeleteShopRequest;
use Modules\Barber\Shop\Requests\GetShopListRequest;
use Modules\Barber\Shop\Requests\GetShopRequest;
use Modules\Barber\Shop\Requests\UpdateShopRequest;
use Modules\Barber\Shop\Services\ShopCRUDService;
use Modules\Barber\Shop\Services\ShopStatusService;
use Ramsey\Uuid\Uuid;

class ShopController extends Controller
{
    public function __construct(
        private ShopCRUDService $shopService,
        private UpdateShopHandler $updateShopHandler,
        private DeleteShopHandler $deleteShopHandler,
        private ShopStatusService $shopStatusService
    ) {
    }

    public function show(GetShopRequest $request)//: JsonResponse
    {
        $item = $this->shopService->getMyShop(Uuid::fromString(auth('api_barbers')->user()->id));
        if (!$item) {
            return response()->json([
                'code' => 'SUCCESS_WITH_SINGLE_PAYLOAD_OBJECT',
                'message' => '',
                'payload' =>null,
            ]);
        }
       $presenter = new ShopDetailsPresenter($item);

        return Json::item($presenter->getData());
    }
    public function store(CreateShopRequest $request)//: JsonResponse
    {
        $nameTranslations = $request->input('name');
        $descriptionTranslations = $request->input('description');
        $file = $request->file('file');
        $createShopDTO = $request->createCreateShopDTO();

        $createShopDTO->barber_id =  Uuid::fromString(auth('api_barbers')->user()->id);

       $createdItem = $this->shopService->create($createShopDTO, $nameTranslations, $descriptionTranslations,$file);

        $presenter = new ShopPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateShopRequest $request): JsonResponse
    {
        $shop = $this->shopService->getMyShop(Uuid::fromString(auth('api_barbers')->user()->id));

        $command = $request->createUpdateShopCommand();

        $command->id = Uuid::fromString($shop->id);

        $this->updateShopHandler->handle($command);

        $item = $this->shopService->get($command->id);

        $presenter = new ShopPresenter($item);

        return Json::item($presenter->getData());
    }

    public function updateShopStatus()//: JsonResponse
    {
        $item = $this->shopService->getMyShop(Uuid::fromString(auth('api_barbers')->user()->id));

        $shopStatusServiceUpdated = $this->shopStatusService->updateStatus($item->id);

        $presenter = new ShopPresenter($shopStatusServiceUpdated);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopRequest $request): JsonResponse
    {
        $this->deleteShopHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}
