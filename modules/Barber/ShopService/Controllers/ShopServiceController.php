<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Modules\Barber\ShopService\Handlers\DeleteShopServiceHandler;
use Modules\Barber\ShopService\Handlers\UpdateShopServiceHandler;
use Modules\Barber\ShopService\Presenters\ShopServicePresenter;
use Modules\Barber\ShopService\Requests\CreateShopServiceRequest;
use Modules\Barber\ShopService\Requests\DeleteShopServiceRequest;
use Modules\Barber\ShopService\Requests\GetShopServiceListRequest;
use Modules\Barber\ShopService\Requests\GetShopServiceRequest;
use Modules\Barber\ShopService\Requests\UpdateShopServiceRequest;
use Modules\Barber\ShopService\Services\ShopServiceCRUDService;
use Ramsey\Uuid\Uuid;

class ShopServiceController extends Controller
{
    public function __construct(
        private ShopServiceCRUDService $shopServiceService,
        private UpdateShopServiceHandler $updateShopServiceHandler,
        private DeleteShopServiceHandler $deleteShopServiceHandler,
        private ShopRepository $shopRepository
    ) {
    }

    public function index(GetShopServiceListRequest $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $barberId = Uuid::fromString($userId);
        $shop = $this->shopRepository->getMyShop($barberId);
        if (!$shop) {
            return Json::done("Please add a shop first before proceeding.");
        }
        $list = $this->shopServiceService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10),
            $shop->id
        );

        return Json::items(ShopServicePresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetShopServiceRequest $request): JsonResponse
    {
        $item = $this->shopServiceService->get(Uuid::fromString($request->route('id')));

        $presenter = new ShopServicePresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateShopServiceRequest $request)//: JsonResponse
    {
        $nameTranslations = $request->input('name');
        $descriptionTranslations = $request->input('description');
        $file = $request->file('file');
        $createShopDTO = $request->createCreateShopServiceDTO();

        $shop = $this->shopRepository->getMyShop(Uuid::fromString(auth('api_barbers')->user()->id));
        if (!$shop) {
            return Json::done("Please add a shop first before proceeding.");
        }
        $createShopDTO->shop_id = $shop->id;

        $createdItem = $this->shopServiceService->create($createShopDTO, $nameTranslations, $descriptionTranslations,$file);

        $presenter = new ShopServicePresenter($createdItem);

       return Json::item($presenter->getData());
    }

    public function update(UpdateShopServiceRequest $request): JsonResponse
    {
        $command = $request->createUpdateShopServiceCommand();
        $nameTranslations = $request->input('name');
        $descriptionTranslations = $request->input('description');
        $file = $request->file('file');

        $this->updateShopServiceHandler->handle($command,$nameTranslations, $descriptionTranslations,$file);

        $item = $this->shopServiceService->get($command->getId());

        $presenter = new ShopServicePresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopServiceRequest $request): JsonResponse
    {
        $this->deleteShopServiceHandler->handle(Uuid::fromString($request->route('id')));

        return Json::done(message: "");

    }
}
