<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller\User;

use App\Application\RequestFormValidationHelper;
use App\Application\User\Assembler\DeactivateUserDtoAssemblerInterface;
use App\Application\User\DeactivateUserServiceInterface;
use App\Infrastructure\Http\Controller\User\Form\DeactivateUserForm;
use App\Infrastructure\Http\ResponseFactory;
use DomainException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class DeactivateUserController extends AbstractController
{
    /** @var DeactivateUserServiceInterface */
    private DeactivateUserServiceInterface $deactivateUserService;

    /** @var DeactivateUserDtoAssemblerInterface */
    private DeactivateUserDtoAssemblerInterface $deactivateUserDtoAssembler;

    /**
     * DeactivateUserController constructor.
     * @param DeactivateUserServiceInterface $deactivateUserService
     * @param DeactivateUserDtoAssemblerInterface $deactivateUserDtoAssembler
     */
    public function __construct(
        DeactivateUserServiceInterface $deactivateUserService,
        DeactivateUserDtoAssemblerInterface $deactivateUserDtoAssembler
    )
    {
        $this->deactivateUserService = $deactivateUserService;
        $this->deactivateUserDtoAssembler = $deactivateUserDtoAssembler;
    }

    /**
     * @Route("api/v1/user_deactivate", methods={"POST"})
     *
     * @SWG\Tag(name="Users")
     * @SWG\Parameter(
     *     name="payload",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(ref=@Model(type=App\Application\User\Dto\DeactivateUserDto::class)),
     * ),
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
        $form = $this->createForm(DeactivateUserForm::class)->submit($data);

        if (!$form->isValid()) {
            $errors = RequestFormValidationHelper::getFlatArrayErrors($form->createView());

            return ResponseFactory::createErrorResponse($errors, 'Validation error');
        }

        try {
            $deactivateUserDto = $this->deactivateUserDtoAssembler->assemble($data);

            $this->deactivateUserService->deactivateUser($deactivateUserDto);

            return ResponseFactory::createOkResponse();
        } catch (DomainException $exception) {
            return ResponseFactory::createErrorResponse($exception->getMessage(), 'Validation error');
        }
    }
}
