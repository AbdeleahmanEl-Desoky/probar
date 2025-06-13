<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\CoreBarber\Commands\LoginCoreBarberCommand;
use Modules\Barber\CoreBarber\Handlers\DeleteCoreBarberHandler;
use Modules\Barber\CoreBarber\Handlers\UpdateCfmTokenHandler;
use Modules\Barber\CoreBarber\Handlers\UpdateCoreBarberHandler;
use Modules\Barber\CoreBarber\Presenters\CoreBarberPresenter;
use Modules\Barber\CoreBarber\Requests\CfmTokenRequest;
use Modules\Barber\CoreBarber\Requests\CheckPasswordRequest;
use Modules\Barber\CoreBarber\Requests\CreateCoreBarberRequest;
use Modules\Barber\CoreBarber\Requests\DeleteCoreBarberRequest;
use Modules\Barber\CoreBarber\Requests\LoginCoreBarberRequest;
use Modules\Barber\CoreBarber\Requests\UpdateCoreBarberRequest;
use Modules\Barber\CoreBarber\Services\CoreBarberCRUDService;
use Modules\Barber\CoreBarber\Services\LoginCoreBarberService;
use Ramsey\Uuid\Uuid;
use Modules\Barber\CoreBarber\Requests\ForgotPasswordRequest;
use Modules\Barber\CoreBarber\Requests\ResetPasswordRequest;
use Modules\Barber\CoreBarber\Services\DataCompleteService;
use Modules\Barber\CoreBarber\Services\ForgotPasswordService;
use Modules\Barber\CoreBarber\Services\ResetPasswordService;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Illuminate\Support\Facades\Hash;
class CoreBarberController extends Controller
{
    public function __construct(
        private CoreBarberCRUDService $coreBarberService,
        private UpdateCoreBarberHandler $updateCoreBarberHandler,
        private DeleteCoreBarberHandler $deleteCoreBarberHandler,
        private LoginCoreBarberService $loginCoreBarberService,
        private ForgotPasswordService $forgotPasswordService,
        private ResetPasswordService $resetPasswordService,
        private ShopRepository $shopRepository,
        private DataCompleteService $dataCompleteService,
        private UpdateCfmTokenHandler $updateCfmTokenHandler,
    ) {
    }

    public function login(LoginCoreBarberRequest $request): JsonResponse
    {
        $command = $request->toCommand();

        try {
            [$token, $user] = $this->loginCoreBarberService->login($command);
        } catch (\Exception $e) {
            return Json::error( $e->getMessage(),$e->getCode());
        }

        $userPresenter = (new CoreBarberPresenter($user))->getData();

        $dataComplete = $this->dataCompleteService->dataComplete($user->id);

        return Json::item(item: [
            'token' => $token,
            'users' => $userPresenter,
             'data_complete' =>   $dataComplete ,
        ]);
    }
    public function me(): JsonResponse
    {
        $item = $this->coreBarberService->get(Uuid::fromString(auth('api_barbers')->user()->id));

        $presenter = new CoreBarberPresenter($item);

        return Json::item(item: $presenter->getData());
    }

    public function register(CreateCoreBarberRequest $request): JsonResponse
    {
        // Create a new barber user
        $createdItem = $this->coreBarberService->create($request->createCreateCoreBarberDTO());

        $loginCommand = new LoginCoreBarberCommand(
            $createdItem->email,
            $request->password
        );

        try {
            [$token, $user] = $this->loginCoreBarberService->login($loginCommand);
        } catch (\Exception $e) {
            return Json::error('Registration successful, but login failed.', 401);
        }

        // Format user response
        $userPresenter = (new CoreBarberPresenter($user))->getData();

        return Json::item(item: [
            'token' => $token,
            'users' => $userPresenter
        ]);
    }

    public function update(UpdateCoreBarberRequest $request): JsonResponse
    {
        $command = $request->createUpdateCoreBarberCommand();
        $this->updateCoreBarberHandler->handle($command);

        $item = $this->coreBarberService->get($command->getId());

        $presenter = new CoreBarberPresenter($item);

        return Json::item(item: $presenter->getData());
    }
    public function updateFcmToken(CfmTokenRequest $request): JsonResponse
    {
        $command = $request->updateCfmTokenCommand();
        $this->updateCfmTokenHandler->handle($command);

        $item = $this->coreBarberService->get($command->getId());

        $presenter = new CoreBarberPresenter($item);

        return Json::item(item: $presenter->getData());
    }
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        try {
            $this->forgotPasswordService->generateAndSendOtp($request->email);

            // Correctly pass the item parameter with key-value pair.
            return Json::done("OTP sent to your email.",200);
        } catch (\Exception $e) {
            // Correctly pass the error message and HTTP status code.
            return Json::error($e->getMessage(), $e->getCode());
        }
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            // Call the service to handle the reset
            $message = $this->resetPasswordService->resetPassword($request->email, $request->otp, $request->password);

            // Return success message
            return Json::done($message);
        } catch (\Exception $e) {
            // Return error message with exception code or default to 500
            return Json::error($e->getMessage(), $e->getCode() ?: 500);
        }
    }

    public function delete(DeleteCoreBarberRequest $request): JsonResponse
    {
        $this->deleteCoreBarberHandler->handle(Uuid::fromString(auth('api_barbers')->user()->id));

        return Json::deleted();
    }

    public function checkPassword(CheckPasswordRequest $request): JsonResponse
    {
        $barber = auth('api_barbers')->user();

        if (!$barber) {
            return Json::error('Unauthorized', 401);
        }

        if (Hash::check($request->password, $barber->password)) {
            return Json::done('Password is correct.');
        }

        return Json::error('Password is incorrect.', 422);
    }
}
