<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller\User;

use App\Application\Exception\ValidationException;
use App\Application\RequestFormValidationHelper;
use App\Application\User\AddUserServiceInterface;
use App\Application\User\Assembler\AddUserDtoAssemblerInterface;
use App\Infrastructure\Http\Controller\User\Form\AddUserForm;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class AddUserController extends AbstractController
{
    /** @var AddUserServiceInterface */
    private AddUserServiceInterface $addUserService;

    /** @var AddUserDtoAssemblerInterface */
    private AddUserDtoAssemblerInterface $addUserDtoAssembler;

    /**
     * AddUserController constructor.
     * @param AddUserServiceInterface $addUserService
     * @param AddUserDtoAssemblerInterface $addUserDtoAssembler
     */
    public function __construct(
        AddUserServiceInterface $addUserService,
        AddUserDtoAssemblerInterface $addUserDtoAssembler
    ) {
        $this->addUserService = $addUserService;
        $this->addUserDtoAssembler = $addUserDtoAssembler;
    }

    /**
     * @Route("api/v1/user_add", methods={"POST"})
     *
     * @SWG\Tag(name="Users")
     * @SWG\Parameter(
     *     name="payload",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(ref=@Model(type=App\Application\User\Dto\AddUserDto::class)),
     * ),
     *
     * @SWG\Response(response=200, description="OK")
     * @SWG\Response(response=400, description="Bad Request", @SWG\Schema(ref="#/definitions/JsonResponseError"))
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->request->all();
        $form = $this->createForm(AddUserForm::class)->submit($data);

        if (!$form->isValid()) {
            $errors = RequestFormValidationHelper::getFlatArrayErrors($form->createView());

            return JsonResponse::create([
                'message' => 'Validation error',
                'errors' => $errors,
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $addUserDto = $this->addUserDtoAssembler->assemble($data);
            $this->addUserService->addUser($addUserDto);
        } catch (ValidationException $exception) {
            return JsonResponse::create([
                'message' => 'Validation error',
                'errors' => [
                    $exception->getMessage()
                ],
            ], Response::HTTP_BAD_REQUEST);
        }

        return JsonResponse::create([
            'message' => '',
            'data' => [],
        ]);
    }
}
