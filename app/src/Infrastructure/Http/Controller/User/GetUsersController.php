<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller\User;

use App\Application\RequestFormValidationHelper;
use App\Application\User\Assembler\GetUsersDtoAssemblerInterface;
use App\Application\User\GetUsersServiceInterface;
use App\Infrastructure\Http\Controller\User\Form\GetUsersForm;
use App\Infrastructure\Http\ResponseFactory;
use DomainException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class GetUsersController extends AbstractController
{
    /** @var GetUsersServiceInterface */
    private GetUsersServiceInterface $getUsersService;

    /** @var GetUsersDtoAssemblerInterface */
    private GetUsersDtoAssemblerInterface $getUsersDtoAssembler;

    /**
     * GetUsersController constructor.
     * @param GetUsersServiceInterface $getUsersService
     * @param GetUsersDtoAssemblerInterface $getUsersDtoAssembler
     */
    public function __construct(
        GetUsersServiceInterface $getUsersService,
        GetUsersDtoAssemblerInterface $getUsersDtoAssembler
    )
    {
        $this->getUsersService = $getUsersService;
        $this->getUsersDtoAssembler = $getUsersDtoAssembler;
    }

    /**
     * @Route("api/v1/users_get-list", methods={"POST"})
     *
     * @SWG\Tag(name="Users")
     * @SWG\Parameter(
     *     name="payload",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(ref=@Model(type=App\Application\User\Dto\GetUsersDto::class)),
     * ),
     *
     * @SWG\Response(
     *     response=200,
     *     description="OK",
     *     @SWG\Schema(
     *         type="object",
     *         allOf={
     *             @SWG\Schema(ref="#/definitions/JsonResponseOk"),
     *             @SWG\Schema(
     *                 @SWG\Property(
     *                     property="data",
     *                     type="array",
     *                     @SWG\Items(
     *                         ref=@Model(type=\App\Application\User\Dto\UserDto::class)
     *                     )
     *                 )
     *             )
     *         }
     *     )
     * )
     * @SWG\Response(response=400, description="Bad Request", @SWG\Schema(ref="#/definitions/JsonResponseError"))
     */
    public function __invoke(Request $request)
    {
        $data = $request->request->all();
        $form = $this->createForm(GetUsersForm::class)->submit($data);

        if (!$form->isValid()) {
            $errors = RequestFormValidationHelper::getFlatArrayErrors($form->createView());

            return ResponseFactory::createErrorResponse($errors, 'Validation error');
        }

        try {
            $getUsersDto = $this->getUsersDtoAssembler->assemble($data);

            $users = $this->getUsersService->getUsers($getUsersDto);

            return ResponseFactory::createOkResponse($users);
        } catch (DomainException $exception) {
            return ResponseFactory::createErrorResponse($exception->getMessage(), 'Validation error');
        }
    }
}
