<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller\User;

use App\Application\RequestFormValidationHelper;
use App\Application\User\Assembler\UpdateUserDtoAssemblerInterface;
use App\Application\User\UpdateUserServiceInterface;
use App\Infrastructure\Http\Controller\User\Form\UpdateUserForm;
use App\Infrastructure\Http\ResponseFactory;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class UpdateUserController extends AbstractController
{
    /** @var UpdateUserServiceInterface */
    private $updateUserService;

    /** @var UpdateUserDtoAssemblerInterface */
    private $updateUserDtoAssembler;

    /**
     * UpdateUserController constructor.
     * @param UpdateUserServiceInterface $updateUserService
     * @param UpdateUserDtoAssemblerInterface $updateUserDtoAssembler
     */
    public function __construct(
        UpdateUserServiceInterface $updateUserService,
        UpdateUserDtoAssemblerInterface $updateUserDtoAssembler
    ) {
        $this->updateUserService = $updateUserService;
        $this->updateUserDtoAssembler = $updateUserDtoAssembler;
    }

    /**
     * @Route("api/v1/user_update", methods={"POST"})
     *
     * @SWG\Tag(name="Users")
     *
     * @SWG\Response(response=200, description="OK")
     * @SWG\Response(response=400, description="Bad Request", @SWG\Schema(ref="#/definitions/JsonResponseError"))
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $data = $request->request->all();
        $form = $this->createForm(UpdateUserForm::class)->submit($data);

        if (!$form->isValid()) {
            $errors = RequestFormValidationHelper::getFlatArrayErrors($form->createView());

            return ResponseFactory::createErrorResponse($errors, 'Validation error');
        }

        try {
            $updateUserDto = $this->updateUserDtoAssembler->assemble($data);

            $this->updateUserService->updateUser($updateUserDto);

            return ResponseFactory::createOkResponse();
        } catch (DomainException $exception) {
            return ResponseFactory::createErrorResponse($exception->getMessage(), 'Validation error');
        }
    }
}
