<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Handlers\DeleteShopHandler;
use Modules\Barber\Shop\Handlers\UpdateShopHandler;
use Modules\Barber\Shop\Presenters\ShopPresenter;
use Modules\Barber\Shop\Requests\CreateShopRequest;
use Modules\Barber\Shop\Requests\DeleteShopRequest;
use Modules\Barber\Shop\Requests\GetShopListRequest;
use Modules\Barber\Shop\Requests\GetShopRequest;
use Modules\Barber\Shop\Requests\UpdateShopRequest;
use Modules\Barber\Shop\Services\ShopCRUDService;
use Ramsey\Uuid\Uuid;

class ShopController extends Controller
{
    public function __construct(
        private ShopCRUDService $shopService,
        private UpdateShopHandler $updateShopHandler,
        private DeleteShopHandler $deleteShopHandler,
    ) {
    }

    public function show(GetShopRequest $request)//: JsonResponse
    {
        $item = $this->shopService->getMyShop(Uuid::fromString(auth('api_barbers')->user()->id));
        if(!$item){
            return Json::error('Item not found', 404);
        }
       $presenter = new ShopPresenter($item);

        return Json::item($presenter->getData());
    }
    public function store(CreateShopRequest $request): JsonResponse
    {
        // Extract name and description translations from the request
        $nameTranslations = $request->input('name'); // An array of translations like ['en' => 'English name', 'ar' => 'Arabic name']
        $descriptionTranslations = $request->input('description'); // Similarly for description

        // Create the DTO with other required fields
        $createShopDTO = $request->createCreateShopDTO();

        // Add the barber_id to the DTO, assuming it needs to be saved with the shop
        $createShopDTO->barber_id =  Uuid::fromString(auth('api_barbers')->user()->id);

        // Call the service to create or update the shop with translations
        $createdItem = $this->shopService->create($createShopDTO, $nameTranslations, $descriptionTranslations);

        // Create presenter for the created or updated item
        $presenter = new ShopPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateShopRequest $request): JsonResponse
    {
        $command = $request->createUpdateShopCommand();
        $this->updateShopHandler->handle($command);

        $item = $this->shopService->get($command->getId());

        $presenter = new ShopPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopRequest $request): JsonResponse
    {
        $this->deleteShopHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}
