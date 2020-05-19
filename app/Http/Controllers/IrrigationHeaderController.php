<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\EntityJsonResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Motorpump;
use App\Models\IrrigationHeader;

class IrrigationHeaderController extends Controller
{
    /**
     * @OA\Get(
     *      path="/v1/irrigation-headers",
     *      operationId="getIrrigationHeaderList",
     *      tags={"IrrigationHeaders"},
     *      summary="Get list of irrigation headers",
     *      description="Returns list of irrigation headers",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *  @OA\Parameter(
     *     name="estate_id",
     *     required=true,
     *     in="query",
     *     description="The ID of the estate (hacienda)",
     *     @OA\Schema(
     *         type="integer"
     *     )
     *   ),
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
        $irrigationHeaders= $estate->first()->irrigationHeaders; 
        return (new EntityJsonResource($irrigationHeaders));
    }

    /**
     * @OA\Post(
     *      path="/v1/irrigation-headers",
     *      operationId="storeIrrigationHeader",
     *      tags={"IrrigationHeaders"},
     *      summary="Store new irrigation header",
     *      description="Returns irrigation header data",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/IrrigationHeader")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/IrrigationHeader")
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
            'name' => 'required',
            'motorpump_brand' => 'required|min:3',
            'motorpump_reference' => 'required|min:3',
            'motorpump_hp' => 'required|numeric|min:1',
            'motorpump_flow' => 'required|numeric|min:1',
            'water_source_id' => 'required',
            'estate_id' => 'required'
        ] );

        if ($validator->fails()) {
            $fieldsWithErrorMessagesArray = $validator->messages()->get('*');
            return response()->json(['messages' => $fieldsWithErrorMessagesArray],400);
        }
        //crear motorbomba y guardarla
        $motorpump = Motorpump::create(['brand' => ($request->motorpump_brand),
        'reference' => ($request->motorpump_reference),
        'hp' => ($request->motorpump_hp),
        'flow' => ($request->motorpump_flow),
        ]);

        //creación del cabezal de riego
        $irrigation_header = IrrigationHeader::create([
            'name' => ($request->name),
            'motorpump_id' => ($motorpump->id),
            'estate_id' => ($request->estate_id),
            'water_source_id' => ($request->water_source_id)
        ]);


        return (new EntityJsonResource($irrigation_header));

    }



     /**
     * @OA\Get(
     *      path="/v1/irrigation-headers/{id}",
     *      operationId="getIrrigationHeadersById",
     *      tags={"IrrigationHeaders"},
     *      summary="Get irrigation header information",
     *      description="Returns irrigation header data",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *      @OA\Parameter(
     *          name="id",
     *          description="Irrigation header id",
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

    public function getById(IrrigationHeader $irrigationHeader){
        return new EntityJsonResource($irrigationHeader);
    }
}
