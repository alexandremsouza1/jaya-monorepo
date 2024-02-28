<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Jaya API Documentation",
 *      description="Desafio técnico para a vaga de desenvolvedor na Jaya",
 *      @OA\Contact(
 *          email="xandemag@gmail.com"
 *      ),
 *      @OA\License(
 *          name="MIT License",
 *          url=""
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server"
 * )
 *
 */
abstract class DefaultApiController extends BaseController
{


}
