<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\EntityJsonResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Estate;

class EstateController extends Controller
{

    /**
     * @OA\Get(
     *      path="/v1/estates",
     *      operationId="getEstatesList",
     *      tags={"Estates"},
     *      summary="Get list of estates",
     *      description="Returns list of estates",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EntityJsonResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
     
        $states = Auth::User()->estates; 
        return new EntityJsonResource($states);
    }


    /**
     * @OA\Get(
     *      path="/v1/estates/{id}",
     *      operationId="getEstateById",
     *      tags={"Estates"},
     *      summary="Get estate information",
     *      description="Returns estate data",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *      @OA\Parameter(
     *          name="id",
     *          description="Estate id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EntityJsonResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function getById(Estate $estate){
        return new EntityJsonResource($estate);
    }
}
