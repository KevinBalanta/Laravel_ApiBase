<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EntityJsonResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\WaterSource;
use App\Models\WaterSourceType;


class WaterSourceController extends Controller
{

/**
     * @OA\Get(
     *      path="/v1/water-sources",
     *      operationId="getWaterSourceList",
     *      tags={"WaterSources"},
     *      summary="Get list of water sources",
     *      description="Returns list of water sources",
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
    public function index(Request $request){
        $estate_id = $request->query('estate_id');
        //nos aseguramos de que la hacienda (estate) si pertenezca al usuario
        $estate = Auth::User()->estates()->where('id',$estate_id)->get();
        $waterSources= $estate->first()->waterSources; 
        return (new EntityJsonResource($waterSources));
    }

    /**
     * @OA\Get(
     *      path="/v1/water-sources/{id}",
     *      operationId="getWaterSourcesById",
     *      tags={"WaterSources"},
     *      summary="Get water source information",
     *      description="Returns water source data",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *      @OA\Parameter(
     *          name="id",
     *          description="Water source id",
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

    public function getById(WaterSource $waterSource){
        return new EntityJsonResource($waterSource);
    }

    /**
     * @OA\Post(
     *      path="/v1/water-sources",
     *      operationId="storeWaterSource",
     *      tags={"WaterSources"},
     *      summary="Store new water source",
     *      description="Returns water source data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/WaterSource")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/WaterSource")
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
    
    public function store(Request $request){



        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:water_sources',
            'capacity' => 'required|numeric|min:1.0,',
            'uptake_time' => 'required|numeric|min:1',
            'type_id' => 'required',
            'estate_id' => 'required'
        ] );

    if ($validator->fails()) {
        $fieldsWithErrorMessagesArray = $validator->messages()->get('*');
        return response()->json(['messages' => $fieldsWithErrorMessagesArray],400);
    }

     


        $waterS = WaterSource::create($request->all());

   
        return  response()->json([
            $waterS
        ])
        ->setStatusCode(Response::HTTP_CREATED);
    }


    public function getTypes(){

        return (new EntityJsonResource(WaterSourceType::All()));


    }

    public function destroy(WaterSource $waterSource){

        $waterSource->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }



}
