<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Controllers;

use BasePackage\Shared\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\CoreBarber\Commands\LoginCoreBarberCommand;
use Modules\Barber\CoreBarber\Handlers\DeleteCoreBarberHandler;
use Modules\Barber\CoreBarber\Handlers\UpdateCoreBarberHandler;
use Modules\Barber\CoreBarber\Presenters\CoreBarberPresenter;
use Modules\Barber\CoreBarber\Requests\CreateCoreBarberRequest;
use Modules\Barber\CoreBarber\Requests\DeleteCoreBarberRequest;
use Modules\Barber\CoreBarber\Requests\GetCoreBarberListRequest;
use Modules\Barber\CoreBarber\Requests\GetCoreBarberRequest;
use Modules\Barber\CoreBarber\Requests\LoginCoreBarberRequest;
use Modules\Barber\CoreBarber\Requests\UpdateCoreBarberRequest;
use Modules\Barber\CoreBarber\Services\CoreBarberCRUDService;
use Modules\Barber\CoreBarber\Services\LoginCoreBarberService;
use Ramsey\Uuid\Uuid;
use Modules\Barber\CoreBarber\Requests\ForgotPasswordRequest;
use Modules\Barber\CoreBarber\Requests\ResetPasswordRequest;
use Modules\Barber\CoreBarber\Services\ForgotPasswordService;
use Modules\Barber\CoreBarber\Services\ResetPasswordService;

class CoreBarberController extends Controller
{
    public function __construct(
        private CoreBarberCRUDService $coreBarberService,
        private UpdateCoreBarberHandler $updateCoreBarberHandler,
        private DeleteCoreBarberHandler $deleteCoreBarberHandler,
        private LoginCoreBarberService $loginCoreBarberService,
        private ForgotPasswordService $forgotPasswordService,
        private ResetPasswordService $resetPasswordService
    ) {
    }

    public function login(LoginCoreBarberRequest $request): JsonResponse
    {
        $command = $request->toCommand();

        try {
            [$token, $user] = $this->loginCoreBarberService->login($command);
        } catch (\Exception $e) {
            return Json::buildItems(data: ["message" => $e->getMessage()], httpStatus: $e->getCode());
        }

       $userPresenter = (new CoreBarberPresenter($user))->getData();
        return Json::item(item: [
            'token' => $token,
            'users' => $userPresenter
        ]);
    }
    public function me(): JsonResponse
    {
        $item = $this->coreBarberService->get(Uuid::fromString(auth('api')->user()->id));

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
            return Json::buildItems(data: ["message" => "Registration successful, but login failed."], httpStatus: 401);
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

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        try {
            $this->forgotPasswordService->generateAndSendOtp($request->email);
            return Json::buildItems(data: ["message" => "OTP sent to your email."]);
        } catch (\Exception $e) {
            return Json::buildItems(data: ["message" => $e->getMessage()], httpStatus: 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            // Call the service to handle the reset
            $message = $this->resetPasswordService->resetPassword($request->email, $request->otp, $request->password);

            return Json::buildItems(data: ["message" => $message]);
        } catch (\Exception $e) {
            return Json::buildItems(data: ["message" => $e->getMessage()], httpStatus: $e->getCode());
        }
    }


}
