<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class GetUsersController extends AbstractController
{
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
        // TODO: Implement __invoke() method.
    }
}
