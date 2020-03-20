<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller\User;

use App\Application\User\GetUsersServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class GetUsersController extends AbstractController
{
    /** @var GetUsersServiceInterface */
    private GetUsersServiceInterface $getUsersService;

    /**
     * GetUsersController constructor.
     * @param GetUsersServiceInterface $getUsersService
     */
    public function __construct(GetUsersServiceInterface $getUsersService)
    {
        $this->getUsersService = $getUsersService;
    }

    /**
     * @Route("api/v1/users_get-list", methods={"GET"})
     *
     * @SWG\Tag(name="Users")
     *
     * @SWG\Response(response=200, description="OK")
     * @SWG\Response(response=400, description="Bad Request", @SWG\Schema(ref="#/definitions/JsonResponseError"))
     */
    public function __invoke()
    {
        try {
            $users = $this->getUsersService->getUsers();

            return JsonResponse::create([
                'message' => '',
                'data' => $users,
            ]);
        } catch (\DomainException $exception) {
            return JsonResponse::create([
                'message' => 'Validation error',
                'errors' => [
                    $exception->getMessage()
                ],
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
