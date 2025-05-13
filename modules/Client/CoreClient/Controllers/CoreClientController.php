<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\CoreClient\Requests\ResetPasswordRequest;
use Modules\Barber\CoreBarber\Services\ForgotPasswordService;
use Modules\Barber\CoreBarber\Services\ResetPasswordService;
use Modules\Client\CoreClient\Commands\LoginCoreClientCommand;
use Modules\Client\CoreClient\Handlers\DeleteCoreClientHandler;
use Modules\Client\CoreClient\Handlers\UpdateCoreClientHandler;
use Modules\Client\CoreClient\Presenters\CoreClientPresenter;
use Modules\Client\CoreClient\Requests\ChangePasswordRequest;
use Modules\Client\CoreClient\Requests\CreateCoreClientRequest;
use Modules\Client\CoreClient\Requests\ForgotPasswordRequest;
use Modules\Client\CoreClient\Requests\LoginCoreClientRequest;
use Modules\Client\CoreClient\Requests\ResetPasswordRequest as RequestsResetPasswordRequest;
use Modules\Client\CoreClient\Requests\UpdateCoreClientRequest;
use Modules\Client\CoreClient\Services\CoreClientCRUDService;
use Modules\Client\CoreClient\Services\LoginCoreClientService;
use Ramsey\Uuid\Uuid;

class CoreClientController extends Controller
{
    public function __construct(
        private CoreClientCRUDService $coreClientService,
        private UpdateCoreClientHandler $updateCoreClientHandler,
        private DeleteCoreClientHandler $deleteCoreClientHandler,
        private LoginCoreClientService $loginCoreClientService,
        private ForgotPasswordService $forgotPasswordService,
        private ResetPasswordService $resetPasswordService,
    ) {
    }

    public function login(LoginCoreClientRequest $request): JsonResponse
    {
        $command = $request->toCommand();
        try {
            [$token, $user] = $this->loginCoreClientService->login($command);

        } catch (\Exception $e) {
            return Json::error( $e->getMessage(),$e->getCode());
        }

        $userPresenter = (new CoreClientPresenter($user))->getData();


        return Json::item(item: [
            'token' => $token,
            'users' => $userPresenter,

        ]);
    }
    public function me(): JsonResponse
    {
        $item = $this->coreClientService->get(Uuid::fromString(auth('api_clients')->user()->id));

        $presenter = new CoreClientPresenter($item);

        return Json::item(item: $presenter->getData());
    }

    public function register(CreateCoreClientRequest $request)//: JsonResponse
    {
        // Create a new Client user
        $createdItem = $this->coreClientService->create($request->createCreateCoreClientDTO());

        $loginCommand = new LoginCoreClientCommand(
            $createdItem->email,
            $request->get('password')
        );

        try {
            [$token, $user] = $this->loginCoreClientService->login($loginCommand);
        } catch (\Exception $e) {
            return Json::error('Registration successful, but login failed.', 401);
        }

        // Format user response
        $userPresenter = (new CoreClientPresenter($user))->getData();

        return Json::item(item: [
            'token' => $token,
            'users' => $userPresenter
        ]);
    }

    public function update(UpdateCoreClientRequest $request): JsonResponse
    {
        $command = $request->createUpdateCoreClientCommand();
        $this->updateCoreClientHandler->handle($command);

        $item = $this->coreClientService->get($command->getId());

        $presenter = new CoreClientPresenter($item);

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

    public function resetPassword(RequestsResetPasswordRequest $request): JsonResponse
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
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        return $this->coreClientService->changePassword($request);
    }
}
