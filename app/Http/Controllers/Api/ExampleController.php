<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ExampleController extends Controller
{
    /**
     * @return Response
     *
     * @OA\Get(
     *      path="/roles",
     *      summary="Get all roles",
     *      tags={"Roles"},
     *      description="Get all roles",
     *      security={{"Bearer":{}}},
     *
     *      @OA\Parameter(
     *          name="search_values",
     *          in="query",
     *          required=false,
     *
     *          @OA\Schema(type="string")
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *      )
     * )
     */
    public function example() {}
}
